@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <a href="{{ route('anime.index') }}" class="text-blue-500 hover:underline dark:text-blue-400">⬅ Back</a>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mt-4">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $anime['title'] }}</h1>
        <img src="{{ $anime['images']['jpg']['large_image_url'] }}" alt="{{ $anime['title'] }}" class="rounded-md w-full md:w-1/2 mx-auto mt-4">
        <p class="text-gray-600 dark:text-gray-400 mt-4"><strong>Score:</strong> {{ $anime['score'] }}</p>
        <p class="text-gray-700 dark:text-gray-300 mt-2"><strong>Synopsis:</strong> {{ $anime['synopsis'] }}</p>
        <p class="text-gray-600 dark:text-gray-400 mt-2"><strong>Status:</strong> {{ $anime['status'] }}</p>
    </div>
</div>
@endsection
