<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\PostRequest;
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

        $good_posts = DB::select('select * from posts where goodOrbad = 1');
        $bad_posts = DB::select('select * from posts where goodOrbad = 0');

        return view('/index')->with([
            "lava" => $lava,
            "good_posts" => $good_posts,
            "bad_posts" => $bad_posts
        ]);
    }

    public function create(PostRequest $request) {
        $data = new Post();
        $data->goodOrbad = $request->goodOrbad;
        $data->level = $request->level;
        $data->title = $request->title;
        $data->content = $request->content;
        $data->save();

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

    public function detail($id) {
        $datas = Post::find($id);
        return view('/detail')->with('datas', $datas);
    }

    // public function show() {
    //     $posts = DB::select('select * from posts where goodOrbad = 1');
    //     return view('/index')->with('posts', $posts);
    // }
}
