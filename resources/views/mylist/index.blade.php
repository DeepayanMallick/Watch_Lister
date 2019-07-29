@extends('layouts.app')

@section('content')

<div class="container mt-2">
  <div class="row">

        <div class="col-12 text-right">
            <a href="/mylist/create" class="btn btn-primary ">Create New List</a>
        </div>
  </div>  
</div>

<div class="container">
    @if(count($listings)>0)
    <div class="row itemWrap">
      @foreach ($listings as $listing)
      <div class="col-md-4 pt-2">
          <!-- Shared list -->
          <div class="card">
              <img src="" class="card-img-top" alt="">
              <div class="card-body">      
                <a href="/mylist/{{$listing->id}}"><h5 class="card-title"><strong>{{$listing->title}}</strong> </h5></a>
                <div><strong>Date Created: </strong>{{$listing->user->created_at->format('d/m/Y')}}</div>
                <div><strong>Number Of Item: </strong>{{count($listing->items)}}</div>
                @if ($listing->privacy_id == 1)                
                <div><strong>List Status: </strong>Private</div>
                @elseif ($listing->privacy_id == 2)
                <div><strong>List Status: </strong>Public</div>                
                @else 
                <div>
                  <div class="float-left"><strong>Shared with:</strong></div>                              
                    @foreach($listing->shares as $share)
                       <div class="float-left ml-1">{{$share->user->name}}, </div>
                    @endforeach 
                  <div class="clearfix"></div>
                </div>
                
                @endif
                <div class="float-left"><a href="/mylist/{{$listing->id}}/edit" class="btn btn-primary">Edit</a></div>          
                <div class="float-right">
                  <form action="{{ route('mylist.destroy', $listing->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form> 
                </div><br>
              </div>
              <div class="container pl-3">
                <a href="/mylist/{{$listing->id}}" class="btn btn-primary pl-2">View Full List</a>
              </div>
          </div>             
      </div>
      @endforeach
    </div>
    @endif
    <div class="row mt-2">
      <div class="col-12 text-right">
          <a href="/items/search" class="btn btn-primary ">Add Item</a>
      </div>
    </div>
</div>
</div>

@endsection




