@extends('layouts.app')

@section('content')
<br>
<div class="input-group">
    <input type="text" id="search_item" class="form-control" placeholder="Search Movie/TV">
</div>
<br>
<br>

<div class="container" id="items">

</div>
<br>
<div style="display: none;" id="listing">
    {{$listings}}
</div>



@endsection