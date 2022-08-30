@extends('layouts.app')
@section('content')
    <div class="card col-md-4 m-auto">
        <div class="card-body">
            <div class="card-top-image">
                <img src="{{ asset('includes/img/user-lock.png') }}" alt="">
            </div>
            
            <h2 class="text-center">Welcome Back</h2>
            <form method="post" action="{{ route("auth") }}" id="login-form">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" required class="form-control" type="email" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" required class="form-control" type="password" name="password">
                </div>
                <div class="form-group mt-2 d-grid">
                    <input class="btn btn-outline-info btn-block" type="submit" value="login">
                </div>
            </form>
        </div>
    </div>

@stop
