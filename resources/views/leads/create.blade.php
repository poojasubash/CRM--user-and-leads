@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-13 px-4">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-3xl font-semibold mb-6 text-center text-gray-700">Create Lead</h1>
        <form action="{{ route('leads.store') }}" id="mainForm" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-600 mb-1">Name:</label>
                <input type="text" name="name" id="name" class="block w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-600 mb-1">Email:</label>
                <input type="email" name="email" id="email" class="block w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
                <div class="flex-1 hidden">
                    <label for="country_code" class="block text-sm font-medium text-gray-600 mb-1">Country Code:</label>
                    <input type="text" id="country_code" name="country_code" class="block w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
                </div>
                <div class="mb-6">
                    <label for="phone" class="block text-sm font-medium text-gray-600 mb-1">Phone:</label>
                    <input type="tel" name="phone" id="phone" class="block w-full border border-gray-300 rounded-lg py-2 pl-12 pr-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

            @error('phone')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror

            <div class="mb-6">
                <label for="status" class="block text-sm font-medium text-gray-600 mb-1">Status:</label>
                <select name="status" id="status" class="block w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="new">New</option>
                    <option value="contacted">Contacted</option>
                    <option value="lost">Lost</option>
                </select>
            </div>
            <div class="mb-6">
                <label for="source_id" class="block text-sm font-medium text-gray-600 mb-1">Source:</label>
                <select name="source_id" id="source_id" class="block w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">--Select Source--</option>
                    @foreach($sources as $source)
                        <option value="{{ $source->id }}">{{ $source->name }}</option>
                    @endforeach
                </select>
                @error('source_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="group_id" class="block text-sm font-medium text-gray-600 mb-1">Group:</label>
                <select name="group_id" id="group_id" class="block w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">--Select Group--</option>
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
                @error('group_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="tags" class="block text-sm font-medium text-gray-700">Tags:</label>
                <div class="mt-1">
                    @foreach($tags as $tag)
                        <label class="inline-flex items-center mr-3">
                            <input type="checkbox" name="tag_id[]" value="{{ $tag->id }}" class="form-checkbox">
                            <span class="ml-2">{{ $tag->description }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-between">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Create</button>
                <a href="{{ route('leads.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 no-underline">Back</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.querySelector("#phone");
        const countryCodeInput = document.querySelector("#country_code");
        let iti = null;

        iti = window.intlTelInput(input, {
            initialCountry: "us",
            separateDialCode: true,
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@24.4.0/build/js/utils.js",
        });

        // Update the country code field on initialization and change
        function updateCountryCode() {
            countryCodeInput.value = iti.getSelectedCountryData().dialCode;
        }

        // Set initial country code value
        updateCountryCode();

        // Update country code on change
        iti.promise.then(() => {
            input.addEventListener('countrychange', updateCountryCode);
        });

        document.querySelector("#mainForm").addEventListener("submit", function(event) {
            input.value = iti.getNumber(); // Store the full phone number with country code
        });
    });
</script>
@endpush
@endsection
