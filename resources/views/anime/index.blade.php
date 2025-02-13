<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anime</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    @if(session('error'))
        <div class="bg-red-500 text-white p-4 rounded-md mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">Daftar Anime Populer</h1>

        {{-- search form --}}
        <form action="{{ route('anime.search') }}" method="GET" class="mb-6 flex justify-center">
            <input type="text" name="query" placeholder="Cari anime..." class="p-2 border border-gray-300 rounded-l-md w-64">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600">Cari</button>
        </form>

        {{-- genre filter --}}
        <form action="{{ route('anime.genre') }}" method="GET" class="mb-6 flex justify-center">
            <select name="genre" class="p-2 border border-gray-300 rounded-l-md">
                <option value="1">Action</option>
                <option value="2">Adventure</option>
                <option value="4">Comedy</option>
                <option value="7">Mystery</option>
                <option value="8">Drama</option>
                <option value="10">Fantasy</option>
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600">Filter</button>
        </form>

        {{-- loading spinner --}}
        <div id="loading" class="hidden text-center">
            <p class="text-gray-600">Mengambil data anime...</p>
            <div class="w-8 h-8 border-4 border-blue-500 border-t-transparent rounded-full animate-spin mx-auto"></div>
        </div>

        {{-- anime list --}}
        @if (!empty($anime))
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($anime as $a)
                    <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-xl transition">
                        <img src="{{ $a['images']['jpg']['image_url'] ?? 'https://via.placeholder.com/200' }}" alt="{{ $a['title'] ?? 'No Title' }}" class="rounded-md w-full">
                        <h2 class="mt-3 text-lg font-semibold text-gray-900">
                            <a href="{{ route('anime.show', $a['mal_id']) }}" class="hover:text-blue-500">{{ $a['title'] ?? 'No Title' }}</a>
                        </h2>
                        <p class="text-gray-600">Score: {{ $a['score'] ?? 'N/A' }}</p>
                        <form action="{{ route('wishlist.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="anime_id" value="{{ $a['mal_id'] }}">
                            <input type="hidden" name="title" value="{{ $a['title'] }}">
                            <input type="hidden" name="anime_image" value="{{ $a['images']['jpg']['image_url'] }}">
                            <button type="submit" class="mt-2 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                                Tambah ke Wishlist
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-red-500">Anime tidak tersedia atau terjadi kesalahan dalam mengambil data.</p>
        @endif

        {{-- pagination --}}
        <div class="flex justify-between mt-6">
            @if(isset($currentPage) && $currentPage > 1)
                <a href="{{ url('/anime?page=' . ($currentPage - 1)) }}" class="bg-gray-300 px-4 py-2 rounded-md hover:bg-gray-400">⬅ Sebelumnya</a>
            @endif
            <a href="{{ url('/anime?page=' . ($currentPage + 1)) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Selanjutnya ➡</a>
        </div>
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
</body>
</html>
