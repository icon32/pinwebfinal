@extends('layouts.pinweb')



@section('content')
<div class="container">

    <h1>Search Results</h1>
    <div class="row">

        @if($postscount == 0 && $userscount == 0 )

            <div class="col-6">
                <h2>Nothing Found</h2>
                We Found no Users or  Posts <br>

            </div>
        @else

        @if($postscount > 0)
        <div class="col-6">
            <h2>Posts</h2>
            We Found {{ $postscount }} Posts <br>
                @foreach($posts as $post)

                <p><a href="/posts/{{$post->slug}}">{{$post->title}}</a></p>

                @endforeach
        </div>
        @endif

        @if($userscount > 0)
        <div class="col-6">

            <h2>Users</h2>
            we found {{ $userscount }} users <br>

                @foreach($users as $user)

                <p><a href="/profile/{{ $user->id }}">{{$user->name}}</a></p>

                @endforeach



        </div>
        @endif

        @endif

    </div>
</div>

@endsection