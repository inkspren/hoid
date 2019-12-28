@extends('layouts.app')

@section('content')
    <br/>
    <h1>My Days</h1>
    @if(count($days) > 0)
        @foreach($days as $day)
       
            <div class="card card-body my-2">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/days/{{$day->id}}">{{$day->title}}</a></h3>
                    </div>
                </div>
            </div>
            
        @endforeach
        
       
    @else 
        <p>No posts match the search criteria!</p>
    @endif
   
@endsection