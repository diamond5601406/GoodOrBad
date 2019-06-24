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

    public function detail($id) 
    {
        $datas = Post::find($id);
        return view('/detail')->with('datas', $datas);
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
        $validateData = $request->validate([
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
        $data->title = $validateData->title;
        $data->content = $validateData->content;
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
        $habit->delete();
        // return $this->index();
        // header('Location: /home');
        // exit;
    }
}
