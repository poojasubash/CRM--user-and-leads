<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication Setup</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen items-center justify-center px-6 py-12">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Set Up Two-Factor Authentication</h2>
            <p class="text-gray-700 mb-4">please set up two-factor authentication using the Google Authenticator app. You can do this by scanning the QR code below. Alternatively, you can use the code <strong>{{ $secret }}</strong> if scanning the QR code is not possible.</p>

            <div class="flex justify-center mb-6">
                {!! $qrCode !!}
            </div>

            <p class="text-gray-700 mb-6">Ensure you have completed the setup in your Google Authenticator app before proceeding.</p>

            <form method="POST" action="{{ route('register.complete') }}">
                @csrf
                <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Complete Registration</button>
            </form>
        </div>
    </div>
</body>
</html>
