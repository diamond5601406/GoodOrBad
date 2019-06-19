@extends('layouts/app')

@section('javascript')
@endsection

@section('stylesheet')
{{-- <link rel="stylesheet" href="{{ asset('css/index.css') }}"> --}}
<link rel="stylesheet" href="css/index.css">
@endsection

@section('title', 'ホーム画面')

@section('content')
<div class="container">
<div id="chart-div"></div>
<?= $lava->render('DonutChart', 'Habits', 'chart-div') ?>
</div>

@endsection