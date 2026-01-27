@extends('layouts.guest')

@section('content')
    <div class="bg-white shadow-xl rounded-lg px-8 pt-6 pb-8 mb-4 border border-gray-200">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Department Login</h2>
            <p class="text-gray-500 text-sm mt-2">Enter your department PIN to access the
                <br>KPI System</p>
        </div>

        <form method="POST" action="{{ route('authenticate') }}">
            @csrf
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="pin">
                    PIN Code
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-center text-lg tracking-widest @error('pin') border-red-500 @enderror"
                    id="pin" type="password" name="pin" placeholder="******" maxlength="6" required autofocus>

                @error('pin')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-center">
                <button
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded w-full focus:outline-none focus:shadow-outline transition duration-150 ease-in-out transform hover:-translate-y-0.5"
                    type="submit">
                    Sign In
                </button>
            </div>
        </form>
    </div>
    <p class="text-center text-gray-400 text-xs">
        &copy; {{ date('Y') }} KPI Management System
    </p>
@endsection