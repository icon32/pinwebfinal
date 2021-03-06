
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Pin Web</title>
</head>

<body>



    <div class="container-fluid">


        <!--- Nav Menu Start -->

        <!---- Desctop Menu  Start----->
        <div class="container-fluid main-nav ">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 " id="logodiv">
                        <a href="{{ url('/') }}" ><img src="/img/pinweblogo50px.png" class="nav-logo float-right" alt="PinWeb"> </a>
                    </div>


                    <div class="col-md-4" id="serchdiv">

                        <form  action="/search" method="get" class=" md-form container-fluid row" id="serchform">

                            <div class="form-row ">
                                <div class="col-auto nav-serch">

                                    <input type="text" class="form-control" id="query" name="query" placeholder="Search User Posts">
                                    @if($errors -> has('query'))
                                        <p style="color: red; background-color: white;" >{{ $errors->first('query') }}</p>
                                    @endif
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="col-md-6" id="menudiv">
                         
                    
                            <ul class="nav float-right">
                                @if (Route::has('login'))
                                    <li class="nav-item ">
                                        @auth
                                        <li class="nav-item dropdown">
                                                
                                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                <img src="/img/users/{{Auth::user()->avatar}}" style="width: 30px; height:30px; border-radius: 15px;"> {{ Auth::user()->name }} <span class="caret"></span>
                                                </a>

                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                
                                                <a class="dropdown-item" href="{{ route('home') }}"
                                                    onclick="event.preventDefault();
                                                                document.getElementById('go-to-home').submit();">
                                                    {{ __('Control Panel') }}
                                                </a>
                                                <form id="go-to-home" action="{{ route('home') }}" method="GET" style="display: none;">
                                                    @csrf
                                                </form>
                                                
                                                <a class="dropdown-item" href="{{ url('/') }}"
                                                    onclick="event.preventDefault();
                                                                document.getElementById('go-to-pin').submit();">
                                                    {{ __('Front Page') }}
                                                </a>
                                                <form id="go-to-pin" action="{{ url('/') }}" method="GET" style="display: none;">
                                                    @csrf
                                                </form>

                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                document.getElementById('right-dropDown').submit();">
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="right-dropDown" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                        @else
                                        <p><a class="nav-link" href="{{ route('login') }}">Log in / Sink In</a> </p>                                            
                                                                                       
                                        @endauth
                                       
                                    </li>
                                    
                                @endif 
                                    <li>
                                    <a href="{{  url('/posts/newpost') }}"  class="btn btn-danger" >+ New Post </a>
                                        
                                    </li>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
        <!---- Desctop Menu End ----->



        <!---- Mobile Menu  Start----->

        <nav class="navbar navbar-expand-lg navbar-light bg-light mobile-nav">


            <a href="{{ url('/') }}" class="navbar-brand" style="margin-right: 0px;" href="#"><img src="/img/pinweb-mob-logo.png" class="nav-logo float-right"  style="height: 50px;" alt="PinWeb"></a>

            <div class="ml-auto p-2" style="float: right; margin-left: 0px;padding-left: 0px;" id="mobilemenudiv">


                <ul class="nav float-right">
                    @if (Route::has('login'))

                            @auth
                                <li class="nav-item dropdown">

                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <img src="/img/users/{{Auth::user()->avatar}}" style="width: 30px; height:30px; border-radius: 15px;">  <span class="caret"></span>
                                    </a>



                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="{{ route('home') }}"
                                           onclick="event.preventDefault();
                                                                    document.getElementById('go-to-home-mob').submit();">
                                            {{ __('Control Panel') }}
                                        </a>
                                        <form id="go-to-home-mob" action="{{ route('home') }}" method="GET" style="display: none;">
                                            @csrf
                                        </form>

                                        <a class="dropdown-item" href="{{ url('/') }}"
                                           onclick="event.preventDefault();
                                                                    document.getElementById('go-to-pin-mob').submit();">
                                            {{ __('Front Page') }}
                                        </a>
                                        <form id="go-to-pin-mob" action="{{ url('/') }}" method="GET" style="display: none;">
                                            @csrf
                                        </form>

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                                    document.getElementById('right-dropDown-mob').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="right-dropDown-mob" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @else
                                <p><a class="nav-link" href="{{ route('login') }}">Log in / Sink In</a> </p>
                            @endauth


                        @endif


                        <a href="{{  url('/posts/newpost') }}"  style=" border-radius: 5px; height: 40px;" class="btn btn-danger" ><i class="fas fa-plus" ></i></a>
                </ul>


            </div>


            <button class="navbar-toggler" type="button" data-toggle="collapse" style="border: white;" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-search" style=""></i>
            </button>


            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <form  action="/search" method="get" class=" form-inline my-2 my-lg-0" id="">
                    <input type="text" class="form-control" id="" name="query" placeholder="Search User Posts">
                    <button type="submit" class="btn btn-danger" style="margin-left: 5px;" >Search!</button>
                    @if($errors -> has('query'))
                        <p style="color: red; background-color: white;" >{{ $errors->first('query') }}</p>
                    @endif
                </form>

            </div>
        </nav>

        <!---- Mobile Menu  End----->




        <!--- Nav Menu End -->



    </div>


    @yield('content')



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="{{ asset('js/mainjs.js') }}"></script>

</body>

</html>
