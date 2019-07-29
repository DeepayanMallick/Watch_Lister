<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Watch Lister') }}</title>
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <style type="text/css">
     .box{
      width:600px;
      margin:0 auto;
     }
    </style>
   
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('inc.navbar')
        <div class="container">
            @include('inc.messages')
        </div>        
        <div class="container">
            @yield('content')
        </div>
    </div>  
<script>

    $("#search_item").keyup(function() {

                
        var value = $( this ).val();       

        if(value != ''){
            
        var url ='https://api.themoviedb.org/3/search/movie?api_key=3789176a07559b7b185cdcf1d3339e49&query='+value;
    
        $.ajax({
            url: url,
            cache: false,
            success: function(data)
            {      
            var item_data, i, x= "", z="";          
            var item_data = data.results;            
            var base_img_path = 'https://image.tmdb.org/t/p/original';
            for (i in item_data) {
                x += `
                
                        <div class="row itemWrap">
                        <div class="col-2">
                            <div class="itemImage ">
                                <img class="w-100" src="${base_img_path}${item_data[i].poster_path}">
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="itemContent">
                                <h1 class="mb-2">${item_data[i].title}</h1>
                                <ul style="list-style: none" class="pl-0">
                                    <li><strong>Overview: </strong>${item_data[i].overview}</li>
                                    <li><strong>Popularity: </strong>${item_data[i].popularity}</li>
                                    <li><strong>Release Date: </strong>${item_data[i].release_date}</li>
                                </ul>
                            </div>
                        </div>
                        </div>
                        <div class="container">
                            <!-- Button to Open Mylist -->
                                <button type="button" class="btn btn-primary add_item" data-toggle="modal" data-target="#myListModal">
                                    Add To Mylist
                                </button>

                            
                                <div class="container" id="add_to_list">
                                
                                </div>

                        </div>
                        <br>       
                `;


                
            }
            document.getElementById("items").innerHTML = x;

            z = `
                            <!-- My List Modal -->
                            <div class="modal" id="myListModal">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                    <h4 class="modal-title">Select A List</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <form action="/items/search" method="POST">
                                    @csrf
                                    <!-- Modal body -->
                                    <div class="modal-body" id="list_data">                                    
                                                                                                                   
                                    </div>
                                    <input type="hidden" name="item_id" value="${item_data[i].id}">                      
                                    
                                    <!-- Myist Modal footer -->
                                    <div class="clearfix p-2">
                                        <button type="submit" id="save_item" class="btn btn-primary float-left">Save</button>
                                        <button type="button" class="btn btn-danger float-right " data-dismiss="modal">Close</button>
                                    </div>
                                    </form>
                                </div>
                                </div>
                            </div>
            `;

            var list = '';
            var url_string = window.location.href
            var url = new URL(url_string);
            var list = url.searchParams.get("list");
            // console.log(list);

            if (list){

                // document.getElementsByClassName("my_list_value").innerHTML = '';
                console.log(list);
                
            }
            else{
                console.log("Empty");
                document.getElementById("add_to_list").innerHTML = z;
            }

            

            
            var lists = JSON.parse($("#listing").html());
            var y= "";
            lists.forEach(function(list){
                y += `
                    <div class="radio">
                        <label><input type="radio" name="mylist" value="${list.id}">${list.title}</label>
                    </div>
                    `;
            }) 
            document.getElementById("list_data").innerHTML = y;
            }
            });
        }
        else {
            var x = '';
            document.getElementById("items").innerHTML = x;
        }
    }); 
                     
</script>
    
</body>
</html>
