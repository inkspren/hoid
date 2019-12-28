@extends('layouts.app')

@section('content')
    <a href="/days" class="btn btn-outline-secondary">Back</a>
    <br/><br/>
    <h1>{{$day->title}}</h1>
    <small>Created on {{$day->created_at->format('d/m/Y')}}</small>
    <hr>
    <h4>Quote of the day:</h4>
        <div class="card card-body my-2 border-secondary">
            @if(empty($day->quote))
                You don't have any quotes
            @else 
                {!!$day->quote!!}
            @endif   
        </div>
    <br/>
    <h4>Notes about your day:</h4>
    <div class="card card-body my-2 border-secondary">
        @if(empty($day->notes))
            <p>You don't have any notes for this day</p>
        @else 
            {!!$day->notes!!}
        @endif
    </div>
    <br/>
    <h4>Your picture of the day:</h4>
    <div class="card card-body my-2 border-secondary">
        @if(empty($day->picture))
            <p>You didn't upload a picture of the day</p>
        @else 
            <img stlye="width:100%; max-width:300px" src="/storage/pictures/{{$day->picture}}"  id="picture" alt="{{$day->picture_caption}}">
            <div id="myModal" class="modal">
                <span class="close">&times;</span>
                <img class="modal-content" id="img01">
                <div id="caption"></div>
            </div>  
        @endif
        @if(empty($day->picture_caption))

        @else 
            {!! $day->picture_caption !!}
        @endif
    </div>
    <br/>
    <h4>Your video of the  day:</h4>
    <div class="card card-body my-2 border-secondary">
        @if(empty($day->video))
            <p>You didn't upload a video of the day</p>
        @else
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" width="560" height="349"
                src="https://www.youtube.com/embed/{{$day->video}}">
                </iframe>
            </div>
        @endif
    </div>
    <hr>
    <a href="/days/{{$day->id}}/edit" class="btn btn-info">Edit</a>
    {!! Form::open([ 'method' => 'DELETE', 'action' => ['DaysController@destroy', $day->id], 'onsubmit' => "return ConfirmDelete()", 'class' => 'float-right']) !!}
    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
    {!! Form::close() !!}

<script>
function resizeImage(img) {
  img.style.width = "500px";
  img.style.height = "500px";
}
</script>
@endsection


