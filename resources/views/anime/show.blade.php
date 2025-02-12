<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $anime['title'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-6">
        <a href="/anime" class="text-blue-500 hover:underline">⬅ Kembali</a>
        <div class="bg-white rounded-lg shadow-md p-6 mt-4">
            <h1 class="text-3xl font-bold text-gray-900">{{ $anime['title'] }}</h1>
            <img src="{{ $anime['images']['jpg']['large_image_url'] }}" alt="{{ $anime['title'] }}" class="rounded-md w-full md:w-1/2 mx-auto mt-4">
            <p class="text-gray-600 mt-4"><strong>Score:</strong> {{ $anime['score'] }}</p>
            <p class="text-gray-700 mt-2"><strong>Sinopsis:</strong> {{ $anime['synopsis'] }}</p>
            <p class="text-gray-600 mt-2"><strong>Status:</strong> {{ $anime['status'] }}</p>
        </div>
    </div>
</body>
</html>
