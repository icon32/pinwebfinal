@extends('layouts.pinweb')

@section('content')


    <!--- Main Content Area Start -->
    <div class="container main-content">
        <div class="row">

            <div class="col-lg-6 text-center">
                <div class="profile-img-div justify-content-center text-center" id="avatardiv">
                    <img class="profile-image" id="avatar-preview" src="/img/users/{{$user ->avatar}}" loading="lazy" style="object-fit: cover;" alt="Card image cap">
                </div>
                <div class="container-fluid text-center">
                    @if($user ->id == $currentuser )
                        <button type="button" id="changeavatar" class="btn btn-secondary editbtn" style="width:200px; margin-top: 5px;">Change Avatar</button>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 blog-right">
                <div class="row">
                    <div class="col-auto text-left" id="name_editp">
                        <p id="username">
                            <span style="font-weight: bold; font-size: large;">{{$user ->name}} </span>
                        </p>
                    </div>
                    <div class="col-8" id="namebtn">
                        @if($user ->id == $currentuser)

                            <button type="button" id="editnamebtn"  class="btn btn-secondary editbtn" style="font-size: 11px; line-height: 14px; padding: 0px; height: 20px; width:50px;">Edit</button>

                        @endif
                    </div>

                </div>
                <div>
                    <p>Joined At : {{$user ->created_at->format('d-m-Y')}} </p>
                </div>
                <div>
                    <p>Total Likes: {{$user ->total_likes}}</p>
                </div>
                <div class="blog-desc" id="blog-desc" >

                    <p id="edidescription"> {{$user ->description}}
                        @auth
                            @if($user ->id == $currentuser)
                                <button type="button" id="editbodybtn" class="btn btn-secondary editbtn" style="font-size: 11px; line-height: 14px; padding: 0px; height: 20px; width:50px;">Edit</button>
                            @endif
                         @endauth
                    </p>
                </div>
                <hr>
                <div class="container-fluid ">
                    <h2>Users Post's</h2>
                </div>
                <div class="container">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="card-columns profile-cards" >


                                @foreach($posts as $post)
                                    <div class="card text-center justify-content-center">
                                        <img class="card-img-top" loading="lazy" src="/img/posts/{{$post->image}}" alt="Card image cap">
                                        <div class="card-body">


                                            <div class="row">
                                                <div class="col-auto" >
                                                    <h5 class=" card-title text-left" style="margin-top: 5px;"><a href="/posts/{{$post->slug}}">{{ $post->title }}</a></h5>
                                                </div>
                                                <div class="col-auto ml-auto p-2 text-right " style="margin-right: 10px;" id="dots">
                                                    <svg data-html="true" data-toggle="tooltip" title="{{$post->slug}} <br> Likes {{$post->total_likes}} <br> Comments {{$post->total_comments}} "  class="bi bi-three-dots text-right" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path  fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm5 0a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm5 0a1.5 1.5 0 110-3 1.5 1.5 0 010 3z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                            </div>




                                        </div>
                                    </div>
                                @endforeach


                            </div>
{{--                            //pagination buttons--}}
                            {{$posts->links()}}
                        </div>
                    </div>




                </div>



            </div>

        </div>


        <script>
            {{--  Edit Name Form Test 1  --}}


                {{--    //Edit Name Form--}}

                $("#editnamebtn").click(function(){

                    let nameform = '<form method="POST" action="/profile/{{$user->name}}/edit/name"  class="container-fluid row" >' +
                            '@csrf' +
                            '@method('PUT')' +
                    '<input type="text" id="name" name="name" value="{{$user->name}}"> ' +
                    '<button type="submit" id="editnamebtn"  class="btn btn-secondary editbtn" style="font-size: 11px; line-height: 14px; padding: 0px; height: 20px; width:50px;">Save</button>' +
                    ' </form>';

                    $("#username").remove();
                    $("#editnamebtn").remove();
                    $("#name_editp").append(nameform);
                });




                {{--// Edit Description Form--}}

                    $("#editbodybtn").click(function(){


                        let nameform = ' <form method="POST" action="/profile/{{$user->name}}/edit/desc" enctype="multipart/form-data" class="md-form container-fluid row">  ' +
                            '@csrf'+
                            '@method('PUT')'+
                            '<textarea class="form-control" id="description" name="description" rows="8" style="margin-top:15px;" placeholder="Post Description*..." >  </textarea> ' +
                            '<button type="submit" class="btn btn-secondary edidescription" ' +
                            'style="font-size: 11px; line-height: 14px; padding: 0px; height: 20px; width:50px;">Save!</button>' +
                            ' </form>';
                        $("#edidescription").remove();
                        $("#editbodybtn").remove();
                        $("#blog-desc").append(nameform);
                    });


                {{--    //Edit Image Form--}}

                $("#changeavatar").click(function(){



                    let nameform = ' <form method="POST" action="/profile/{{$user->name}}/edit/avatar" enctype="multipart/form-data" class="md-form container-fluid row">  ' +
                        '@csrf'+
                        '@method('PUT')'+
                            '<div class="row">'+
                            '<div class="container">'+
                        '<input class="text-center"  type="file"  name="avatar" id="avatar" style=" color: white; width: auto; position: absolute; margin-left: 40px;" > ' +
                            '</div>'+
                            '<div >' +
                        '<button type="submit" class="btn btn-secondary edidescription" ' +
                        'style="font-size: 11px; line-height: 14px; padding: 0px; height: 20px; width:50px;">Save!</button>' +
                            '</div>'+
                            '</div>'+
                        ' </form>';
                    $("#edidavatar").remove();
                    $("#changeavatar").remove();
                    $("#avatardiv").append(nameform);


                });

                    $(document).ready(function(){

                        $('[data-toggle="tooltip"]').tooltip();

                    });











        </script>

    <!--- Main Content Area End -->
    </div>
@endsection
