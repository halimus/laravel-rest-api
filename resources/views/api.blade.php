<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>A modern REST API in Laravel 5</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.css">
        <style>
            a {color: #039;background-color: transparent;text-decoration: none;}
            a:hover{color:orangered;}
            img{display: block; margin: auto;}
        </style>
    </head>
    <body>
        <a href="https://github.com/halimus/laravel-rest-api"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/365986a132ccd6a44c23a9169022c0b5c890c387/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f7265645f6161303030302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_red_aa0000.png"></a> 
        <div class="container" style="padding-bottom: 100px;">
            <h2 style="text-align:center;"><u>A modern REST API in Laravel 5</u></h2>
            <div class="row"> 
                <div class="col-md-6 col-sm-12" style="border-right:1px solid silver;">
                    <p><br>
                        The master project repository is
                        <a href="https://github.com/halimus/laravel-rest-api" target="_blank">https://github.com/halimus/laravel-rest-api</a>
                    </p>
                    <p>Click on the links to check simple <strong>GET methods</strong> whether is working.</p>
                    
                    <h3><u>Users</u></h3>
                    <ol>
                       <li><a href="{{ url('/api/users')}}">{{ url('/api/users')}}</a></li>
                       <li><a href="{{ url('/api/users/1')}}">{{ url('/api/users/1')}}</a></li>
                    </ol>
                    
                    <h3><u>Book</u></h3>
                    <ol>
                       <li><a href="{{ url('/api/book')}}">{{ url('/api/book')}}</a></li>
                       <li><a href="{{ url('/api/book/1')}}">{{ url('/api/book/1')}}</a></li>
                    </ol>
                    
                    <h3><u>Author</u></h3>
                    <ol>
                        <li><a href="{{ url('/api/author')}}">{{ url('/api/author')}}</a></li>
                        <li><a href="{{ url('/api/author/1')}}">{{ url('/api/author/1')}}</a></li>
                        <li><a href="{{ url('/api/author/1/book')}}">{{ url('/api/author/1/book')}}</a> -> get All the Books for this Author.</li>
                    </ol>
                    
                    <h3><u>Languages</u></h3>
                    <ol>
                       <li><a href="{{ url('/api/language')}}">{{ url('/api/language')}}</a></li>
                       <li><a href="{{ url('/api/language/1')}}">{{ url('/api/language/1')}}</a></li>
                       <li><a href="{{ url('/api/language/1/book')}}">{{ url('/api/language/1/book')}}</a> -> get All the Books for this Language.</li>
                    </ol>
                </div>
                
                <div class="col-md-6 col-sm-12">
                    <h3>Consuming the API using a Modern App</h3><br><br>
                    <a href="{{ url('/react-app')}}"><img src="{{asset('images/react.png')}}" title="React"></a>
                    <br><br>
                    <a href="{{ url('/angular-app')}}"><img src="{{asset('images/angular.png')}}" title="Angular"></a>
                </div>
            </div>
        </div>
                
        <!-- JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.js"></script>
        
    </body>
</html>
