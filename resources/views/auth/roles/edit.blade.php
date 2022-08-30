@extends('layouts.app')
@php($i = 1)
@section('content')
    <input type="hidden" value="{{ route('user.index') }}" id="user-index-url">
    <div class="card">
        <div class="card-header">
            <h3>New Role</h3>
        </div>

        <div class="card-body">
            <div class="d-grid gap-2">
                <a class="btn btn-outline-secondary" href="{{ route('role.index') }}"> <i class="fa fa-bars"></i> Back To
                    List</a>
            </div>
            <div class="m-auto">

                <input type="hidden" name="model" value="roles">
                <form action="{{ route('role.edit', $role) }}" id="role-form" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group mt-2">
                        <label for="">RoleName</label>
                        <input required type="text" class="form-control" name="roleName" value="{{ $role->roleName }}">
                    </div>

                    <h3>Permissions</h3>
                    <hr>
                    <div class="allpermissions">
                        @foreach ($role->allPermission() as $permission)
                            <input type="hidden" name="mPermission" value="{{ $permission->id }}">
                        @endforeach
                    </div>
                    <div class="permission-container row">
                        @foreach ($permissions as $permission)
                            @if ($permission->code == 'admin')
                                <div class="col-md-12">
                                    <div class="permission-group m-2 shadow" code="admin">
                                        <div>
                                            <input type="checkbox" class="form-check-input" role="permission"
                                                name="permissionId[]" code="admin" value="{{ $permission->id }}">
                                        </div>
                                        <div>
                                            <h6 class="w-100 mb-0">{{ Str::replaceFirst('admin, ', '', $permission->code) }}
                                            </h6>
                                            <p class="small text-muted">{{ $permission->descryption }}</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            @else
                                <div class="col-md-4 col-xl-3">
                                    <div class="permission-group m-2 shadow">
                                        <div>
                                            <input type="checkbox" class="form-check-input" role="permission"
                                                name="permissionId[]" value="{{ $permission->id }}">
                                        </div>
                                        <div>
                                            <h6 class="w-100 mb-0">{{ Str::replaceFirst('admin, ', '', $permission->code) }}
                                            </h6>
                                            <p class="small text-muted">{{ $permission->descryption }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        @endforeach
                    </div>


                    <div class="form-group d-grid gap-2 mt-2">
                        <button class="btn btn-bblock btn-outline-primary "><i class="fa fa-user-plus"></i> Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
