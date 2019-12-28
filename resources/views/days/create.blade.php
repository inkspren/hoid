@extends('layouts.app')

@section('content')
    <h1>Create a new entry</h1>
    {!! Form::open(['action' => 'DaysController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title','',['class'=>'form-control', 'placeholder'=>'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('quote', 'Quote of the day')}}
            {{Form::textarea('quote','',['class'=>'form-control', 'rows'=>"2", 'placeholder'=>'Your quote of the day'])}}
        </div>
        <div class="form-group">
            {{Form::label('notes', 'Notes about your day')}}
            {{Form::textarea('notes','',['class'=>'ckeditor', 'rows'=>"5", 'placeholder'=>'How was your day'])}}
        </div>
        <div class="form-group">
            {{Form::label('picture', 'Upload a picture of the day')}}
            {{Form::file('picture')}}
            <br/>
            {{Form::label('picture_caption', 'Caption your picture')}}
            {{Form::text('picture_caption','',['class'=>'form-control', 'placeholder'=>'Picture caption'])}}
        </div>
        <div class="form-group">
            {{Form::label('video', 'Video')}}
            {{Form::text('video','',['class'=>'form-control', 'placeholder'=>'Paste YouTube video URL'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection