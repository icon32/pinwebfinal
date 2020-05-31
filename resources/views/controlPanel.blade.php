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

                    <a href="{{url('/profile')}}/{{Auth::user()->id}}" style="margin-left: 40px; margin-top: 10px" > Profilepage </a>

                </div>

                <img >
            </div>
        </div>
        <div class="col-md-8">

            <form method="POST" action="{{ route('change.password') }}">
                @csrf

                @foreach ($errors->all() as $error)
                    <p class="text-danger">{{ $error }}</p>
                @endforeach

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                    <div class="col-md-6">
                        <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>

                    <div class="col-md-6">
                        <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Update Password
                        </button>
                    </div>


        </div>

    </div>
</div>
@endsection
