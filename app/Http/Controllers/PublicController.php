<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\MasterData;
use App\User;
use App\Models\Games;
use App\Models\Plays;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use JWTAuth;


class PublicController extends Controller
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
	
	public function getDataBarChart()
	    {
			$bar_chart =  DB::table('t_games')->get();
			return $bar_chart;
		}

		public function getgames(Request $request, $take)
		{	
			$user = JWTAuth::parseToken()->toUser();			
			$data = Games::inRandomOrder()->take($take)->skip(0)->get();
			foreach($data as $item){
				$item->url_game = url('/').'/detail/'.$item->id;;
			}
			
			$status=true;
			return compact('status','data');
		}
		
	public function index()
			{
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
			$nav='all';
			if(!Auth::user()||Auth::user()->role==2){
				return view('public.home', compact('new_game','most_played','most_rated','slider','top_games','nav'));
			}else{
				return view('admin.board-admin', compact('master_datas','dashboard_count','player_count','action','adventure','casino','puzzle','sports','nav'));	
			}
	}

	public function listgames()
			{
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
			if(!Auth::user()||Auth::user()->role==2){
				return view('public.home', compact('new_game','most_played','most_rated','slider','top_games'));
			}else{
				return view('admin.home-admin', compact('master_datas','dashboard_count','player_count','action','adventure','casino','puzzle','sports'));	
			}
	}
	

		
	public function play($id)
		    {
				$master_datum = DB::table('t_games')
						->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						->join('t_rate', 't_rate.id_game', '=', 't_games.id','left outer')
						->select(DB::raw('t_games.id,t_games.name,t_games.name,t_games.desc,t_games.url,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate, t_rate.user_name,t_rate.rate,t_rate.comment,t_rate.created_at'))
						->where('t_games.id',$id)
						->first();

				$master_datas = DB::table('t_games')
						->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						->join('t_rate', 't_rate.id_game', '=', 't_games.id','left outer')
						->select(DB::raw('t_games.id,t_games.name,t_games.name,t_games.desc,t_games.url,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate, t_rate.user_name,t_rate.rate,t_rate.comment,t_rate.created_at'))
						->where('t_games.id',$id)
						->paginate(3);

						$top_games = DB::table('t_play_games')
							->join('users', 'users.id', '=', 't_play_games.idplayer','left')						
							->select(DB::raw('users.id,users.name, users.img as img, count(score) as score'))
							->where('idgames',$id)
							->groupby('users.id')
							->orderby('score','desc')
							->paginate(5);


				$slider = DB::table('t_games')
						        ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games.img_slider'))
						        ->orderBy('t_games.count_play','DESC')
						        ->paginate(3);

						

			if(!Auth::user()){
                return redirect()->guest('login');
			}else if($master_datum == null){
				return $this->index();
			}else{
				$user=Auth::user();				
				$plays = Plays::Where('idgames',$id)->Where('idplayer',$user->id)->first();
				if($plays==null){
					$plays = new Plays();
					$plays->idplayer = $user->id;
					$plays->idgames = $id;
					$plays->score = 0;
					$plays->subscription = 5;
					$plays->save();
				}
				$games = Games::Where('id',$id)->first();
				$games->count_play +=1;
				$games->save();				
				$user->coint -=$games->coint;
				$user->save();				
				return view('public.play', compact('user','master_datum','master_datas','top_games','slider'));
			}
	}

	public function adventure()
		    {
			$nav='adventure';
			$master_datas = Games::Where('category','Adventure')->orderBy('created_at','DESC')->paginate();
			$new_game = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Adventure')
						                ->orderBy('t_games.id','DESC')
						                ->paginate();
			$most_played = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Adventure')
						                ->orderBy('t_games.count_play','DESC')
						                ->paginate();
			$most_rated = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Adventure')
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
			if(!Auth::user()||Auth::user()->role==2){
				return view('public.adventure', compact('new_game','most_played','most_rated','slider','top_games','nav'));
			}else{
				return view('admin.adventure-admin', compact('master_datas','new_game','most_played','most_rated','slider','top_games','nav'));	
			}
	}
	

	public function action()
		    {
			$nav='action';
			$master_datas = Games::Where('category','Action')->orderBy('created_at','DESC')->paginate();

			$new_game = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Action')
						                ->orderBy('t_games.id','DESC')
						                ->paginate();
			$most_played = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Action')
						                ->orderBy('t_games.count_play','DESC')
						                ->paginate();
			$most_rated = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Action')
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
			if(!Auth::user()||Auth::user()->role==2){
				return view('public.action', compact('new_game','most_played','most_rated','slider','top_games','nav'));
			}else{
				return view('admin.action-admin', compact('master_datas','new_game','most_played','most_rated','slider','top_games','nav'));	
			}
	}
	
	
	
	public function casino()
		    {
			$nav='casino';
			$master_datas = Games::Where('category','Casino')->orderBy('created_at','DESC')->paginate();

			$new_game = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Casino')
						                ->orderBy('t_games.id','DESC')
						                ->paginate();
			$most_played = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Casino')
						                ->orderBy('t_games.count_play','DESC')
						                ->paginate();
			$most_rated = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Casino')
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
			if(!Auth::user()||Auth::user()->role==2){
				return view('public.casino', compact('new_game','most_played','most_rated','slider','top_games','nav'));
			}else{
				return view('admin.action-admin', compact('master_datas','new_game','most_played','most_rated','slider','top_games','nav'));	
			}
	}
	
	public function sports()
		    {
			$nav='sport';
			$master_datas = Games::Where('category','Sports')->orderBy('created_at','DESC')->paginate();
	
			$new_game = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Sports')
						                ->orderBy('t_games.id','DESC')
						                ->paginate();
			$most_played = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Sports')
						                ->orderBy('t_games.count_play','DESC')
						                ->paginate();
			$most_rated = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Sports')
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
			if(!Auth::user()||Auth::user()->role==2){
				return view('public.sports', compact('new_game','most_played','most_rated','slider','top_games','nav'));
			}else{
				return view('admin.sports-admin', compact('master_datas','new_game','most_played','most_rated','slider','top_games','nav'));	
			}
	}
	
	public function puzzle()
		    {
			$nav='puzzle';
			$master_datas = Games::Where('category','Puzzle')->orderBy('created_at','DESC')->paginate();

			$new_game = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Puzzle')
						                ->orderBy('t_games.id','DESC')
						                ->paginate();
			$most_played = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Puzzle')
						                ->orderBy('t_games.count_play','DESC')
						                ->paginate();
			$most_rated = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Puzzle')
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
			if(!Auth::user()||Auth::user()->role==2){
				return view('public.puzzle', compact('new_game','most_played','most_rated','slider','top_games','nav'));
			}else{
				return view('admin.puzzle-admin', compact('master_datas','new_game','most_played','most_rated','slider','top_games','nav'));	
			}
	}
	
		
	public function detail($id=null)
		    {
		$nav='detail';
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
						        ->paginate(5);

			if($master_datas->count() > 0){
				return view('public.detail', compact('master_datas','slider','top_games','nav'));
			}else{
				return $this->index();
			}
	}
	
	
}
