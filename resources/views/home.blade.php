@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome {{ auth()->user()->name }}!</div>

                <div class="panel-body">
                    
                        <li>You are logged in! </li>
                        <li><a href="{{route('users.index')}}">Click Here</a> to go through your Dashboard.</li>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
