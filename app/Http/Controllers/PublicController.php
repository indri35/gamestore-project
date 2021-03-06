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
use Illuminate\Support\Facades\Session;

class PublicController extends Controller
{
	
	
	/**
	* Show the application dashboard.
		     *
		     * @return \Illuminate\Http\Response
		     */
	
	public function __construct()
		{
		$this->middleware('auth');
	}
	
	public function listusers()
			{
				$users=User::orderBy('name')->paginate(1000);
				return view('admin.user-admin',compact('users'));
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
			
		$user=Auth::user();				
		$cekuser=User::where('id',$user->id)->first();
		if($cekuser->activated==0){
			$cekuser->is_login=0;
			$cekuser->save();
			Auth::logout();
			Session::flush();
			return redirect('/');
		}
		else{

			$master_datas = Games::orderBy('created_at','DESC')->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')->paginate(9);
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
			$education = Games::orderBy('created_at','DESC')
										->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
										->WHERE('t_games.category','Education')
										->get();							
			$new_game = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->orderBy('t_games.id','DESC')
						                ->paginate(9);
			$most_played = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->orderBy('t_games.count_play','DESC')
						                ->paginate(9);
			$most_rated = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->orderBy('t_games_rate.user_rate','DESC')
						                ->paginate(9);
			$slider = DB::table('t_games')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category, t_games.banner, t_games.img,t_games.img_slider'))
						                ->orderBy('t_games.created_at','DESC')
						                ->paginate(3);
			$top_games = DB::table('t_games')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games.img_slider'))
						                ->orderBy('t_games.count_play','DESC')
						                ->paginate(9);
			$nav='all';
			if(!Auth::user()||Auth::user()->role==2){
				return view('public.home', compact('new_game','most_played','most_rated','slider','top_games','nav'));
			}else{
				return view('admin.board-admin', compact('master_datas','dashboard_count','player_count','action','adventure','casino','puzzle','education','nav'));	
			}
		}
		
	}

	public function listgames()
			{
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
			$adventure = Games::orderBy('created_at','DESC')
										->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
										->WHERE('t_games.category','Adventure')
										->get();
			$casino = Games::orderBy('created_at','DESC')
										->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
										->WHERE('t_games.category','Casual')
										->get();
			$arcade = Games::orderBy('created_at','DESC')
										->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
										->WHERE('t_games.category','Sport')
										->get();
			$puzzle = Games::orderBy('created_at','DESC')
										->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
										->WHERE('t_games.category','Puzzle')
										->get();
			$education = Games::orderBy('created_at','DESC')
										->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
										->WHERE('t_games.category','Education')
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
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.banner, t_games.coint,t_games.category,t_games.img,t_games.img_slider'))
						                ->orderBy('t_games.count_play','DESC')
						                ->paginate(3);
			$top_games = DB::table('t_games')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games.img_slider'))
						                ->orderBy('t_games.count_play','DESC')
						                ->paginate(10);
			if(!Auth::user()||Auth::user()->role==2){
				return view('public.home', compact('new_game','most_played','most_rated','slider','top_games'));
			}else{
				return view('admin.home-admin', compact('master_datas','dashboard_count','arcade','player_count','action','adventure','casino','puzzle','education'));	
			}
	}
	

		
	public function play($id)
		    {
				$user=Auth::user();				
				$cekuser=User::where('id',$user->id)->first();
				if($cekuser->activated==0){
					$cekuser->is_login=0;
					$cekuser->save();		
					Auth::logout();
					Session::flush();
					return redirect('/');
				}
				else{
				
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
					->select(DB::raw('users.id, users.name, users.phone_number as hp, users.img as img, sum(score) as score'))
					->where('idgames',$id)
					->groupby('users.id')
					->orderby('score','desc')
					->paginate(5);


				$slider = DB::table('t_games')
						        ->select(DB::raw('t_games.id,t_games.name,t_games.desc, t_games.banner, t_games.coint,t_games.category,t_games.img,t_games.img_slider'))
						        ->orderBy('t_games.count_play','DESC')
						        ->paginate(3);

						

			if(!Auth::user()){
                return redirect()->guest('login');
			}else if($master_datum == null){
				return $this->index();
			}else{
				$user=Auth::user();			
				$games = Games::Where('id',$id)->first();
				$games->count_play +=1;
				$games->save();				
	
				$plays = Plays::Where('idgames',$id)->Where('idplayer',$user->id)->first();
				if($plays==null){
					$plays = new Plays();
					$plays->idplayer = $user->id;
					$plays->idgames = $id;
					$plays->score = $games->coint;;
					$plays->save();
				}else{
					$plays->score += $games->coint;;
					$plays->save();					
				}
				$user->coint += $games->coint;
				$user->save();				
				return view('public.play', compact('user','master_datum','master_datas','top_games','slider'));
			}
		}
	}

	public function adventure()
		    {
			$nav='adventure';
			$master_datas = Games::Where('category','Adventure')->orderBy('created_at','DESC')->get();
			$new_game = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Adventure')
						                ->orderBy('t_games.id','DESC')
						                ->get();
			$most_played = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Adventure')
						                ->orderBy('t_games.count_play','DESC')
						                ->get();
			$most_rated = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Adventure')
						                ->orderBy('t_games_rate.user_rate','DESC')
						                ->get();
			$slider = DB::table('t_games')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.banner,t_games.img,t_games.img_slider'))
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
			$master_datas = Games::Where('category','Action')->orderBy('created_at','DESC')->get();

			$new_game = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Action')
						                ->orderBy('t_games.id','DESC')
						                ->get();
			$most_played = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Action')
						                ->orderBy('t_games.count_play','DESC')
						                ->get();
			$most_rated = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Action')
						                ->orderBy('t_games_rate.user_rate','DESC')
						                ->get();
			$slider = DB::table('t_games')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.banner,t_games.img,t_games.img_slider'))
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
			$master_datas = Games::Where('category','Casual')->orderBy('created_at','DESC')->get();

			$new_game = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Casual')
						                ->orderBy('t_games.id','DESC')
						                ->get();
			$most_played = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Casual')
						                ->orderBy('t_games.count_play','DESC')
						                ->get();
			$most_rated = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Casual')
						                ->orderBy('t_games_rate.user_rate','DESC')
						                ->get();
			$slider = DB::table('t_games')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.banner,t_games.category,t_games.img,t_games.img_slider'))
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
	
	public function education()
		    {
			$nav='education';
			$master_datas = Games::Where('category','Education')->orderBy('created_at','DESC')->get();
	
			$new_game = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Education')
						                ->orderBy('t_games.id','DESC')
						                ->get();
			$most_played = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Education')
						                ->orderBy('t_games.count_play','DESC')
						                ->get();
			$most_rated = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Education')
						                ->orderBy('t_games_rate.user_rate','DESC')
						                ->get();
			$slider = DB::table('t_games')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.banner,t_games.img,t_games.img_slider'))
						                ->orderBy('t_games.count_play','DESC')
						                ->paginate(3);
			$top_games = DB::table('t_games')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games.img_slider'))
						                ->orderBy('t_games.count_play','DESC')
						                ->paginate(10);
			if(!Auth::user()||Auth::user()->role==2){
				return view('public.education', compact('new_game','most_played','most_rated','slider','top_games','nav'));
			}else{
				return view('admin.education-admin', compact('master_datas','new_game','most_played','most_rated','slider','top_games','nav'));	
			}
	}
	
	public function sport()
	{
	$nav='sport';
	$master_datas = Games::Where('category','Sport')->orderBy('created_at','DESC')->get();

	$new_game = DB::table('t_games')
								->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
								->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
								->where('t_games.category','Sport')
								->orderBy('t_games.id','DESC')
								->get();
	$most_played = DB::table('t_games')
								->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
								->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
								->where('t_games.category','Sport')
								->orderBy('t_games.count_play','DESC')
								->get();
	$most_rated = DB::table('t_games')
								->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
								->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
								->where('t_games.category','Sport')
								->orderBy('t_games_rate.user_rate','DESC')
								->get();
	$slider = DB::table('t_games')
								->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.banner,t_games.img,t_games.img_slider'))
								->orderBy('t_games.count_play','DESC')
								->paginate(3);
	$top_games = DB::table('t_games')
								->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games.img_slider'))
								->orderBy('t_games.count_play','DESC')
								->paginate(10);
	if(!Auth::user()||Auth::user()->role==2){
		return view('public.arcade', compact('new_game','most_played','most_rated','slider','top_games','nav'));
	}else{
		return view('admin.arcade-admin', compact('master_datas','new_game','most_played','most_rated','slider','top_games','nav'));	
	}
}


	public function puzzle()
		    {
			$nav='puzzle';
			$master_datas = Games::Where('category','Puzzle')->orderBy('created_at','DESC')->get();

			$new_game = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Puzzle')
						                ->orderBy('t_games.id','DESC')
						                ->get();
			$most_played = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Puzzle')
						                ->orderBy('t_games.count_play','DESC')
						                ->get();
			$most_rated = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Puzzle')
						                ->orderBy('t_games_rate.user_rate','DESC')
						                ->get();
			$slider = DB::table('t_games')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.banner,t_games.img,t_games.img_slider'))
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
				$user=Auth::user();				
				$cekuser=User::where('id',$user->id)->first();
				if($cekuser->activated==0){
					$cekuser->is_login=0;
					$cekuser->save();		
					Auth::logout();
					Session::flush();
					return redirect('/');
				}
				else{

		$nav='detail';		
		$master_datas = DB::table('t_games')
				                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
				                ->join('t_rate', 't_rate.id_game', '=', 't_games.id','left outer')
				                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate, t_rate.user_name,t_rate.rate,t_rate.comment,t_rate.created_at'))
				                ->where('t_games.id',$id)
				                ->get();
		$slider = DB::table('t_games')
						        ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.banner,t_games.img,t_games.img_slider'))
						        ->orderBy('t_games.count_play','DESC')
						        ->paginate(3);
		$top_games = DB::table('t_games')
						        ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games.img_slider'))
						        ->orderBy('t_games.count_play','DESC')
						        ->paginate(5);

			if($master_datas){
				return view('public.detail', compact('master_datas','slider','top_games','nav'));
			}else{
				return $this->index();
			}
		}
	}
	
	
}
