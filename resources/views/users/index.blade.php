@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <h1 class="text-xl font-bold mb-4">Users</h1>

    <div class="flex justify-between items-center mb-4 text-sm">
        <form id="searchForm" action="{{ route('users.index') }}" method="GET" class="flex space-x-2">
            <input type="text" id="searchInput" name="search" value="{{ request()->query('search') }}" placeholder="Search users..." class="border border-gray-300 px-4 py-2 rounded w-64">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
            <button type="button" id="clearSearch" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Clear</button>
        </form>
        @if(session('success'))
            <div class="alert alert-success" id="successMessage">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <table class="table-auto w-full border-collapse border border-gray-400 text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Phone</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->phone ?? 'N/A' }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('users.edit', $user->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded no-underline"><i class="bi bi-pencil-square"></i></a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded no-underline"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $users->links() }}
    </div>

    <script>
        setTimeout(function() {
            const successMessage = document.getElementById('successMessage');
            if (successMessage) {
                successMessage.style.opacity = 0;
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 500);
            }
        }, 3000);

        document.getElementById('clearSearch').addEventListener('click', function() {
            const searchInput = document.getElementById('searchInput');
            searchInput.value = '';  // Clear the input field
            document.getElementById('searchForm').submit();  // Submit the form to refresh the page
        });
    </script>
@endsection
