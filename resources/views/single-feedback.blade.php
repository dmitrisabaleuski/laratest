<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>View Feedback</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
@if (Route::has('login'))
    <div class="top-right links">
        <a href="{{ url('/') }}">Main</a>
        <a href="{{ url('/admin/feedback-list') }}">All Feedbacks</a>
        @auth
            <a href="{{ url('/admin') }}">Admin</a>
            <a href="{{ url('/home') }}">Home</a>
            {{$name = Auth::user()->name}}
            {{$email = Auth::user()->email}}
        @else
            {{$name = ''}}
            {{$email = ''}}
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        @endauth
    </div>
@endif
{{$name}}
<div class="single-feedback col-xl-12 col-md-12 col-sm-12 col-xs-12">
    @if($feedback)
        <div>
            <p class="feed-info">Author: {{$feedback->creater}}</p>
            <p class="feed-info">Email: {{$feedback->email}}</p>
            <p class="feed-info">Text: {{$feedback->text}}</p>
            <p class="feed-info">Phone: {{$feedback->phone}}</p>
            @if($feedback->editor != '')
                <p>Last Editor {{$feedback->editor}}</p>
            @endif
            <p>Update Date: {{$feedback->updated_at}}</p>
            <p class="feed-info">Status: {{$status}}</p>
        </div>
        <div>
            <a class="btn btn-default main" role="buttom"
               href="{{route('feedbackEdit',['id'=>$feedback->id])}}">Edit</a>
            <a class="btn btn-default main" role="buttom"
               href="{{route('feedbackDelete',['id'=>$feedback->id])}}">Delete</a>
        </div>


    @endif
</div>
</body>
</html>
