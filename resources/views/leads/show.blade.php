@extends('layouts.app')

@section('content')
<div class="min-h-fullscreen flex items-center justify-center bg-gray-100">
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-xl font-bold text-gray-800 mb-6">Lead Details</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="mb-4">
                <label for="name" class="block text-lg font-semibold text-gray-700">Name:</label>
                <p class="text-gray-900 mt-1">{{ $lead->name }}</p>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-lg font-semibold text-gray-700">Email:</label>
                <p class="text-gray-900 mt-1">{{ $lead->email }}</p>
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-lg font-semibold text-gray-700">Phone:</label>
                <p class="text-gray-900 mt-1">{{ $lead->phone }}</p>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-lg font-semibold text-gray-700">Status:</label>
                <p class="text-gray-900 mt-1">{{ $lead->status }}</p>
            </div>

            <div class="mb-4">
                <label for="source" class="block text-lg font-semibold text-gray-700">Source:</label>
                <p class="text-gray-900 mt-1">{{ $lead->source->name ?? 'N/A' }}</p>
            </div>

            <div class="mb-4">
                <label for="group" class="block text-lg font-semibold text-gray-700">Group:</label>
                <p class="text-gray-900 mt-1">{{ $lead->group->name ?? 'N/A' }}</p>
            </div>

            <div class="mb-4">
                <label for="tag" class="block text-lg font-semibold text-gray-700">Tags:</label>
                    <p class="text-gray-900 mt-1">
                        @foreach($lead->tags as $tag)
                            <p>{{ $tag->description }}</p>
                        @endforeach
                    </p>
            </div>
        </div>

        <div class="flex justify-end mt-6 text-sm">
            <a href="{{ route('leads.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 no-underline">Back to Leads</a>
        </div>
    </div>
</div>
@endsection
