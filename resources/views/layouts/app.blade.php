<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@24.4.0/build/css/intlTelInput.css">

</head>
<body class="bg-gray-100 flex">
    <div class="bg-gray-800 w-64 min-h-screen p-4 text-white flex flex-col justify-between">
        <div>
            <div class="flex items-center mb-6">
                <i class="bi bi-person-circle text-3xl mr-2"></i>
                <span class="text-xl font-bold">Admin Panel</span>
            </div>
            <nav>
                <ul class="space-y-8">
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 text-white hover:text-gray-200 no-underline">
                            <i class="bi bi-house-door"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('leads.index') }}" class="flex items-center space-x-2 text-white hover:text-gray-200 no-underline">
                            <i class="bi bi-person-lines-fill"></i>
                            <span>Leads</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}" class="flex items-center space-x-2 text-white hover:text-gray-200 no-underline">
                            <i class="bi bi-people-fill"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li class="relative">
                        <button class="flex items-center space-x-2 text-white hover:text-gray-300 no-underline w-full" id="dropdownMastersButton">
                            <i class="bi bi-file-earmark-text"></i>
                            <span>Masters</span>
                        </button>
                        <ul class="absolute hidden mt-2 w-48 bg-gray-800 text-white border border-gray-700 rounded-md shadow-lg" id="dropdownMenu">
                            <li><a class="block px-4 py-2 hover:bg-gray-700 text-white no-underline" href="{{ route('masters.source.index') }}">Source</a></li>
                            <li><a class="block px-4 py-2 hover:bg-gray-700 text-white no-underline" href="{{ route('masters.groups.index') }}">Groups</a></li>
                            <li><a class="block px-4 py-2 hover:bg-gray-700 text-white no-underline" href="{{ route('masters.tags.index') }}">Tags</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
        <div>
            <div class="flex items-center mb-2">
                <p class="text-gray-300 font-bold"><i class="bi bi-person-circle text-xl mr-2"></i>{{ Auth::user()->name }}</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center space-x-2 text-white hover:text-gray-200 no-underline w-full">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>

    <div class="flex-1 p-6">
        @yield('content')
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@24.4.0/build/js/intlTelInput.min.js"></script>

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dropdownButton = document.getElementById('dropdownMastersButton');
            var dropdownMenu = document.getElementById('dropdownMenu');

            dropdownButton.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', function(event) {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>
