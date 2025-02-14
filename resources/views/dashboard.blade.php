@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">Dashboard</h1>

        {{-- Statistics --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-xl transition">
                <h2 class="text-lg font-semibold text-gray-900">Total Wishlist</h2>
                <p class="text-2xl font-bold text-blue-600">{{ $totalWishlist }}</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-xl transition">
                <h2 class="text-lg font-semibold text-gray-900">Total Users</h2>
                <p class="text-2xl font-bold text-blue-600">{{ $totalUsers }}</p>
            </div>
        </div>

        {{-- Quick Links --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <a href="{{ route('anime.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md text-center hover:bg-blue-600 transition">View Anime List</a>
            <a href="{{ route('wishlist.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md text-center hover:bg-blue-600 transition">View Wishlist</a>
            <a href="{{ route('profile.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md text-center hover:bg-blue-600 transition">Edit Profile</a>
        </div>
    </div>
@endsection
