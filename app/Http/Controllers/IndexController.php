<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;

class IndexController extends Controller
{
    public function index() {
        $lava = new Lavacharts;

        $reasons = $lava->DataTable();
        
        $reasons->addStringColumn('GoodOrBad')
                ->addNumberColumn('Percent')
                ->addRow(['GoodHabits', 70])
                ->addRow(['BadHabits', 30]);
        
        $lava->DonutChart('Habits', $reasons, [
            'title' => 'Percentage of Habits'
        ]);

        return view('/index', compact('lava'));
    }
}
