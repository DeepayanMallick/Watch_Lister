@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-6 mt-4">
    <div class="card">
      <div class="card-body">
      <h5 class="card-title">Create List</h5>
      <h6 class="card-subtitle mb-2 text-muted">Title</h6>
        <form action="{{ route('mylist.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
              <input type="text" name="title" value="" placeholder="Enter Title " class="form-control" >
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>

  <div class="col-md-6 mt-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">My List</h5>
        <div class="row">
        @foreach ($listings as $listing)
          <div class="col-md-4">
            <h5><a href="/mylist/{{$listing->id}}"><strong>{{$listing->title}}</strong></a></h5>
            <a href="/mylist/{{$listing->id}}/edit" class="btn btn-primary">Edit</a> 
            <form action="{{ route('mylist.destroy', $listing->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>            
          </div>
        @endforeach  
                   
        </div>
        
      </div>
    </div>
  </div>
</div>


@endsection