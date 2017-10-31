<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\MasterData;
use App\Models\Rate;
use App\User;
use App\Models\Games;
use App\Models\Plays;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
	
	
	/**
	* Show the application dashboard.
		     *
		     * @return \Illuminate\Http\Response
		     */
	
	public function __construct()
	{
		//$		this->middleware('auth');
	}
	
	public function index()
		    {
		if(Auth::user()){
			
			$user = Auth::user();

			if($user->role=='2'){
				$master_datas = DB::table('t_games')
								                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
								                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
								                ->get();
				return view('public.home', compact('master_datas'));
			}
			elseif($user->role=='1'){



			$master_datas = Games::orderBy('created_at','DESC')->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')->get();
			$dashboard_count = DB::table('t_games')
						                ->select(DB::raw('count(t_games.id) as games,sum(t_games.count_play) as played'))
						                ->get();
			$player_count = DB::table('users')
						                ->select(DB::raw('COUNT(users.id) as player'))
						                ->WHERE('users.role',2)
						                ->get();
			$action = Games::orderBy('created_at','DESC')
										->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
										->WHERE('t_games.category','Action')
										->get();
			$arcade = Games::orderBy('created_at','DESC')
										->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
										->WHERE('t_games.category','Arcade')
										->get();

			$adventure = Games::orderBy('created_at','DESC')
										->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
										->WHERE('t_games.category','Adventure')
										->get();
			$casino = Games::orderBy('created_at','DESC')
										->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
										->WHERE('t_games.category','Casual')
										->get();
			$puzzle = Games::orderBy('created_at','DESC')
										->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
										->WHERE('t_games.category','Puzzle')
										->get();
			$sports = Games::orderBy('created_at','DESC')
										->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
										->WHERE('t_games.category','Sports')
										->get();							
			$new_game = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->orderBy('t_games.id','DESC')
						                ->get();
			$most_played = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->orderBy('t_games.count_play','DESC')
						                ->get();
			$most_rated = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->orderBy('t_games_rate.user_rate','DESC')
						                ->get();
			$slider = DB::table('t_games')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games.img_slider'))
						                ->orderBy('t_games.count_play','DESC')
						                ->paginate(3);
			$top_games = DB::table('t_games')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games.img_slider'))
						                ->orderBy('t_games.count_play','DESC')
						                ->paginate(10);
												
			return view('admin.home-admin', compact('master_datas','arcade','dashboard_count','player_count','action','adventure','casino','puzzle','sports'));	
			}
		}
		else{
			$master_datas = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->get();
			return view('user.home-user', compact('master_datas'));
		}
	}
	
	
	public function adddatagame(Request $request)
		        {
		$this->validate($request, [
									'name'=> 'required|max:50|unique:t_games',
									'category'=> 'required',
									'desc'=> 'required',
									'coint'=> 'required',
									'url'=> 'required',
				                    'img' => 'required|mimes:jpeg,bmp,jpg,png|max:2000|dimensions:width=512,height=512',
				                    'banner' => 'required|mimes:jpeg,bmp,png,jpg,pngmax:2000|dimensions:min_width=1024,min_height=270'
				                ]);
		
		
		$imageName = 'game_icon'.$request->file('img')->getClientOriginalName();

		$path = base_path() . '/public/img_game/';
		$request->file('img')->move($path , $imageName);

		$imagebannerName = 'game_icon'.$request->file('banner')->getClientOriginalName();
		$path = base_path() . '/public/img_game/';
		$request->file('banner')->move($path , $imagebannerName);

		$masterdata = new MasterData;

		$masterdata->img = '/img_game/'.$imageName;
		$masterdata->banner = '/img_game/'.$imagebannerName;
		$masterdata->name = Input::get('name');
		$masterdata->coint = Input::get('coint');
		$masterdata->url = Input::get('url');
		$masterdata->desc = Input::get('desc');
		$masterdata->category = Input::get('category');
		$masterdata->save();
		
		return $this->index()->withMessage('Game saved!');
	}

	public function updatedatagame(Request $request)
	{
		$this->validate($request, [
								'name'=> 'required|max:50',
								'category'=> 'required',
								'desc'=> 'required',
								'coint'=> 'required',
								'url'=> 'required',
								'img' => 'mimes:jpeg,bmp,jpg,png|max:2000|dimensions:width=512,height=512',
								'banner' => 'mimes:jpeg,bmp,png,jpg,pngmax:2000|dimensions:min_width=1024,min_height=270'
							]);

		
		$id = Input::get('id');		
		$masterdata = MasterData::findOrFail($id);
		
		if($request->file('img')){
			$imageName = 'game_icon'.$request->file('img')->getClientOriginalName();
			$path = base_path() . '/public/img_game/';
			$request->file('img')->move($path , $imageName);
			$masterdata->img = '/img_game/'.$imageName;			
		}
		if($request->file('banner')){
			$imagebannerName = 'game_icon'.$request->file('banner')->getClientOriginalName();
			$path = base_path() . '/public/img_game/';
			$request->file('banner')->move($path , $imagebannerName);
			$masterdata->banner = '/img_game/'.$imagebannerName;			
		}

		$masterdata->name = Input::get('name');
		$masterdata->coint = Input::get('coint');
		$masterdata->url = Input::get('url');
		$masterdata->desc = Input::get('desc');
		$masterdata->category = Input::get('category');
		$masterdata->save();

		return $this->index()->withMessage('Game updated!');
		}

	public function addreviewgame(Request $request)
		        {
		
		$id=Input::get('id_game');
				$master_datas = DB::table('t_games')
				                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
				                ->join('t_rate', 't_rate.id_game', '=', 't_games.id','left outer')
				                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate, t_rate.user_name,t_rate.rate,t_rate.comment,t_rate.created_at'))
				                ->where('t_games.id',$id)
				                ->get();
		$slider = DB::table('t_games')
						        ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games.img_slider'))
						        ->orderBy('t_games.count_play','DESC')
						        ->paginate(3);
		$top_games = DB::table('t_games')
						        ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games.img_slider'))
						        ->orderBy('t_games.count_play','DESC')
						        ->paginate(10);

		$rate = new Rate;
		$rate->id_game = Input::get('id_game');
		$rate->id_user = Input::get('id_user');
		$rate->rate = Input::get('rate');
		$rate->user_name = Input::get('user_name');
		$rate->email = Input::get('email');
		$rate->comment = Input::get('comment');
		$rate->save();
		
		return redirect()->action(
			'PublicController@play', ['id' => $id]
		);
	}
		
	
	public function addgameadventure()
		    {
				
		$user = Auth::user();
		return view('admin.addgameadventure');
	}
	
	public function addgameaction()
		    {
		$user = Auth::user();
		return view('admin.addgameaction');
	}
	public function userprofile()
	{
		$user = Auth::user();
		$slider = DB::table('t_games')
				->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games.img_slider'))
				->orderBy('t_games.count_play','DESC')
				->paginate(3);

		$top_games = DB::table('t_play_games')
				->join('users', 'users.id', '=', 't_play_games.idplayer','left')						
				->select(DB::raw('users.id,users.name, users.img as img, count(score) as score'))
				->groupby('users.id')
				->orderby('score','desc')
				->paginate(5);

		return view('public.profile',compact('user','top_games'));
	}
	public function editprofile()
	{
		$user = Auth::user();

		return view('public.editprofile',compact('user'));
	}
	public function updateprofile(Request $request)
	{		
		$this->validate($request, [
				'name' => 'required',
				'sex' => 'required',
				'birthdate' => 'date|required',
				'password' => 'required|min:6|confirmed',
				'img' => 'mimes:jpeg,bmp,jpg,png||max:5000}'
		]);

		$user = Auth::user();
		$user->name = $request->input("name");
		$user->sex = $request->input("sex");
		$user->birthdate = $request->input("birthdate");
		$user->password = bcrypt($request->input("password"));
		
		if ($request->hasFile('img')) {
			$imageTempName = $request->file('img')->getPathname();
			$imageName =$request->file('img')->getClientOriginalName();
			$path = base_path() . '/public/upload/images/';
			$request->file('img')->move($path , $imageName);
			$user->img = '/upload/images/'.$imageName;
		}
		
		$user->save();
		
		return redirect()->action(
			'HomeController@userprofile'
		);
	}
	


	public function addgamepuzzle()
		    {
		$user = Auth::user();
		return view('admin.addgamepuzzle');
	}
	
	public function addgamecasion()
		    {
		$user = Auth::user();
		return view('admin.addgamecasion');
	}
	
	public function addgamesports()
		    {
		$user = Auth::user();
		return view('admin.addgamesports');
	}
	
	public function addgame()
		    {
		$user = Auth::user();
		return view('admin.addgame');
	}
	
	public function login()
		    {
		return view('login');
	}
	
	public function detail($id)
		    {
		$master_datas = DB::table('t_games')
				                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
				                ->join('t_rate', 't_rate.id_game', '=', 't_games.id','left outer')
				                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate, t_rate.user_name,t_rate.rate,t_rate.comment,t_rate.created_at'))
				                ->where('t_games.id',$id)
				                ->get();
		return view('detail', compact('master_datas'));
	}
	
	public function editgame($id) {
		
		$game = MasterData::findOrFail($id);

		return view('admin.editgame',compact('game'));
	}
	
	public function deletegame($id) {
		
		$game = MasterData::findOrFail($id);
		$game->delete();		
		return $this->index()->withMessage('Game deleted!');
	}
		
	
}
