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

class DevController extends Controller
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
								                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games.price,t_games_rate.avg_rate,t_games_rate.user_rate'))
								                ->paginate();
				return view('user.home-user', compact('master_datas'));
			}
			elseif($user->role=='1'){
				$master_datas = DB::table('t_games')
								                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
								                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games.price,t_games_rate.avg_rate,t_games_rate.user_rate'))
								                ->paginate();
				return view('admin.home-admin', compact('master_datas'));
			}
		}
		else{
			$master_datas = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games.price,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->paginate();
			return view('user.home-user', compact('master_datas'));
		}
	}
	
	public function adventure()
		    {
		$user = Auth::user();
		if($user->role=='2'){
			$master_datas = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games.price,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Adventure')
						                ->paginate();
			return view('adventure', compact('master_datas'));
		}
		else{
			$master_datas = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games.price,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Adventure')
						                ->paginate();
			return view('admin.adventure-admin', compact('master_datas'));
		}
	}
	
	
	public function adddatagame(Request $request)
		        {
		$this->validate($request, [
				                    'img' => 'required'
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
		$masterdata = new MasterData;
		$masterdata->img = '/img_game/'.$imageName;
		$masterdata->name = Input::get('name');
		$masterdata->desc = Input::get('desc');
		$masterdata->category = Input::get('category');
		$masterdata->price = Input::get('price');
		$masterdata->save();
		
		return $this->index()->withMessage('Game saved!');
	}
	
	public function action()
		    {
		$user = Auth::user();
		if($user->role=='2'){
			$master_datas = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games.price,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Action')
						                ->paginate();
			return view('action', compact('master_datas'));
		}
		else{
			$master_datas = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games.price,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Action')
						                ->paginate();
			return view('admin.action-admin', compact('master_datas'));
		}
	}
	
	
	
	public function casino()
		    {
		$user = Auth::user();
		if($user->role=='2'){
			$master_datas = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games.price,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Casino')
						                ->paginate();
			return view('casino', compact('master_datas'));
		}
		else{
			$master_datas = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games.price,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Casino')
						                ->paginate();
			return view('admin.casino-admin', compact('master_datas'));
		}
	}
	
	public function sports()
		    {
		$user = Auth::user();
		if($user->role=='2'){
			$master_datas = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games.price,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Sports')
						                ->paginate();
			return view('sports', compact('master_datas'));
		}
		else{
			$master_datas = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games.price,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Sports')
						                ->paginate();
			return view('admin.sports-admin', compact('master_datas'));
		}
	}
	
	public function puzzle()
		    {
		$user = Auth::user();
		if($user->role=='2'){
			$master_datas = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games.price,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Puzzle')
						                ->paginate();
			return view('puzzle', compact('master_datas'));
		}
		else{
			$master_datas = DB::table('t_games')
						                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
						                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games.price,t_games_rate.avg_rate,t_games_rate.user_rate'))
						                ->where('t_games.category','Puzzle')
						                ->paginate();
			return view('admin.puzzle-admin', compact('master_datas'));
		}
	}
	
	
	public function addgameadventure()
		    {
		$user = Auth::user();
		return view('admin.addgameadventure');
	}
	public function play()
		    {
    		$user = Auth::user();
	    	return view('admin.addgameadventure');
	}
	
	
	public function addgameaction()
		    {
		$user = Auth::user();
		return view('admin.addgameaction');
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
				                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games.price,t_games_rate.avg_rate,t_games_rate.user_rate, t_rate.user_name,t_rate.rate,t_rate.comment,t_rate.created_at'))
				                ->where('t_games.id',$id)
				                ->paginate();
		return view('detail', compact('master_datas'));
	}
	
	
}
