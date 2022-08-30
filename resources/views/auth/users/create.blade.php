@extends('layouts.app')
@php($i = 1)
@section('content')
    <input type="hidden" value="{{ route('user.index') }}" id="user-index-url">
    <div class="card">
        <div class="card-header">
            <h3>New User</h3>
            <div class="d-grid gap-2 pb-2">
                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary"><i class="fa fa-bars"></i> Back to
                    List</a>
            </div>
        </div>

        <input type="hidden" name="model" value="users">
        <div class="card-body">
            <div class="col-md-4 m-auto">
                <form action="{{ route('user.add') }}" id="user-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="user-image-container">
                            <img src="{{ asset('includes/img/user-add.png') }}" id="user-image"
                                btn-target='#user-input-file' alt="">
                        </div>
                        <input required class="mt-2 form-control" name="photo" type="file" accept='*.jpg'
                            viewer="#user-image" id="user-input-file">
                    </div>
                    <div class="form-group mt-2">
                        <label for="">FullName</label>
                        <input required type="text" class="form-control" name="fullname">
                    </div>

                    <div class="form-group">
                        <label for="">Job Title</label>
                        <input required type="text" class="form-control" name="job_title">
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input required type="text" class="form-control" name="email">
                    </div>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input required type="password" class="form-control" name="password">
                    </div>

                    <div class="form-group">
                        <label for="roles">Roles</label>
                        <select name="roles[]" id="roles" class="form-control" multiple>
                            <option>--selected--</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->roleName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group d-grid gap-2 mt-2">
                        <button class="btn btn-bblock btn-outline-primary "><i class="fa fa-user-plus"></i> Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
