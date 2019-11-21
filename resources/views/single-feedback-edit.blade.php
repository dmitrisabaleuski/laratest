<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit Feedback</title>

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
                <form method="POST" action="{{route('feedbackUpdate',['id'=>$feedback->id])}}">
                    <input type="hidden" name="id"
                           value="{{$feedback->id}}" readonly>
                    <div class="form-group">
                        <label for="creator">Author:</label>
                        <input type="text" class="form-control" id="creator" name="author"
                               value="{{$feedback->creater}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{$feedback->email}}">
                    </div>
                    <div class="form-group">
                        <label for="text">Text:</label>
                        <textarea type="text" class="form-control" id="text" name="text">{{$feedback->text}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{$feedback->phone}}">
                    </div>
                    @if($feedback->editor != '')
                        <div class="form-group">
                            <label for="editor">Last Editor:</label>
                            <input type="text" class="form-control" id="editor" name="editor"
                                   value="{{$feedback->editor}}" readonly>
                        </div>
                    @endif
                    <input type="hidden" class="form-control" id="new_editor" name="new_editor"
                           value="{{$name}}">
                    <div class="form-group">
                        <label for="update">Last update Date:</label>
                        <input type="text" class="form-control" id="update" name="update"
                               value="{{$feedback->updated_at}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="actualStatus">Actual Status:</label>
                        <input type="text" class="form-control" id="actualStatus" name="actualStatus"
                               value="{{$array[$feedback->status]}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="status">Change Status:</label>
                        <select size="1" multiple name="status">
                            @foreach($array as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">Save</button>
                    {{csrf_field()}}
                </form>
        </div>
        <a class="btn btn-default main" role="buttom"
           href="{{route('feedbackDelete',['id'=>$feedback->id])}}">Delete</a>

    @endif
</div>
</body>
</html>
