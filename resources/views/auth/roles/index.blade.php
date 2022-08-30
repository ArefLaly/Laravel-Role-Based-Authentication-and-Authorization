@extends('layouts.app')
@php($i = 1)
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>roles</h3>
        </div>
        <input type="hidden" name="model" value="roles">
        <div class="card-body">
            <a href="{{ route('role.add') }}" class="btn btn-outline-primary"> <i class="fa fa-plus"></i> Add role</a>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>RoleName</th>
                            <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <a href="{{ route('role.details', $role) }}" > <i
                                            class="fa fa-role-edit"></i> {{ $role->roleName }}</a>
                                </td>
                                <td>
                                    <div class="btn-hover">
                                        <a href="{{ route('role.edit', $role) }}" class="btn btn-outline-primary"> <i
                                                class="fa fa-role-edit"></i> edit</a>
                                        <button record-id="{{ $role->id }}" href="{{ route('role.edit', $role) }}"
                                            class="btn btn-outline-danger" role="delete-btn"> <i class="fa fa-trash"></i>
                                            Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <form method="POST" id="role-delete-form" role="delete-form">
        @method('delete')
        @csrf
        <input type="hidden" name="id">

    </form>
@stop
