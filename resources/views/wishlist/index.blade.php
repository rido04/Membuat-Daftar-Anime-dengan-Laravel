@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">My Wishlist</h1>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    showConfirmButton: false
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Failed',
                    text: "{{ session('error') }}",
                    timer: 3000,
                    showConfirmButton: false
                });
            </script>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($wishlist as $item)
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-xl transition flex flex-col justify-between">
                    <div>
                        <img src="{{ $item->anime_image }}" alt="{{ $item->title }}" class="rounded-md w-full">
                        <h2 class="mt-3 text-lg font-semibold text-gray-900">{{ $item->title }}</h2>
                    </div>
                    <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                            Remove
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        @if ($wishlist->isEmpty())
            <p class="text-center text-gray-500 mt-6">Your wishlist is empty.</p>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    console.log("SweetAlert ready!"); // Cek apakah script berjalan di console
</script>
@endpush
