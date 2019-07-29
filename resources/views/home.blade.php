@extends('layouts.app')

@section('content')
<div class="container mt-3">
  <div class="row">
        <div class="col-12 text-right">
            <a href="/mylist/create" class="btn btn-primary ">Create New List</a>
        </div>
  </div>  
</div>

<div class="container">
@if(count($mylists)>0)
    <div class="row itemWrap">
    @foreach ($mylists as $mylist)
      <div class="col-md-4 mt-3">
          <!-- Shared list -->
          <div class="card">
              <img src="" class="card-img-top" alt="">
              <div class="card-body">
                <a href="/home/{{$mylist->id}}"><h5 class="card-title"><strong>{{$mylist->title}}</strong> </h5></a>
                
                <h5><strong>Owner Name: </strong>{{$mylist->user->name}}</h5>                      
                <div><strong>Date: </strong>{{$mylist->user->created_at->format('d/m/Y')}}</div>
                <div><strong>Number Of Item: </strong>{{count($mylist->items)}}</div>
                               
              </div>
              <div class="container pl-3">
                <a href="/home/{{$mylist->id}}" class="btn btn-default pl-2">View Full List</a>
              </div>
          </div> 
          
      </div>
    @endforeach
    </div>
@endif 
</div>
<hr>
<div class="container">
@if(count($shares)>0) 
<div class="pt-2"><h3>Shared List</h3></div>    
    <div class="row itemWrap">
    @foreach ($shares as $share)
      <div class="col-md-4 mt-3">
          <!-- Shared list -->
          <div class="card">
              <img src="" class="card-img-top" alt="">
              <div class="card-body">
                <a href="/home/{{$mylist->id}}"><h5 class="card-title"><strong>{{$share->lists->title}}</strong> </h5></a>
                
                <h5><strong>Owner Name: </strong>{{$share->lists->user->name}}</h5>                      
                <div><strong>Date: </strong>{{$share->lists->user->created_at->format('d/m/Y')}}</div>
                <div><strong>Number Of Item: </strong>{{count($share->lists->items)}}</div>
                               
              </div>
              <div class="container pl-3">
                <a href="/home/{{$mylist->id}}" class="btn btn-default pl-2">View Full List</a>
              </div>
          </div> 
          
      </div>
    @endforeach
    </div>
@endif 
</div>
</div>

@endsection

