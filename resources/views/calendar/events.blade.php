@extends('layouts.app')

@section('content')

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>    
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <h1>Calendar</h1>
    <div class="card">
        <div class="card-body">
            {!! Form::open(['action' => 'EventsController@addEvent', 'method' => 'POST']) !!}
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        {{Form::label('event_name', 'Event name')}}
                        {{Form::text('event_name','',['class'=>'form-control', 'placeholder'=>'Event name'])}}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        {{Form::label('start_date', 'Start date')}}
                        {{Form::date('start_date','',['class'=>'form-control'])}}
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        {{Form::label('end_date', 'End date')}}
                        {{Form::date('end_date','',['class'=>'form-control'])}}
                    </div>
                </div>
                <div class="col-xs-1 col-sm-1 col-md-1 text-center">&nbsp;<br/>
                    <div class="form-group">
                    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                    </div>
                </div>    
            </div>
        
            {!! Form::close() !!}
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            {!! $calendar_details->calendar() !!}
        </div>
    </div>

     {!! $calendar_details->script() !!}
  
@endsection