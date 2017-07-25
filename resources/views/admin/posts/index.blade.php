@extends('layouts.admin')


@section('content')

<h1> Posts </h1>

<table class="table table-striped">
    <thead>
      <tr>
        <th>Id</th>
        <th>Photo</th>
        <th>Owner</th>
        <th>Category</th>
        <th>Title</th>
        <th>body</th>
        <th>Created</th>
        <th>Updated</th>


      </tr>
    </thead>
    <tbody>

    	@if($posts)

    		@foreach($posts as $post)

      <tr>
        <td>{{$post->id}}</td>
        <td><img height="50" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/400x400' }}" alt=""></td>
        <td><a href="{{route('posts.edit', $post->id)}}">{{$post->user->name}}</a></td>
        <td>{{$post->category ? $post->category->name : 'Unknown'}}</td>
        <td>{{$post->title}}</td>
        <td>{{str_limit($post->body,20)}}</td>
        <td>{{$post->created_at->diffForhumans()}}</td>
        <td>{{$post->updated_at->diffForhumans()}}</td>
      </tr>
      
      		@endforeach

      @endif
    
    </tbody>
  </table>
</div>

</body>
</html>


@stop


