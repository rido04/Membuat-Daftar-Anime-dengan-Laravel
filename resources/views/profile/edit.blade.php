@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <h1 class="text-3xl font-bold text-center mb-6 text-gray-900 dark:text-gray-100">Edit Profile</h1>

            @if (session('status') === 'profile-updated')
                <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                    Profile updated successfully.
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 dark:text-gray-300">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required class="form-input rounded-full w-full bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 dark:text-gray-300">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required class="form-input rounded-full w-full bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                </div>

                <div class="mb-4">
                    <label for="avatar" class="block text-gray-700 dark:text-gray-300">Avatar</label>
                    @if ($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-20 h-20 rounded-full mb-4">
                    @endif
                    <input id="avatar" type="file" name="avatar" class="form-input rounded-full w-full bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                </div>

                <div class="mb-4">
                    <button type="submit" class="bg-rose-600 text-white px-4 py-2 rounded-md hover:bg-rose-800">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
