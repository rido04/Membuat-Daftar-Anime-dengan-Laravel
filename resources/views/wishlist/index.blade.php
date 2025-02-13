<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist Anime</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">Wishlist Saya</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($wishlists->isEmpty())
            <p class="text-gray-600 text-center">Belum ada anime di wishlist.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($wishlists as $wishlist)
                    <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-xl transition">
                        <img src="{{ $wishlist->anime_image }}" alt="{{ $wishlist->title }}" class="rounded-md w-full">
                        <h2 class="mt-3 text-lg font-semibold text-gray-900">
                            <a href="/anime/{{ $wishlist->anime_id }}" class="hover:text-blue-500">{{ $wishlist->title }}</a>
                        </h2>
                        <form action="{{ route('wishlist.destroy', $wishlist->id) }}" method="POST" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                                Hapus
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-6 text-center">
            <a href="/anime" class="text-blue-500 hover:underline">Kembali ke daftar anime</a>
        </div>
    </div>
</body>
</html>
