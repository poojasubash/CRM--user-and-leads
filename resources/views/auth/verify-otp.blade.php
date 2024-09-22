<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen items-center justify-center px-6 py-12">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
            <div class="container">
                <h2 class="text-2xl font-semibold mb-4">Verify OTP</h2>
                <p class="mb-4">Please enter the OTP</p>
                @if ($errors->has('otp'))
                <div class="text-red-500">
                    {{ $errors->first('otp') }}
                </div>
            @endif
                <form method="POST" action="{{ route('login.verify.otp') }}">
                    @csrf
                    <div class="mb-4">
                        <input type="text" id="otp" name="otp" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm px-2 py-2" required>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Verify OTP</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
