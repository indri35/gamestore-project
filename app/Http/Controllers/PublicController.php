<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\MasterData;
use App\User;
use App\Models\Games;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

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
	
	public function index()
			{
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
			if(!Auth::user()){
				return view('public.home', compact('new_game','most_played','most_rated','slider','top_games'));
			}else{
				return view('public.home', compact('new_game','most_played','most_rated','slider','top_games'));	
			}
	}
	
		
	public function play($id)
		    {
				$master_datas = DB::table('t_games')
						->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						->join('t_rate', 't_rate.id_game', '=', 't_games.id','left outer')
						->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.coint,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate, t_rate.user_name,t_rate.rate,t_rate.comment,t_rate.created_at'))
						->where('t_games.id',$id)
						->paginate();

				$top_games = DB::table('t_play_games')
						->join('users', 'users.id', '=', 't_play_games.idplayer','left')						
						->select('users.id','users.name','users.img as img','score')
						->where('idgames',$id)
						->paginate(10);

						

			if(!Auth::user()){
                return redirect()->guest('login');
			}else if($master_datas->count() < 0){
				return $this->index();
			}else{
				$user=Auth::user();
				
				$games = Games::Where('id',$id)->first();
				$games->count_play +=1;
				$games->save();				
				
				return view('public.play', compact('user','master_datas','top_games'));
			}
	}

	public function adventure()
		    {
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
			if(!Auth::user()){
				return view('public.adventure', compact('new_game','most_played','most_rated','slider','top_games'));
			}else{
				return view('public.adventure', compact('new_game','most_played','most_rated','slider','top_games'));	
			}
	}
	

	public function action()
		    {
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
			if(!Auth::user()){
				return view('public.action', compact('new_game','most_played','most_rated','slider','top_games'));
			}else{
				return view('public.action', compact('new_game','most_played','most_rated','slider','top_games'));	
			}
	}
	
	
	
	public function casino()
		    {
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
			if(!Auth::user()){
				return view('public.casino', compact('new_game','most_played','most_rated','slider','top_games'));
			}else{
				return view('public.casino', compact('new_game','most_played','most_rated','slider','top_games'));	
			}
	}
	
	public function sports()
		    {
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
			if(!Auth::user()){
				return view('public.sports', compact('new_game','most_played','most_rated','slider','top_games'));
			}else{
				return view('public.sports', compact('new_game','most_played','most_rated','slider','top_games'));
			}
	}
	
	public function puzzle()
		    {
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
			if(!Auth::user()){
				return view('public.puzzle', compact('new_game','most_played','most_rated','slider','top_games'));
			}else{
				return view('puzzle', compact('new_game','most_played','most_rated','slider','top_games'));	
			}
	}
	
		
	public function detail($id)
		    {
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
			if($master_datas->count() > 0){
				return view('public.detail', compact('master_datas','slider','top_games'));
			}else{
				return $this->index();
			}
	}
	
	
}
