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
								                ->paginate();
				return view('public.home', compact('master_datas'));
			}
			elseif($user->role=='1'){



			$master_datas = Games::orderBy('created_at','DESC')->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')->paginate();
			$dashboard_count = DB::table('t_games')
						                ->select(DB::raw('count(t_games.id) as games,sum(t_games.count_play) as played'))
						                ->paginate();
			$player_count = DB::table('users')
						                ->select(DB::raw('COUNT(users.id) as player'))
						                ->WHERE('users.role',2)
						                ->paginate();
			$action = Games::orderBy('created_at','DESC')
										->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
										->WHERE('t_games.category','Action')
										->paginate();
			$adventure = Games::orderBy('created_at','DESC')
										->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
										->WHERE('t_games.category','Adventure')
										->paginate();
			$casino = Games::orderBy('created_at','DESC')
										->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
										->WHERE('t_games.category','Casino')
										->paginate();
			$puzzle = Games::orderBy('created_at','DESC')
										->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
										->WHERE('t_games.category','Puzzle')
										->paginate();
			$sports = Games::orderBy('created_at','DESC')
										->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
										->WHERE('t_games.category','Sports')
										->paginate();							
			$new_game = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->orderBy('t_games.id','DESC')
						                ->paginate();
			$most_played = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->orderBy('t_games.count_play','DESC')
						                ->paginate();
			$most_rated = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->orderBy('t_games_rate.user_rate','DESC')
						                ->paginate();
			$slider = DB::table('t_games')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games.img_slider'))
						                ->orderBy('t_games.count_play','DESC')
						                ->paginate(3);
			$top_games = DB::table('t_games')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games.img_slider'))
						                ->orderBy('t_games.count_play','DESC')
						                ->paginate(10);
												
			return view('admin.home-admin', compact('master_datas','dashboard_count','player_count','action','adventure','casino','puzzle','sports'));	
			}
		}
		else{
			$master_datas = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->paginate();
			return view('user.home-user', compact('master_datas'));
		}
	}
	
	
	public function adddatagame(Request $request)
		        {
		$this->validate($request, [
									'name'=> 'required|max:15|unique:t_games',
									'category'=> 'required',
									'desc'=> 'required',
									'price'=> 'required',
									'url'=> 'required',
				                    'img' => 'required|mimes:jpeg,bmp,jpg,png|max:2000|dimensions:width=512,height=512',
				                    'banner' => 'required|mimes:jpeg,bmp,png,jpg,pngmax:2000|dimensions:min_width=1024,min_height=270'
				                ]);
		
		$max = DB::table('t_games')        
				            ->where('id', DB::raw("(select max(`id`) from t_games)"))
				            ->paginate();
		foreach($max as $row){
			$max = $row->id+1;
		}
		$imageName = 'game_icon'.-$max. 
				                $request->file('img')->getClientOriginalName();
		$path = base_path() . '/public/img_game/';
		$request->file('img')->move($path , $imageName);

		$imagebannerName = 'game_icon'.-$max. 
				                $request->file('banner')->getClientOriginalName();
		$path = base_path() . '/public/img_game/';
		$request->file('banner')->move($path , $imagebannerName);

		$masterdata = new MasterData;

		$masterdata->img = '/img_game/'.$imageName;
		$masterdata->banner = '/img_game/'.$imagebannerName;
		$masterdata->name = Input::get('name');
		$masterdata->url = Input::get('url');
		$masterdata->desc = Input::get('desc');
		$masterdata->category = Input::get('category');
		$masterdata->save();
		
		return $this->index()->withMessage('Game saved!');
	}

	public function addreviewgame(Request $request)
		        {
		
		$id=Input::get('id_game');
				$master_datas = DB::table('t_games')
				                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
				                ->join('t_rate', 't_rate.id_game', '=', 't_games.id','left outer')
				                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate, t_rate.user_name,t_rate.rate,t_rate.comment,t_rate.created_at'))
				                ->where('t_games.id',$id)
				                ->paginate();
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

		return view('public.profile',compact('user','slider'));
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
				                ->paginate();
		return view('detail', compact('master_datas'));
	}
	
	
}
