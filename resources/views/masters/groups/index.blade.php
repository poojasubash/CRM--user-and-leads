@extends('layouts.app')

@section('content')

<div class="container mt-2">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show w-50 mx-auto" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-black">Manage Groups</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createGroupModal">
            <i class="bi bi-plus-circle"></i> Add New Groups
        </button>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            @if($groups->isEmpty())
                <p class="text-muted">No groups available. </p>
            @else
                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groups as $index=>$group)
                        <tr>
                            <th scope="row">{{ $groups->firstItem() + $index }}</th>
                            <td>{{ $group->name }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm edit-btn" data-id="{{ $group->id }}" data-name="{{ $group->name }}" data-bs-toggle="modal" data-bs-target="#editGroupModal">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $group->id }}" data-bs-toggle="modal" data-bs-target="#deleteGroupModal">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $groups->links() }}
                </div>
            @endif
        </div>
    </div>
@include('masters.groups.modals')
</div>
@endsection


