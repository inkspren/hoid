@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>Your Days</h3>
                    @if(count($days) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($days as $day)
                                <tr>
                                    <th>{{$day->title}}</th>
                                    <td><a href="/days/{{$day->id}}/edit" class="btn btn-info">Edit</td>
                                    <td> 
                                        {!! Form::open([ 'method' => 'DELETE', 'action' => ['DaysController@destroy', $day->id], 'onsubmit' => "return ConfirmDelete()", 'class' => 'float-right']) !!}
                                        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                        {!! Form::close() !!}
                                    </td>
                                </tr> 
                            @endforeach
                        </table>
                    @else   
                        <p>You have no posts</p>    
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
