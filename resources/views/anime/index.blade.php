@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center text-blue-600 dark:text-blue-400 mb-6">Popular Anime List</h1>

        @if(session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Failed',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            </script>
        @endif

        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            </script>
        @endif

        {{-- search form --}}
        <form action="{{ route('anime.search') }}" method="GET" class="mb-6 flex justify-center">
            <input type="text" name="query" placeholder="Search anime..." class="p-2 border border-gray-300 rounded-l-md w-64 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300" autocomplete="off">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Search</button>
        </form>

        {{-- genre filter --}}
        <form action="{{ route('anime.filterByGenre') }}" method="GET" class="mb-6 flex justify-center">
            <select name="genre" class="p-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300">
                <option value="1">Action</option>
                <option value="2">Adventure</option>
                <option value="4">Comedy</option>
                <option value="7">Mystery</option>
                <option value="8">Drama</option>
                <option value="10">Fantasy</option>
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Filter</button>
        </form>

        {{-- sorting form --}}
        <form action="{{ route('anime.index') }}" method="GET" class="mb-6 flex justify-center">
            <select name="sort" class="p-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300">
                <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title</option>
                <option value="score" {{ request('sort') == 'score' ? 'selected' : '' }}>Score</option>
                <option value="episodes" {{ request('sort') == 'episodes' ? 'selected' : '' }}>Episodes</option>
            </select>
            <select name="order" class="p-2 border border-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300">
                <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Descending</option>
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 ml-2 focus:outline-none focus:ring-2 focus:ring-blue-500">Sort</button>
        </form>

        {{-- loading spinner --}}
        <div id="loading" class="hidden text-center">
            <p class="text-gray-600 dark:text-gray-300">Fetching anime data...</p>
            <div class="w-8 h-8 border-4 border-blue-500 border-t-transparent rounded-full animate-spin mx-auto"></div>
        </div>

        {{-- anime list --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($anime as $a)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 hover:shadow-xl transition flex flex-col justify-between">
                    <div>
                        <img src="{{ $a['images']['jpg']['image_url'] }}" alt="{{ $a['title'] }}" class="rounded-md w-full">
                        <h2 class="mt-3 text-lg font-semibold text-gray-900 dark:text-gray-100">
                            <a href="{{ route('anime.show', $a['mal_id']) }}" class="hover:text-blue-500 dark:hover:text-blue-400">{{ $a['title'] }}</a>
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400">Score: {{ $a['score'] }}</p>
                    </div>
                    <form action="{{ route('wishlist.store') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="anime_id" value="{{ $a['mal_id'] }}">
                        <input type="hidden" name="title" value="{{ $a['title'] }}">
                        <input type="hidden" name="image_url" value="{{ $a['images']['jpg']['image_url'] }}">
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">Add to Wishlist</button>
                    </form>
                </div>
            @endforeach
        </div>

        {{-- pagination --}}
        <div class="flex justify-between mt-6">
            @if(isset($currentPage) && $currentPage > 1)
                <a href="{{ url('/anime?page=' . ($currentPage - 1)) }}" class="bg-gray-300 px-4 py-2 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">⬅ Previous</a>
            @endif
            <a href="{{ url('/anime?page=' . ($currentPage + 1)) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Next ➡</a>
        </div>

        @if (empty($anime))
            <p class="text-center text-red-500 dark:text-red-400">No anime available or there was an error fetching data.</p>
        @endif
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let links = document.querySelectorAll("a, button");
            links.forEach(link => {
                link.addEventListener("click", function() {
                    document.getElementById("loading").classList.remove("hidden");
                });
            });
        });
    </script>
@endsection
