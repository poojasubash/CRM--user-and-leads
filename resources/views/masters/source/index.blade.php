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
        <h2 class="text-black">Manage Sources</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSourceModal">
            <i class="bi bi-plus-circle"></i> Add New Source
        </button>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            @if($sources->isEmpty())
                <p class="text-muted">No sources available. </p>
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
                        @foreach($sources as $index=> $source)
                            <tr>
                                <th scope="row">{{ $sources->firstItem() + $index }}</th>
                                <td>{{ $source->name }}</td>
                                <td class="text-center">
                                    <button class="btn btn-primary btn-sm edit-btn" data-id="{{ $source->id }}" data-name="{{ $source->name }}" data-bs-toggle="modal" data-bs-target="#editSourceModal">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $source->id }}" data-bs-toggle="modal" data-bs-target="#deleteSourceModal">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $sources->links() }}
                </div>
            @endif
        </div>
    </div>
    @include('masters.source.modals')

</div>
@endsection
