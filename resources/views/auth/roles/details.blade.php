@extends('layouts.app')
@php($i = 1)
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Role Details</h3>
        </div>
        <div class="card-body">
            <div class="d-grid gap-2 pb-2">

                <a href="{{ route('role.edit', $role) }}" class="btn btn-outline-primary"><i class="fa fa-edit"></i> Edit</a>
                <a href="{{ route('role.index') }}" class="btn btn-outline-secondary"><i class="fa fa-bars"></i> Back to
                    List</a>
            </div>
            <div class="tab-pane" id="permissions" role="tabpanel" aria-labelledby="messages-tab">
                <div class="card p-3">
                    <ul class="list-group">
                        <li class="list-group-item active">Permessions</li>

                        <li class="list-group-item">
                            <ol>
                                @foreach ($role->allPermission() as $per)
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
@stop
