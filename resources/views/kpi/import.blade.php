@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Import KPIs</h1>
            <a href="{{ route('kpi.index', $bpd->id_bpd) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">
                &larr; Back to List
            </a>
        </div>

        <!-- Info Card -->
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">
                        Importing for BPD: <strong>{{ $bpd->no_bpd }}</strong>
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow sm:rounded-lg overflow-hidden">
            <div class="px-4 py-5 sm:p-6">
                <div class="max-w-xl mx-auto">
                    <div class="mt-6">
                        <a href="{{ route('kpi.template') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                            Download Template
                        </a>
                    </div>

                    <form action="{{ route('kpi.import.store') }}" method="POST" enctype="multipart/form-data"
                        class="mt-8 space-y-6">
                        @csrf
                        <input type="hidden" name="id_bpd" value="{{ $bpd->id_bpd }}">

                        <div
                            class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-indigo-500 transition duration-150">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48" aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="file-upload"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="file-upload" name="file" type="file" class="sr-only" required
                                            accept=".csv,.txt,.xlsx">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    CSV, XLSX up to 10MB
                                </p>
                            </div>
                        </div>

                        @if($errors->any())
                            <div class="rounded-md bg-red-50 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">
                                            There were errors with your submission
                                        </h3>
                                        <div class="mt-2 text-sm text-red-700">
                                            <ul class="list-disc pl-5 space-y-1">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- File Preview -->
                        <div id="file-preview"
                        class="hidden mt-4 rounded-md bg-gray-50 border border-gray-200 p-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <svg class="h-5 w-5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M4 2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V8l-6-6H4z" />
                                </svg>
                                <span id="file-name" class="text-sm text-gray-700 font-medium"></span>
                            </div>
                            <button type="button" id="remove-file"
                                class="text-sm text-red-600 hover:text-red-800">
                                Remove
                            </button>
                        </div>
                        </div>

                       <div class="flex justify-center">
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm 
                                    text-sm font-medium rounded-md text-white 
                                    bg-indigo-600 hover:bg-indigo-700 
                                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Import Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const input = document.getElementById('file-upload');
        const preview = document.getElementById('file-preview');
        const fileNameText = document.getElementById('file-name');
        const removeBtn = document.getElementById('remove-file');

        input.addEventListener('change', () => {
            if (input.files.length > 0) {
                fileNameText.textContent = input.files[0].name;
                preview.classList.remove('hidden');
            }
        });

        removeBtn.addEventListener('click', () => {
            input.value = '';
            preview.classList.add('hidden');
            fileNameText.textContent = '';
        });
    </script>

@endsection