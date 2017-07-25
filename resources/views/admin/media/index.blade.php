@extends('layouts.admin')


@section('content')


<h1> Media </h1>

<table class="table table-striped">
    <thead>
      <tr>
        <th>Id</th>
        <th>Photo</th>
        <th>Name</th>
        <th>Created</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>

    		@foreach($photos as $photo)

      <tr>
        <td>{{$photo->id}}</td>
        <td><img height="50" src="{{$photo->file ? $photo->file : 'http://placehold.it/400x400'}}" alt=""></td>
        <td>{{$photo->name}}</td>
        <td>{{$photo->created_at ? $photo->created_at : 'No Date'}}</td>
        <td>

            {!! Form::open(['method'=>'DELETE' , 'action' => ['AdminMediaController@destroy',$photo->id ]]) !!}

            <div class="form-group">
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            </div>
            {!! Form::close() !!}

        </td>
        
      </tr>
      
      		@endforeach
    
    </tbody>
  </table>
</div>

</body>
</html>


@stop