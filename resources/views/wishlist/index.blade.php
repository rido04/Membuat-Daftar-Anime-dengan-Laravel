@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold">Wishlist Saya</h1>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($wishlist as $item)
            <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-xl transition">
                <img src="{{ $item->anime_image }}" alt="{{ $item->title }}" class="rounded-md w-full">
                <h2 class="mt-3 text-lg font-semibold text-gray-900">{{ $item->title }}</h2>
                <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST" class="mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                        Hapus
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
