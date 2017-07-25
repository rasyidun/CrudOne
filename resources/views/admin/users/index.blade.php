@extends('layouts.admin')


@section('content')

    @if(Session::has('deleted_user'))

        <p class="bg-danger">{{session('deleted_user')}}</p>

    @endif

    @if(Session::has('updated_user'))

        <p class="bg-danger">{{session('updated_user')}}</p>

    @endif

<h1> Users </h1>

<table class="table table-striped">
    <thead>
      <tr>
        <th>Id</th>
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Created</th>
        <th>Updated</th>
      </tr>
    </thead>
    <tbody>

    	@if($users)

    		@foreach($users as $user)

      <tr>
        <td>{{$user->id}}</td>
        <td><img height="50" src="{{$user->photo ? $user->photo->file : 'http://placehold.it/400x400'}}" alt=""></td>
        <!--
        $user->photo ? $user->photo->file : 'No Photo'
        photo ? = if the photo exist,
        $user->photo->file = i want you to print it out,
        : = if not,
        'No Photo' = i want you to display No Photo.
        -->
        <td><a href="{{route('users.edit', $user->id)}}"> {{$user->name}}</a></td>
        <td>{{$user->email}}</td>
        <td>{{$user->role->name}}</td>
        <td>{{$user->is_active == 1 ? 'Active' : 'Not Active'}}</td>
        <td>{{$user->created_at ? $user->created_at->diffForHumans() : 'No Data'}}</td>
        <td>{{$user->updated_at ? $user->updated_at->diffForHumans() : 'No Data'}}</td>
      </tr>

      		@endforeach

      @endif

    </tbody>
  </table>
</div>

</body>
</html>


@stop
