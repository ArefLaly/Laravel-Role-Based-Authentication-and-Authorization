@extends('layouts.app')
@php($i = 1)
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>User Details</h3>
        </div>
        <div class="card-body">
            <div class="d-grid gap-2 pb-2">
                
            <a href="{{ route('user.edit',$user) }}" class="btn btn-outline-primary"><i class="fa fa-edit"></i> Edit</a>
            <a href="{{route('user.index')  }}" class="btn btn-outline-secondary"><i class="fa fa-bars"></i> Back to List</a>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#information"
                        type="button" role="tab" aria-controls="home" aria-selected="true">Information</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                        role="tab" aria-controls="profile" aria-selected="false">Status</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages"
                        type="button" role="tab" aria-controls="messages" aria-selected="false">Roles</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="permissions-tab" data-bs-toggle="tab" data-bs-target="#permissions"
                        type="button" role="tab" aria-controls="messages" aria-selected="false">Permissions</button>
                </li>
                
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="information" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card p-4">
                        <div class="col-md-3">

                            <div class="card">
                                <img class="card-img-top" src="{{ asset($user->getPhoto(2)) }}" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $user->fullname }}</h5>
                                    <p class="card-text">{{ $user->email }}</p>
                                    <p class="card-text">{{ $user->job_title }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card p-4">
                        <ul class="list-group">
                            <li class="list-group-item active">Lock User</li>
                            <li class="list-group-item">
                                <form action="{{ route('user.status', $user) }}" method="post" id="lockForm">
                                    @csrf
                                    @method('put')
                                    @if ($user->islock)
                                        <div class="alert alert-primary" role="alert">
                                            user is lock now! to unlock user push <span
                                                class="badge badge-pill bg-warning">Unlock
                                                User</span>
                                            button!

                                        </div>

                                        <input type="hidden" value="0" name="lock">
                                        <button class="btn btn-outline-warning">Unlock User</button>
                                    @else
                                        <div class="alert alert-primary" role="alert">
                                            You can lock user by pushing <span class="badge badge-pill bg-danger">Lock
                                                User</span>
                                            button!
                                        </div>
                                        <input type="hidden" value="1" name="lock">
                                        <button class="btn btn-outline-danger">Lock User</button>
                                    @endif
                                </form>

                            </li>
                        </ul>
                        <hr>
                        <ul class="list-group">
                            <li class="list-group-item active">Reset Password</li>
                            <li class="list-group-item">

                                <div class="alert alert-primary" role="alert">
                                    You can reset user password by pushing <span class="badge badge-pill bg-primary">Reset
                                        Password!</span>
                                    button!
                                </div>
                                <form action="{{ route('user.status', $user) }}" method="post" id="resetPassword">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="my-input">New Password</label>
                                        <input id="my-input" class="form-control" type="password" name="resetPassword">
                                    </div>
                                    <div class="form-group p-2">

                                        <button class="btn btn-outline-primary">Reset Password!</button>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                    <div class="card p-4">
                        <ul class="list-group">
                            <li class="list-group-item active">Role</li>

                            <li class="list-group-item">
                                <ol>
                                    @foreach ($user->allRole() as $role)
                                        <li class="alert alert-primary" role="alert">
                                            {{ $role->roleName }}
                                        </li>
                                    @endforeach
                                </ol>
                            </li>
                        </ul>

                    </div>

                </div>

                <div class="tab-pane" id="permissions" role="tabpanel" aria-labelledby="messages-tab">
                    <div class="card p-3">
                        <ul class="list-group">
                            <li class="list-group-item active">Permessions</li>

                            <li class="list-group-item">
                                <ol>
                                    @foreach ($user->allPermission() as $per)
                                        <li class="alert alert-primary" role="alert">
                                            {{ $per->code }}
                                            <small class="text-small badge bg-success">{{ $per->descryption }}</small>
                                        </li>
                                    @endforeach
                                </ol>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
