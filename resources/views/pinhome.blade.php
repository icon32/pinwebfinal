
@extends('layouts.pinweb')

@section('content')

<!--- Main Content Area Start -->
<div class="container">
        <div class="row">

            <div class="card-columns">

                @foreach($posts as $post)
                <div class="card">
                    <img class="card-img-top" loading="lazy" src="img/posts/{{$post->image}}" alt="Card image cap">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-auto" >
                                <h5 class=" card-title text-left" style="margin-top: 5px;"><a href="/posts/{{$post->slug}}">{{ $post->title }}</a></h5>
                            </div>
                            <div class="col-auto ml-auto p-2 text-right " style="margin-right: 10px;" id="dots">
                                <svg data-html="true" data-toggle="tooltip" title="{{$post->slug}} <br> Likes {{$post->total_likes}} <br> Comments {{$post->total_comments}} "  class="bi bi-three-dots text-right" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">

{{--                              <svg data-toggle="tooltip" title="&nbsp;&nbsp;{{$post->slug}}&nbsp;&nbsp; &nbsp;&nbsp;Likes {{$post->total_likes}}&nbsp;&nbsp; &nbsp;Comments {{$post->total_comments}} " class="bi bi-three-dots text-right" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">--}}

                                 <path  fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm5 0a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm5 0a1.5 1.5 0 110-3 1.5 1.5 0 010 3z" clip-rule="evenodd"/>

                              </svg>


                            </div>
                        </div>


                    </div>
                </div>
                @endforeach
            </div>

        </div>

</div>






    <!--- Main Content Area End -->
    @endsection