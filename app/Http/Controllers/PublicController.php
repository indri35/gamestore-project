<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\MasterData;
use App\User;
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
			$master_datas = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games.price,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->paginate();
			return view('home', compact('master_datas'));
	}
	
		
	public function play()
		    {
			if(!Auth::user()){
                return redirect()->guest('login');
			}else{
				$user=Auth::user();
				return view('play', compact('user'));
			}
	}

	public function adventure()
		    {
			$master_datas = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games.price,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Adventure')
						                ->paginate();
			return view('adventure', compact('master_datas'));
	}
	

	public function action()
		    {
			$master_datas = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games.price,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Action')
						                ->paginate();
			return view('action', compact('master_datas'));
	}
	
	
	
	public function casino()
		    {
			$master_datas = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games.price,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Casino')
						                ->paginate();
			return view('casino', compact('master_datas'));
	}
	
	public function sports()
		    {
			$master_datas = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games.price,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Sports')
						                ->paginate();
			return view('sports', compact('master_datas'));
	}
	
	public function puzzle()
		    {
			$master_datas = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games.price,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Puzzle')
						                ->paginate();
			return view('puzzle', compact('master_datas'));
	}
	
		
	public function detail($id)
		    {
		$master_datas = DB::table('t_games')
				                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
				                ->join('t_rate', 't_rate.id_game', '=', 't_games.id','left outer')
				                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games.price,t_games_rate.avg_rate,t_games_rate.user_rate, t_rate.user_name,t_rate.rate,t_rate.comment,t_rate.created_at'))
				                ->where('t_games.id',$id)
				                ->paginate();
		return view('detail', compact('master_datas'));
	}
	
	
}
