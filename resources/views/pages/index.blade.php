@extends('layouts.app')

@section('content')
    @guest
        <div class="jumbotron text-center">
            <h1>Welcome To Hoid!</h1>
            <p>This is a laravel application where you can write notes about your day,<br/> 
            upload your daily picture, save your quote of the day...</p>
            <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
        </div>
    @endguest
    @auth
        <div class="jumbotron text-center">
            <h1>Welcome To Hoid!</h1>
        </div>
    @endauth
@endsection
