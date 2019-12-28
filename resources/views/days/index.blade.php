@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10 col-sm-12">
            <h1>My Days</h1> 
        </div>
        <div class="col-md-2 col-sm-12">
            <a a href="/days/create" class="btn btn-outline-secondary float-right">New Post</a>
        </div>
    </div>
    @if(count($days) > 0)
        @foreach($days as $day)
       
            <div class="card card-body my-2 border-secondary">
                <div class="row">
                    @if(!empty($day->picture))
                    <div class="col-md-4 col-sm-4">
                        <img style="width:100%" src="/storage/pictures/{{$day->picture}}">
                    </div>
                    @endif
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/days/{{$day->id}}">{{$day->title}}</a></h3>
                        <small>Created on {{$day->created_at->format('d/m/Y')}}</small>
                    </div>
                </div>
            </div>
            
        @endforeach
        {{$days->links()}}
       
    @else 
        <p>You don't have any posts!</p>
    @endif
     
@endsection