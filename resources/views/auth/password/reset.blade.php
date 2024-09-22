<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen items-center justify-center px-6 py-12">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-semibold mb-4">Reset Password</h2>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" id="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>

                <label for="password" class="block text-sm font-medium text-gray-700 mt-4">Password</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>

                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mt-4">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>

                <button type="submit" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Reset Password</button>
            </form>
        </div>
    </div>
</body>
</html>
