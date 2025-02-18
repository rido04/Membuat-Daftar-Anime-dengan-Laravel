@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            @if (session('status') === 'profile-updated')
                <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                    Profile updated successfully.
                </div>
            @endif

            <div class="flex items-center justify-center mb-4">
                @if ($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-24 h-24 rounded-full">
                @else
                    <div class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center">
                        <span class="text-gray-500">No Avatar</span>
                    </div>
                @endif
            </div>
            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $user->name }}</h2>
                <p class="text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
            </div>
            <div class="mt-6 text-center">
                <a href="{{ route('profile.edit') }}" class="bg-rose-600 text-white px-4 py-2 rounded-md hover:bg-rose-800">Edit Profile</a>
            </div>
        </div>
    </div>
</div>
@endsection
