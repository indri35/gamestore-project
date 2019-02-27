<?php

use App\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PublicController@index');
Route::get('/detail/{id?}', ['as'=>'detail.id','uses'=>'PublicController@detail']);
Route::get('/action', 'PublicController@action');
Route::get('/listgames', 'PublicController@listgames');
Route::get('/listusers', 'PublicController@listusers');
Route::get('/casino', 'PublicController@casino');
Route::get('/adventure', 'PublicController@adventure');
Route::get('/home', 'PublicController@index');
Route::get('/puzzle', 'PublicController@puzzle');
Route::get('/sport', 'PublicController@sport');
Route::get('/education', 'PublicController@education');
Route::get('/play/{id}', 'PublicController@play');
Route::get('/dashboard', 'DashboardController@dashboard');
Route::get('/getDataBarChart', 'PublicController@getDataBarChart');

Route::group(['middleware' => 'auth'], function(){

	Route::get('/addgameaction', 'HomeController@addgameaction');
	Route::get('/addgamecasino', 'HomeController@addgamecasino');
	Route::get('/addgameadventure', 'HomeController@addgameadventure');
	Route::get('/addgamepuzzle', 'HomeController@addgamepuzzle');
	Route::get('/addgamesports', 'HomeController@addgamesports');
	Route::get('/addgame', 'HomeController@addgame');
	Route::get('/editgame/{id}', 'HomeController@editgame');
	Route::get('/active/{id}', 'HomeController@active');
	Route::get('/unactive/{id}', 'HomeController@unactive');
	Route::delete('/deletegame/{id}', 'HomeController@deletegame');
	Route::post('/updatedatagame', 'HomeController@updatedatagame');
	Route::get('/userprofile', 'HomeController@userprofile');
	Route::get('/editprofile', 'HomeController@editprofile');
	Route::post('/updateprofile', 'HomeController@updateprofile');
	Route::post('/adddatagame', 'HomeController@adddatagame');
	Route::post('/addreviewgame', 'HomeController@addreviewgame');
	Route::get('/redeem/{hp}', 'HomeController@redeem');


});

//activation
Route::get('/user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');
Route::auth();

//jwt-auth
Route::group(['middleware' => ['bcors']], function () {
	
	Route::post('/signup', function(){
	
	$input = Input::only('email','birthdate','password','name','phone_number','sex','address');

		if (isset($input['email']) && isset($input['birthdate']) && isset($input['password']) && isset($input['sex']) &&
			isset($input['address']) && isset($input['phone_number']) && isset($input['name'])){
					$input['password'] = Hash::make($input['password']);
					$email = $input['phone_number'];		

					$user = User::where('phone_number',$email)->first();
					if($user){
						return Response::json(['status'=>false,'message'=>'user already exsist']);
					}else{
						try {
							$input['activated']=1;
							$input['role']=2;
							User::create($input);            
						} catch (Exception $e) {
							return Response::json(['status'=>false,'message'=>$e]);
						}
						return Response::json(['status'=>true,'message'=>"success created user"]);            
					}
					}else{
						return Response::json(['status'=>false,'message'=>'parameter input not complete!','data'=>$input]);
					}
		});

		Route::get('checkpoint/{msisdn}', function($msisdn){
			
			$user = User::where('phone_number',$msisdn)->first();
			$data=DB::table('t_play_games')
			->join('users', 'users.id', '=', 't_play_games.idplayer','left')						
			->select(DB::raw('users.id,users.name, users.img as img, count(score) as score'))
			->where('users.id',$user->id)
			->groupby('users.id')->first();
			if($data)
				echo $data->score;
			else 
				echo 0;
		});

		
		Route::get('unreg/{msisdn}', function($msisdn){

			$input['phone_number']= $msisdn;
		
			if (isset($input)){

				$email = $input['phone_number'];						
				$user = User::where('phone_number',$email)->first();
					if($user){
						$user->activated=0;
						$user->is_login=0;
						$user->coint=0;
						$user->save();
						echo "success";            
					}else{
						echo "msisdn not found";            
					}
				}else{
					echo "please input msisdn!";
				}
			});


		Route::get('msisdn/{msisdn}', function(Request $request, $msisdn){

				$input['phone_number']= $msisdn;
			
				if (isset($input)){
					$pass = substr(md5(microtime()),rand(0,26),6);
					$input['password'] = bcrypt($pass);

					$email = $input['phone_number'];		
					$ua =  $request->header('User-Agent');
					$user = User::where('phone_number',$email)->first();
					if($user){
						$user->password=$input['password'];
						$user->activated=1;
						$user->is_login=0;
						$user->subdate=date("Y-m-d H:i:s");
						$user->save();
						echo $pass;            
						//return Response::json(['status'=>false,'message'=>'user already exsist']);
					}else{
						try {
							$input['activated']=1;
							//$input['user_agent']=$ua;
							$input['subdate']=date("Y-m-d H:i:s");
							$input['role']=2;
							User::create($input);            
						} catch (Exception $e) {
							echo $e;
						}
						echo $pass;            
					}
					}else{
						echo 'please input msisdn!';
					}
				});
	
		Route::post('/signin', function(){

			$input = Input::only('phone_number','password');
			//$customClaims = ['name' => $user->nama, 'picture' => $user->file_foto];
			//if (!$token = JWTAuth::attempt($input, $customClaims)) {
			
			if (!$token = JWTAuth::attempt($input)) {
				return response()->json(['status'=>false,'message' => 'wrong email or password.']);
			}
			$user = User::Where('phone_number',$input['phone_number'])->first();
			return response()->json(['status'=>true,'user'=>$user,'token' => $token]);

		});

	 });
	
	
	Route::group(['middleware' => ['bcors','jwt.auth']], function () {
		Route::get('/getgames/{take?}','PublicController@getgames');
	});
	
