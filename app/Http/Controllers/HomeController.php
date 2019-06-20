<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Lavacharts;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $lava = new Lavacharts;

        $reasons = $lava->DataTable();
        
        $reasons->addStringColumn('GoodOrBad')
                ->addNumberColumn('Percent')
                ->addRow(['GoodHabits', 70])
                ->addRow(['BadHabits', 30]);
        
        $lava->DonutChart('Habits', $reasons, [
            'title' => 'Percentage of Habits'
        ]);

        $good_posts = DB::select('select * from posts where goodOrbad = 1');
        $bad_posts = DB::select('select * from posts where goodOrbad = 0');

        return view('/index')->with([
            "lava" => $lava,
            "good_posts" => $good_posts,
            "bad_posts" => $bad_posts
        ]);
    }
}
