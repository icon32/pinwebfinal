@extends('layouts.pinweb')



@section('content')

    <div class="container main-content">

        <div class="container-fluid text-center page-title">
            <h1>Publish a New Post !!!</h1>
        </div>
        <div class="row">

            <!-----          ------>


            <!-----     Left Side     ------>
            <form method="post" action="/posts" enctype="multipart/form-data" class=" md-form container-fluid row">
                @csrf



                <div class="col-lg-6 blog-left">

                    <div class="container">
                        <div class="text-left" style="height:200px; background-color:grey; padding-top: 15%;  ">
                            @if($errors -> has('image'))
                            <p style="color: red; background-color: white;" >{{ $errors->first('image') }}</p>
                            @endif
                                <input class="text-center" value="{{old('image')}}" type="file" name="image" id="image" style=" color: white; width: auto; position: absolute; margin-left: 40px;" >

                        </div>

                    </div>

                    <div class="container-fluid">

                        <div>
                            <a class="btn previus " href="{{ url()->previous() }}">&#8249; Cancel Post</a>
                        </div>

                    </div>

                </div>


                <!-----     Right Side     ------>

                <div class="col-lg-6 blog-right">

                    <div class="coment-input">

                            <div class="form-group ">


                                        <div>

                                            <textarea class="form-control" name="title" id="title" placeholder="Post Title*..." >{{old('title')}}</textarea>
                                            @if($errors -> has('title'))
                                                <p style="color: red; background-color: white;">{{ $errors->first('title') }}</p>
                                            @endif
                                                <br>
                                            <textarea class="form-control" id="body" name="body" rows="8" style="margin-top:15px;" placeholder="Post Description*..." >{{old('body')}}</textarea>
                                            @if($errors -> has('body'))
                                                <p style="color: red; background-color: white;">{{ $errors->first('body') }}</p>
                                            @endif
                                            <br>



                                        </div>
                                        <div class="form-group text-center">
                                            @if(Auth::check())

                                             <button type="submit" class="btn btn-danger" style="margin-top:5px; width:200px;">Publish!</button>

                                            @else
                                                <p style=" color: #721c24; background-color: #721c24; margin-top:10px;">
                                                    You have to Login in order to Publish a post
                                                </p>
                                            @endif
                                        </div>


                                </div>
                            </div>


                    </div>
            </form>
            <!-----          ------>
        </div>



        </div>

    </div>


@endsection