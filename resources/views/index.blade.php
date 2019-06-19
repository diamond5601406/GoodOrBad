@extends('layouts/app')

@section('javascript')
@endsection

@section('stylesheet')
{{-- <link rel="stylesheet" href="{{ asset('css/index.css') "> --}}
<link rel="stylesheet" href="css/index.css">
@endsection

@section('title', 'ホーム画面')

@section('content')
<div class="container">
    <div id="chart-div"></div>
    <?= $lava->render('DonutChart', 'Habits', 'chart-div') ?>

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
                        <form mehtod="GET" action="/detail/{{ $good_post->id }}">
                            {{ csrf_field() }}
                        <td><button class="btn-primary" type="submit">詳細</button></td>
                        </form>
                        <form method="POST" action="/delete/{{ $good_post->id }}">
                            {{ csrf_field() }}
                            <td><button class="btn-danger" type="submit">削除</button></td>
                        </form>
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
                        <form mehtod="GET" action="/detail/{{ $bad_post->id }}">
                            {{ csrf_field() }}
                        <td scope="row"><button class="btn-primary" type="submit">詳細</button></td>
                        </form>
                        <form method="POST" action="/index/delete/{{ $bad_post->id }}">
                            {{ csrf_field() }}
                        <td scope="row"><button class="btn-danger" type="submit">削除</button></td>
                        </form>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div><!-- bad_col -->
    </div><!-- row -->
</div><!-- container -->

<div class="bg-dark text-white">
    <div class="container">
        <form method="POST" action="/">
            {{ csrf_field() }}
            <div class="radio-area">
                <p>Good or Bad ?</p>
                <label for="good">
                    <input type="radio" name="goodOrbad" id="good" value="1" checked>Good
                </label>
                <label for="bad">
                    <input type="radio" name="goodOrbad" id="bad" value="0">Bad
                </label>
            </div><!-- radio-area -->

            <div class="select-area">
                <label class="level" for="level">Level</label>
                <select id="level" name="level">
                    <option value="">レベルを選択してください</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div><!-- select-area-->

            <div class="title-area">
                <label class="title" for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" size="40" maxlength="20">
            </div>

            <div class="content-area">
                <label class="contents" for="content">Contents</label>
                <textarea name="content" id="content" value="{{ old('content') }}" rows="4" cols="40"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div><!-- container -->
</div><!-- bg-dark -->



@endsection