@extends('layouts.app')

@section('content')
<h1>Item List</h1>
@foreach ($items as $item)
    <div class="container">
        <div class="row itemWrap">
            <div class="col-2">
                <div class="itemImage">
                    <img class="w-100" src="{{$item->poster}}" alt="">
                </div>              
            </div>
            <div class="col-10">
                <div class="itemContent">
                    <h1 class="mb-2">{{$item->title}} <small>({{$item->year}})</small> </h1>   
                    <ul style="list-style: none" class="pl-0">
                        <li><strong>Director:</strong>  {{$item->Director}}</li>
                        <li><strong>imdb Rating:</strong>  {{$item->imdbRating}}</li>
                        <li><strong>Actors:</strong> {{$item->actors}}</li>
                        <li><strong>Released On:</strong> {{$item->released}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <br>
@endforeach    
@endsection