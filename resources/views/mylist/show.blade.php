@extends('layouts.app')

@section('content')
<br>
<a href="/mylist"  class="btn btn-default">Go back</a>
<h1>{{$list->title}}</h1>
<div id="add_more_item"><a href="/items/search?list={{$list->id}}" class="btn btn-primary"><strong>Add More Item</strong></a></div>
  @if ($list->privacy_id == 1)                
    <div><strong>List Status: </strong>Private</div>
  @elseif ($list->privacy_id == 2)
    <div><strong>List Status: </strong>Public</div>
  @else 
    <div><strong>List Status: </strong>Shared</div> 
  @endif
<div class="container pl-0">
  <form action="{{ route('privacy.save', $list->id)}}"  method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
      <div class="form-group">    
        <label for="users_list">Share with:</label>
         <select multiple class="form-control" id="users_list" name="user_id[]" value="">
          @foreach ($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

<div><strong>Date Created: </strong>{{$list->user->created_at->format('d/m/Y')}}</div>
<div><strong>Number Of Item: </strong>{{count($list->items)}}</div>


<hr>

<div class="row">
  @foreach ($list->items as $item)
  <div class="col-6 pb-3">
    <div class="row itemWrap">
        <div class="col-5">
            <div class="itemImage ">
                <img class="w-100" src="{{$item->poster}}">
            </div>
        </div>
        <div class="col-7">
            <div class="itemContent">
                <h3 class="mb-2">{{$item->title}}</h3>
                <ul style="list-style: none" class="pl-0">
                    <li><strong>Overview: </strong>{{$item->overview}}</li>
                    <li><strong>Popularity: </strong>{{$item->popularity}}</li>
                    <li><strong>Release Date: </strong>{{$item->release_date}}</li>
                </ul>
            </div>
        </div>
    </div> 
  </div>
  @endforeach
</div>
<br>
@endsection

