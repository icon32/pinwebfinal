@extends('layouts.pinweb')



@section('content')

<!--- Main Content Area Start -->

<div class="container main-content">
        <div class="row">

            <div class="col-lg-6 blog-left">

                <div class="blog-img">
                    <img class="card-img-top" src="/img/posts/{{ $posts->image }}" style="object-fit: cover;" alt="Card image cap">
                </div>

                <div class="container-fluid">
                    <div class="row blog-und-img ">
                        <div class="col-3">
                            <a class="btn previus " href="{{ url()->previous() }}">&#8249; Back</a>
                        </div>
                        <div class="col text-right">
                        @auth
                            @if($user->id == $posts->user_id)
                                <a type="button" class="btn btn-secondary editbtn" href="{{ url('/posts/'. $posts->slug).'/edit' }}" >Edit Post</a>
                            @endif
                        @endauth


                        </div>
                        <div class="col-4">
                            @auth
                                @if($user->id == $posts->user_id)
                                     <a type="button" class="btn btn-danger editbtn" href="{{ url('/posts-delete/'. $posts->slug) }}"> Remove Post </a>
                                @endif
                            @endauth
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-6 blog-right">
                <div class="row" >




                            <div class="col-md-7 blog-date-head ">
                                <p style="margin-bottom: 0px;">
                                    {{ $posts->created_at->format('d-m-Y') }}
                                </p>

                            </div>

                            <div class="col-sm-3 text-right blog-date-head-right" >
                                <p>
                                    <span id="likes_span" style="font-weight: bold; font-size: large;">{{ $posts->total_likes }}! Likes</span>
                                </p>
                            </div>

                            <div class="col-sm-2 text-right blog-date-head-right" id="likediv" style="padding-left: 0px;margin-left: 0px;">

{{--                                if user is connected--}}
                                @auth
{{--                                    if current  user has liked this post--}}
                                    @if($likes)
                                        <button  class="like-Unlike btn btn-danger"   >Unlike</button>

                                    @else
                                        <button  class="like-Unlike btn btn-danger"   >Like</button>
                                    @endif
                                @endauth


                            </div>

                </div>
                <div class="row">

                    <h1 style="text-transform: capitalize;">{{ $posts->title }}</h1>

                </div>
            <div class="blog-desc">

                    <p>{{ $posts->body }}
                    </p>
                </div>
                <div class="blog-comments">

                    <span style="font-weight: bold; font-size: x-large;">Comments</span>
                </div>

                <div class="blog-comments">
                    <div class="container">
                        <div class="row">
                        @foreach($posts->comments as $comment)


                            <div class="col-1">
                                <div class="text-left">
                                    <img src="/img/users/{{ $comment->user_avatar }}" class=" round comment-img" alt="...">
                                </div>
                            </div>

                            <div class="col-11 ">

                                <div class="row ">
                                    <div class="col-3 text-justify" style="text-align: left;">
                                        <a href="/profile/{{ $comment->user_id }}"><p>{{ $comment->user_name }} </p></a>
                                    </div>

                                    <div class="col-6 text-muted">
                                        <p>{{ $comment->created_at->format('d-m-Y') }}</p>
                                    </div>
                                </div>


                                <div>
                                    <p> {{ $comment->body }}</p>
                                </div>

                            </div>

                            @endforeach
                        </div>

                    </div>
                </div>


                <div class="coment-input">
                    @if(Auth::check())

                        <form method="post" action="/comments/create"  class=" ">
                            @csrf
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Submit a Comment</label>
                            <input type="hidden" name="post_id" value="{{ $posts->id }}">


                            <textarea class="form-control" id="coment-form" name="comment" rows="3"></textarea>
                            @if($errors -> has('comment'))
                                <p style="color: red; background-color: white;" >{{ $errors->first('comment') }}</p>
                            @endif
                            <button type="submit" class="btn btn-primary mb-2 float-right" style="margin-top:5px;">Add Comment</button>

                        </div>
                    </form>
                     @else
                    @endif
                </div>

            </div>



        </div>

    </div>

    </div>
    </div>
    <!--- Main Content Area End -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>


    $(document).ready(function (){

        $(".like-Unlike").click(function(e) {

            console.log(e);

            if ($(this).html() == "Like") {

                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')
                    }
                });

                $.ajax({
                    url:"{{url('/postliked')}}",
                    method:"POST",
                    data: {post_id: {{$posts->id}} },
                    success:function (result) {
                        console.log(result);
                        result
                        $(likes_span).html(result +"! Likes");
                        }
                    })
                $(this).html('Unlike');


            }
            else {

                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')
                    }
                });

                $.ajax({
                    url:"{{url('/postunliked')}}",
                    method:"POST",
                    data: {post_id: {{$posts->id}} },
                    success:function (result) {
                        console.log(result);
                        $(likes_span).html(result +"! Likes");
                    }
                })
                $(this).html('Like');

            }

        });


    })



</script>


@endsection

