<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\PostRequest;
use Khill\Lavacharts\Lavacharts;
use Illuminate\Support\Facades\Input;

class IndexController extends Controller
{
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
                ->addRow(['GoodHabits', $goodHabits_percentage])
                ->addRow(['BadHabits', $badHabits_percentage]);
        
        $lava->DonutChart('Habits', $reasons, [
            'title' => 'Percentage of Habits',
            'color' => '#000'
        ]);

        return view('/index')->with([
            "lava" => $lava,
            "good_posts" => $good_posts,
            "bad_posts" => $bad_posts,
        ]);
    }


    public function detail($id) 
    {
        $data = Post::find($id);
        return view('/detail')->with('data', $data);
    }

    public function ajaxdetail($id) 
    {
        $data = Post::find($id);
        return view('/ajaxdetail')->with('data', $data);
    }

    public function post(Request $request)
     {
        if(Input::get('create')) {

            $this->create($request);
        }elseif(Input::get('delete')) {

            $this->delete($request);
            // return $this->delete($request);
        }
        
        return $this->index();
    }

      public function create(Request $request) 
      {
        $request->validate([
            'level' => 'required',
            'title' => 'required|max:255',
            'content' => 'max:300'
        ],[
            'level.required' => 'レベルは必須です。',
            'title.required' => 'タイトルは必須です。'
        ]);

        $data = new Post();
        $data->goodOrbad = $request->goodOrbad;
        $data->level = $request->level;
        $data->title = $request->title;
        $data->content = $request->content;
        $data->save();
      }

    // public function create(PostRequest $request) {
    //     $data = new Post();
    //     $data->goodOrbad = $request->goodOrbad;
    //     $data->level = $request->level;
    //     $data->title = $request->title;
    //     $data->content = $request->content;
    //     $data->save();
    //     header('Location: /home');
    //     exit;
    //   }

    public function delete(Request $request)
     {
        $habit = Post::find($request->id);
        if(!empty($habit)) {
            $habit->delete();    
        }
        // return $this->index();
        // header('Location: /home');
        // exit;
    }
}
