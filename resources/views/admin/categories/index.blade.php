@extends('layouts.admin')



@section('content')

<h1> Categories</h1>

	<div class="col-sm-6">
		{!! Form::open(['method'=>'POST' , 'action' => 'AdminCategoriesController@store']) !!}
	     	 <div class="form-group">
		      {!! Form::label('name', 'Name:') !!}
		      {!! Form::text('name', null, ['class' => 'form-control']) !!}
		    	</div>
		     <div class="form-group">
		        {!! Form::submit('Create', ['class' => 'btn btn-primary col-sm-6']) !!}
		        </div>
		 {!! Form::close() !!}

	</div>


	<div class="col-sm-6">
		@if($categories)
	<table class="table table-striped">
	    <thead>
	      <tr>
	        <th>id</th>
	        <th>Name</th>
	        <th>Created Date</th>
	      </tr>
	    </thead>
	    <tbody>
	    	@foreach($categories as $category)
	      <tr>
	        <td>{{$category->id}}</td>
	        <td><a href="{{route('categories.edit', $category->id)}}">{{$category->name}}</a></td>
	    
	        <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'No Data'}}</td>
					<td>{{$category->updated_at ? $category->updated_at->diffForHumans() : 'No Data'}}</td>
						<!-- ? => if,
	        		$category->created_at->diffForHumans() => if $category have a date, then display diffForHumans()
	        		: => if not,
	        		'No Data' => if not, then display 'No Data'
	        	-->
	      </tr>
	      	@endforeach
	    </tbody>
    </table>
    	@endif
	</div>




@stop
