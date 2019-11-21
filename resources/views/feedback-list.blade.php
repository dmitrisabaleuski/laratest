<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>All Feedback</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
@if (Route::has('login'))
    <div class="top-right links">
        <a href="{{ url('/') }}">Main</a>
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
<div class="col-xl-12 col-md-12 col-sm-12 col-xs-12">
    <ul id="feedbacks-list">
        @forelse ($feedback as $feedbacks)
            <li>
                <div class="feedbacks-admin col-xl-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 email">
                        <p> Auhtor Email: <b> {{$feedbacks->email}} </b></p>
                    </div>
                    <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 text">
                        <p> Feedback text: <b> {{$feedbacks->text}}</b></p>
                    </div>
                </div>
                <ul id="actions">
                    <li>Status:
                        @if($feedbacks->status == 0)
                            Not Viewed
                        @else
                            Viewed
                        @endif
                    </li>
                    <li><a class="btn btn-default main" role="buttom"
                           href="{{route('feedbackShow',['id'=>$feedbacks->id])}}">Viewed</a></li>
                    <a class="btn btn-default main" role="buttom"
                       href="{{route('feedbackEdit',['id'=>$feedbacks->id])}}">Edit</a>
                    <a class="btn btn-default main" role="buttom"
                       href="{{route('feedbackDelete',['id'=>$feedbacks->id])}}">Delete</a>
                </ul>
            </li>
            @empty
                <h1>No Feedback</h1>
            @endforelse
    </ul>
</div>
</body>
</html>
