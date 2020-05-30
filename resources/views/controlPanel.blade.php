@extends('layouts.pinweb')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="">
                <div class="">Control Panel</div>

                <div class="">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="row">
                            <div class="col-md-3">
                                <img style="width: 150px; border-radius: 50%;" src="/img/users/{{ Auth::user()->avatar }}" >
                            </div>
                            <div class="col-auto">
                                <p style="font-weight:900; font-size: 25px;"> Hello {{ Auth::user()->name }} !!!</p>
                            </div>
                        </div>

                    <a href="/profile/{{Auth::user()->id}}" style="margin-left: 40px; margin-top: 10px" > Profilepage </a>

                </div>

                <img >
            </div>
        </div>
    </div>
</div>
@endsection
