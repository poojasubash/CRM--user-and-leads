@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg mt-10 h-fullscreen">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center space-x-2">
         <i class="bi bi-pencil-square text-2xl"></i>
         <span>Edit Lead</span>
        </h1>
     <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="border border-gray-300 px-4 py-2 rounded w-full">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="border border-gray-300 px-4 py-2 rounded w-full">
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="border border-gray-300 px-4 py-2 rounded w-full">
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update User</button>
            <a href="{{ route('users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded no-underline">Cancel</a>
        </div>
     </form>
    </div>
@endsection
