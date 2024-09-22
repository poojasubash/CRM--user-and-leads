@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center space-x-2">
        <i class="bi bi-pencil-square text-2xl"></i>
        <span>Edit Lead</span>
    </h1>
    <form action="{{ route('leads.update', $lead->id) }}" id="form" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="user_id" class="block text-lg font-medium text-gray-700">User ID:</label>
            <input type="text" name="user_id" id="user_id" value="{{ $lead->user_id }}" class="border border-gray-300 rounded-md w-full py-2 px-3 mt-1" required>
        </div>

        <div class="mb-3">
            <label for="name" class="block text-lg font-medium text-gray-700">Name:</label>
            <input type="text" name="name" id="name" value="{{ $lead->name }}" class="border border-gray-300 rounded-md w-full py-2 px-3 mt-1" required>
        </div>

        <div class="mb-3">
            <label for="email" class="block text-lg font-medium text-gray-700">Email:</label>
            <input type="email" name="email" id="email" value="{{ $lead->email }}" class="border border-gray-300 rounded-md w-full py-2 px-3 mt-1" required>
        </div>
            <div class="flex-1 hidden">
                <label for="country_code" class="block text-sm font-medium text-gray-600 mb-1">Country Code:</label>
                <input type="text" id="country_code" name="country_code" value="{{ $lead->country_code }}" class="block w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
            </div>
            <div class="mb-3">
                <label for="phone" class="block text-lg font-medium text-gray-700">Phone:</label>
                <input type="tel" name="phone" id="phone" value="{{ $lead->phone }}" class="block w-full border border-gray-300 rounded-lg py-2 pl-12 pr-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

        <div class="mb-3">
            <label for="status" class="block text-lg font-medium text-gray-700">Status:</label>
            <select name="status" id="status" class="block w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="new" {{ $lead->status == 'new' ? 'selected' : '' }}>New</option>
                <option value="contacted" {{ $lead->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                <option value="lost" {{ $lead->status == 'lost' ? 'selected' : '' }}>Lost</option>
            </select>
        </div>

        <div class="mb-6">
            <label for="source_id" class="block text-lg font-medium text-gray-700">Source:</label>
            <select name="source_id" id="source_id" class="block w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @foreach($sources as $source)
                    <option value="{{ $source->id }}" {{ $lead->source_id == $source->id ? 'selected' : '' }}>
                        {{ $source->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label for="group_id" class="block text-lg font-medium text-gray-700">Group:</label>
            <select name="group_id" id="group_id" class="block w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach($groups as $group)
                    <option value="{{ $group->id }}" {{ $lead->group_id == $group->id ? 'selected' : '' }}>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="tags" class="block text-lg font-semibold text-gray-700">Tags:</label>
            <div class="mt-1">
                @foreach($tags as $tag)
                    <label class="inline-flex items-center mr-3">
                        <input type="checkbox" name="tag_id[]" value="{{ $tag->id }}"
                               @if($lead->tags->contains($tag->id)) checked @endif
                               class="form-checkbox">
                        <span class="ml-2">{{ $tag->description }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end space-x-2">
            <button type="submit" class="bg-blue-500 text-white px-2 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Update</button>
            <a href="{{ route('leads.index') }}" class="bg-gray-500 text-white px-2 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 no-underline">Back</a>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.querySelector("#phone");
        const countryCodeInput = document.querySelector("#country_code");
        const initialCountryCode = countryCodeInput.value;
        const initialPhoneNumber = input.value;

        let iti = window.intlTelInput(input, {
        initialCountry: "",
        separateDialCode: true,
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@24.4.0/build/js/utils.js",
        });
        // return;
        function updateCountryCode() {
         const selectedCountryData = iti.getSelectedCountryData();
         countryCodeInput.value = selectedCountryData ? selectedCountryData.dialCode : '';
        }

         iti.promise.then(() => {
            if (initialCountryCode) {
             iti.setNumber('+' + initialCountryCode + initialPhoneNumber);
         }
         updateCountryCode();
         input.addEventListener('countrychange', updateCountryCode);
         });

        document.querySelector("form").addEventListener("submit", function() {
         input.value = iti.getNumber();
         updateCountryCode();
        });
    });
</script>
@endpush
