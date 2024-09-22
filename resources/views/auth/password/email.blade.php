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
      <h2 class="text-2xl font-semibold mb-4">Forgot Your Password?</h2>
      @if (session('status'))
        <div class="mb-4 text-green-600">
          {{ session('status') }}
        </div>
      @endif
      <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <label for="email" class="block text-sm font-medium text-gray-700">
          Email Address
        </label>
        <input type="email" id="email" name="email" class="mt-1 block w-full border border-gray-700 rounded-md shadow-sm px-2 py-2 focus:outline-none focus:ring-blue-500 focus:ring-opacity-50" required placeholder="Enter your email address">
        <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Send Password Reset Link</button>
      </form>
    </div>
  </div>
</body>
</html>
