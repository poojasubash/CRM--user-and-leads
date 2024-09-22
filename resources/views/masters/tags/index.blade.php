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
        <h2 class="text-black">Manage Tags</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTagsModal">
            <i class="bi bi-plus-circle"></i> Add New Tags
        </button>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            @if($tags->isEmpty())
                <p class="text-muted">No tags available.</p>
            @else
            <table class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Description</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tags as $index=>$tag)
                    <tr>
                        <th scope="row">{{$tags->firstitem() + $index}}</th>
                        <td>{{ $tag->description }}</td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-sm edit-btn" data-id="{{ $tag->id }}" data-description="{{ $tag->description }}" data-bs-toggle="modal" data-bs-target="#editTagsModal">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $tag->id }}" data-bs-toggle="modal" data-bs-target="#deleteTagsModal">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{ $tags->links() }}
            </div>
            @endif
        </div>
    </div>
    @include('masters.tags.modals')
  </div>
@endsection

