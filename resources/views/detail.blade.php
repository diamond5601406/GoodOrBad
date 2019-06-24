@extends('layouts.app')

@section('stylesheet')
<link rel="stylesheet" href="css/detail.css">
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                          <td>Good or Bad</td>
                          <td>{{ $data->goodOrbad }}</td>  
                        </tr>
                        <tr>
                            <td>Level</td>
                            <td>{{ $data->level }}</td>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td>{{ $data->title }}</td>
                        </tr>
                        @if(!empty($data->content))
                        <tr>
                            <td>Content</td>
                            <td>{{ $data->content }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td>Created_at</td>
                            <td>{{ $data->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
@endsection