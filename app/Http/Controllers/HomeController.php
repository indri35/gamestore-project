<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\MasterData;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master_datas = DB::table('t_games')
                ->join('t_games_rate', 't_games_rate.id_game', '=', 't_games.id','left outer')
                ->select(DB::raw('t_games.id,t_games.name,t_games.desc,t_games.category,t_games.img,t_games_rate.avg_rate,t_games_rate.user_rate'))
                ->paginate();
        return view('home', compact('master_datas'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function features()
    {
        return view('list');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function company()
    {
        return view('company');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function partners()
    {
        return view('partners');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('contact');
    }
}
