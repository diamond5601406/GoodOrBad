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
       
        $good_posts = DB::select('select * from posts where goodOrbad = 1');
        $bad_posts = DB::select('select * from posts where goodOrbad = 0');

        $goodHabits_number = count($good_posts);
        $badHabits_number = count($bad_posts);
        
        $goodHabits_percentage = round(($goodHabits_number / ($goodHabits_number + $badHabits_number)) * 100);
        $badHabits_percentage = round(($badHabits_number / ($goodHabits_number + $badHabits_number)) * 100);



        $lava = new Lavacharts;

        $reasons = $lava->DataTable();
        
        $reasons->addStringColumn('GoodOrBad')
                ->addNumberColumn('Percent')
                ->addRow(['GoodHabit', $goodHabits_percentage])
                ->addRow(['BadHabit', $badHabits_percentage]);
        
        $lava->DonutChart('Habits', $reasons, [
            'title' => 'Percentage of Habits'
        ]);

        return view('/index')->with([
            "lava" => $lava,
            "good_posts" => $good_posts,
            "bad_posts" => $bad_posts,
        ]);
    }
}
