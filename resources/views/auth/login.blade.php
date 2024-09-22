<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen items-center justify-center px-6 py-12">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Sign in to your account</h2>
                <p class="text-sm text-gray-600 mt-1">Welcome back! Please enter your details to login.</p>
            </div>
            @if ($errors->any())
                <div class="text-red-500">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-base py-2 px-2">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-base py-2 px-2">
                </div>

                <div class="flex items-center justify-between">
                    <div class="text-sm">
                        <a href="{{route('password.request')}}" class="font-medium text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white font-medium rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login</button>
                </div>

                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600">Don't have an account?</p>
                    <a href="{{ route('register.create') }}" class="text-indigo-600 font-medium hover:text-indigo-500">Register here</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
