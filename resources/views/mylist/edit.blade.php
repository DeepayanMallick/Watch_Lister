@extends('layouts.app')

@section('content')
<a href="/mylist"  class="btn btn-default">Go back</a>
<h1>My List</h1>
<form action="{{ route('mylist.update', $list->id)}}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
    <div class="form-group">
      <label for="name">Title:</label>
      <input type="text" name="title" value="{{ $list->title }}" placeholder="Enter Name" class="form-control" >
    </div>
      <label for="privacy_id">Privacy:</label>
      <select class="form-control" id="privacy_id" name="privacy_id" value="">
        <option value="1">Private</option>
        <option value="2">Public</option>
      </select>
      <br>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection