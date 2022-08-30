@extends('layouts.app')
@section('content')
<div class="p-5 bg-light">
    <div class="container">
        <h1 class="display-3">Home Page</h1>
        <p class="lead">Hello <span class="badge rounded-pill bg-primary">{{ Auth::user()->fullname }}</span>!, Welcome Back</p>
        <hr class="my-2">
    </div>
</div>
@stop