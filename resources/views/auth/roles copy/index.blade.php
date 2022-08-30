@extends('layouts.app')
@php($i = 1)
@section('content')
    <div class="card">
    <div class="card-header">
        <h3>Users</h3>
    </div>
        
        <div class="card-body">
        <a href="{{route('user.add')}}" class="btn btn-outline-primary"> <i class="fa fa-user-plus"></i> Add User</a>
            <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th></th>
                        <th>FullName</th>
                        <th>Email</th>
                        <th>JobTitle</th>
                        <th>...</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$i++  }}</td>
                            <td>
                                <div>
                                    <img src="{{ asset($user->photo) }}" alt="{{ 'img - '.$user->fullname }}" width="32" height="32" class="rounded-circle">
                                </div>
                            </td>
                            <td>{{ $user->fullname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->job_title }}</td>
                            <td>
                                
                                <div class="btn-hover">
                                    <a href="{{ route('user.edit',$user) }}" class="btn btn-outline-primary"> <i class="fa fa-user-edit"></i> edit</a>
                                    <button user-id="{{ $user->id }}" href="{{ route('user.edit',$user) }}" class="btn btn-outline-danger" role="delete-btn"> <i class="fa fa-trash"></i> Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
<form  method="POST" id="user-delete-form">
    @method('delete')
    @csrf
    <input type="hidden"  name="id">
    
</form>
@stop