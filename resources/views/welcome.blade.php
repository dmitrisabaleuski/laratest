<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Feedback</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
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

            <div class="content">
                <div class="title m-b-md">
                    Feedback Form
                </div>
                <form method="POST" action="{{route('sendFeedback')}}">
                    <div class="form-group">
                        <label for="title">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$name}}">
                    </div>
                    <div class="form-group">
                        <label for="shortDisc">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{$email}}">
                    </div>
                    <div class="form-group">
                        <label for="shortDisc">Phone Number</label>
                        <input type="text" class="form-control" id="number" name="number">
                    </div>
                    <div class="form-group">
                        <label for="foolCont">Feedback Text</label>
                        <textarea type="text" class="form-control" id="feedback" name="feedback"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">Send</button>
                    {{csrf_field()}}
                </form>

            </div>
        </div>
    </body>
</html>
