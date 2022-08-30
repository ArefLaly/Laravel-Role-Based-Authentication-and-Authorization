@extends('layouts.app')
@php($i = 1)
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>User Details</h3>
        </div>
        <div class="card-body">
            <div class="card" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <div class="d-flex text-black">
                        <div class="flex-shrink-0">
                            <img src="{{ asset($user->getPhoto(1)) }}" alt="Generic placeholder image" class="img-fluid"
                                style="width: 180px; border-radius: 10px;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1">{{ $user->fullname }}</h5>
                            <p class="mb-2 pb-1" style="color: #2b2a2a;">Job : <span
                                    class="badge badge-pill bg-secondary">{{ $user->job_title }}</span></p>
                            <p class="mb-2 pb-1" style="color: #2b2a2a;">Email : <span
                                    class="badge badge-pill bg-secondary">{{ $user->email }}</span></p>

                            <div class="d-grid pt-1 mt-5 ">

                                <form method="POST" action="{{ route('logout') }}" class="user-logout-form">
                                    @csrf
                                    <button class="btn  btn-outline-primary " href="{{ route('logout') }}">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">Personal
                                Information</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile"
                                aria-selected="false">Security</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages"
                                type="button" role="tab" aria-controls="messages"
                                aria-selected="false">Roles & Permissions</button>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="card p-3">
                                <h3>Personal Information</h3>
                                <hr>
                                <form action="{{ route('user.updateProfile') }}" method="post" id="user-profile">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="fullname">FullName</label>
                                        <input id="fullname" required class="form-control" type="text" name="fullname"
                                            value="{{ $user->fullname }}" />
                                    </div>

                                    <div class="form-group">
                                        <label for="job_title">Job Title</label>
                                        <input id="job_title" required class="form-control" type="text" name="job_title"
                                            value="{{ $user->job_title }}">
                                    </div>


                                    <div class="form-group d-grid pt-2">
                                        <button class="btn btn-outline-primary">Save</button>
                                    </div>
                                </form>

                            </div>


                        </div>
                        <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="card p-3">
                                <h3>Change Password</h3>
                                <hr>
                                <form action="{{ route('user.updateProfile') }}" method="post" id="change-password">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="oldPassword">Old Password</label>
                                        <input id="oldPassword" class="form-control" type="password" name="oldpassword">
                                    </div>

                                    <div class="form-group">
                                        <label for="newPassword">New Password</label>
                                        <input id="newPassword" class="form-control" type="password" name="newpassword">
                                    </div>

                                    <div class="form-group">
                                        <label for="renewPassword">Type your new password again!</label>
                                        <input id="renewPassword" class="form-control" type="password"
                                            name="renewpassword">
                                    </div>

                                    <div class="form-group d-grid pt-2">
                                        <button class="btn btn-outline-primary">Change Password</button>
                                    </div>
                                </form>

                            </div>

                        </div>
                        <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                            <div class="card p-3">
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
                                <hr>
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

        </div>
    </div>
@stop
