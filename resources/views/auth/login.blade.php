@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-center mb-6 text-gray-900 dark:text-gray-100">{{ __('Login') }}</h2>

                @if (session('status'))
                    <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 dark:text-gray-300">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-input w-full bg-gray-100 dark:bg-gray-700 dark:text-gray-300 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 dark:text-gray-300">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-input w-full bg-gray-100 dark:bg-gray-700 dark:text-gray-300 @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="remember" id="remember" class="form-checkbox bg-gray-100 dark:bg-gray-700 dark:text-gray-300" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" class="ml-2 text-gray-700 dark:text-gray-300">{{ __('Remember Me') }}</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md w-full hover:bg-blue-600">
                            {{ __('Login') }}
                        </button>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="mb-4 text-center">
                            <a class="text-blue-500 hover:underline" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                    @endif

                    <div class="text-center">
                        <a class="text-blue-500 hover:underline" href="{{ route('register') }}">
                            {{ __('Register') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
