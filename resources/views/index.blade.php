@extends('layouts/app')

@section('javascript')
@endsection

@section('stylesheet')
{{-- <link rel="stylesheet" href="{{ asset('css/index.css') "> --}}
<link rel="stylesheet" href="css/index.css">
@endsection

@section('title', 'ホーム画面')

@section('content')
<div id="list">
    <div class="container">
        <div id="chart-div" style="margin-top: 18px;"></div>
        <?= $lava->render('DonutChart', 'Habits', 'chart-div') ?>

        <div id="detail" style="display: none;">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Good or Bad</td>
                                    <td id="goodOrbad"></td>  
                                </tr>
                                <tr>
                                    <td>Level</td>
                                    <td id="level"></td>
                                </tr>
                                <tr>
                                    <td>Title</td>
                                    <td id="title"></td>
                                </tr>
                                
                                <tr id="content_row">
                                    <td>Content</td>
                                    <td id="content"></td>
                                </tr>
                                
                                <tr>
                                    <td>Created_at</td>
                                    <td id="created_at"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td style="text-align: right;">
                                            <a href="#" onclick="view_list(); return false;"><button class="btn-primary">戻る</button></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col good-col">
                <table class="table table-active good_table">
                    @foreach($good_posts as $good_post)
                    <thead>
                        <tr class="table-info">
                            <th scope="col">Lv</th>
                            <th scope="col">Title</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-info">
                            <td>{{ $good_post->level }}</td>
                            <td><div class="table-div">{{ $good_post->title }}</div></td>
                            <td>
                                <a href="#" onclick="view_detail({{$good_post->id}}); return false;"><button class="btn-primary">詳細</button></a>
                            </td>
                            <td>
                                <form method="POST" action="/home">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{ $good_post->id }}">
                                    <input class="btn-danger btn-destroy" name="delete" type="submit" value="削除">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div><!-- good_col -->

            <div class="col bad-col">
                <table class="table table-active bad_table">
                    @foreach($bad_posts as $bad_post)
                    <thead>
                        <tr class="table-danger">
                            <th scope="col">Lv</th>
                            <th scope="col">Title</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-danger">
                            <td scope="row">{{ $bad_post->level }}</td>
                            <td scope="row"><div class="table-div">{{ $bad_post->title }}</td>
                            <td>
                                <a href="#" onclick="view_detail({{$bad_post->id}}); return false;"><button class="btn-primary">詳細</button></a>
                            </td>
                            <td>
                                <form method="POST" action="/home">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{ $bad_post->id }}">
                                    <input class="btn-danger btn-destroy" name="delete" type="submit" value="削除">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div><!-- bad_col -->
        </div><!-- row -->
    </div><!-- container -->
</div><!-- list -->


    <div class="bg-dark text-white">
        <div class="container">
            <div class="card bg-light m-5 p-3">
                    <div class="card-body">
                        <h2 class="card-title">Make a Habit</h2>
                        <form method="POST" action="/home">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="radio-area">
                                    <p>Good or Bad ?</p>
                                    <label for="good">
                                        <input type="radio" name="goodOrbad" id="good" value="1" checked>Good
                                    </label>
                                    <label for="bad">
                                        <input type="radio" name="goodOrbad" id="bad" value="0">Bad
                                    </label>
                                </div><!-- radio-area -->
                            </div>
                            <div class="form-group">
                                    <div class="select-area">
                                        <label class="level" for="level">Level</label>
                                            @if($errors->has('level'))
                                            <div class="text-danger">
                                                {{ $errors->first('level') }}
                                            </div>
                                            @endif
                                        <select class="form-control" id="level" name="level">
                                            <option value="">レベルを選択してください</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div><!-- select-area-->
                            </div>

                            <div class="form-group">
                                    <div class="title-area">
                                        <label class="title" for="title">Title</label>
                                            @if($errors->has('title'))
                                            <div class="text-danger">
                                                {{ $errors->first('title') }}
                                            </div>
                                            @endif
                                        <input class="form-control" type="text" name="title" id="title" value="{{ old('title') }}" size="40" maxlength="20" >
                                    </div>
                            </div>

                            <div class="form-group">
                                    <div class="content-area">
                                        <label class="contents" for="content">Contents</label>
                                            @if($errors->has('content'))
                                            <div class="text-danger">
                                                {{ $errors->first('content') }}
                                            </div>
                                            @endif
                                        <textarea class="form-control" name="content" id="content" value="{{ old('content') }}" rows="4" cols="40"></textarea>
                                    </div>
                            </div>
                        <input type="submit" name="create" class="btn btn-primary" value="Submit">
                        </form>
                    </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- container -->
    </div><!-- bg-dark -->
    @section('script')
            <script>    
                $(function(){
                    $(".btn-destroy").click(function(){
                        if(confirm("本当に削除しますか？")){
            
                        }else{
                            //cancel
                            return false;
                        }
                    });
                });

                view_detail = function(id) {
                    // alert(id);
                    // $('#list').hide();
                    $('#detail').show();
                    // console.log($('#goodOrbad'))
                    // $('#goodOrbad').html('good');

                    $.ajax({
                    url:'/home/ajaxdetail/'+id,
                    type:'GET',
                    data:{
                    }
                    })
                    // Ajaxリクエストが成功した時発動
                    .done( (data) => {
                        $('.result').html(data);
                        console.log(data);
                        let array_data = data.split("\n");
                        console.log(array_data);
                        let goodOrbad = array_data[0];
                        if(goodOrbad == 1) {
                            goodOrbad = 'Good';
                        }else{
                            goodOrbad = 'Bad';
                        }
                        $('#goodOrbad').html(goodOrbad);
                        let level = array_data[1];
                        $('#level').html(level);
                        let title = array_data[2];
                        $('#title').html(title);
                        let content = array_data[3];
                        console.log(content.length);
                        if(content == "") {
                            $('#content_row').hide();
                        }else {
                            $('#content_row').show();
                        }
                        $('#content').html(content);
                        let created_at = array_data[4];
                        $('#created_at').html(created_at);
                    })
                    // Ajaxリクエストが失敗した時発動
                    .fail( (data) => {
                        $('.result').html(data);
                        console.log(data);
                    })
                    // Ajaxリクエストが成功・失敗どちらでも発動
                    .always( (data) => {

                    });
                }

                view_list = function() {
                    $('#list').show();
                    $('#detail').hide();
                }
            </script>
    @endsection
@endsection
