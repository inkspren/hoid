@extends('layouts.app')

@section('content')
    <h1>Edit your day</h1>
    {!! Form::open(['action' => ['DaysController@update', $day->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $day->title,['class'=>'form-control', 'placeholder'=>'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('quote', 'Quote of the day')}}
            {{Form::textarea('quote', $day->quote,['class'=>'form-control', 'rows'=>"2", 'placeholder'=>'Your quote of the day'])}}
        </div>
        <div class="form-group">
            {{Form::label('notes', 'Notes about your day')}}
            {{Form::textarea('notes', $day->notes ,['class'=>'ckeditor', 'rows'=>"5", 'placeholder'=>'How was your day'])}}
        </div>
        <div class="form-group">
            {{Form::label('picture', 'Upload a picture of the day')}}
            {{Form::file('picture')}}
            <br/>
            {{Form::label('picture_caption', 'Caption your picture')}}
            {{Form::text('picture_caption', $day->picture_caption, ['class'=>'form-control', 'placeholder'=>'Picture caption'])}}
        </div>
        <div class="form-group">
            {{Form::label('video', 'Video')}}
            {{Form::text('video','',['class'=>'form-control', 'placeholder'=>'Paste YouTube video URL'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection