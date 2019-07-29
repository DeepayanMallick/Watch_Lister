@extends('layouts.app')

@section('content')
<br>
<a href="/"  class="btn btn-default">Go back</a>
<h1>{{$list->title}}</h1>

<div><strong>Date Created: </strong>{{$list->user->created_at->format('d/m/Y')}}</div>
<div><strong>Number Of Item: </strong>{{count($list->items)}}</div>
<hr>
@if(count($list->items)>0)
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
@endif
<br>
@endsection

