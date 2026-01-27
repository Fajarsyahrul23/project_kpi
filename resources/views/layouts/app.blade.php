<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KPI Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased">
<div class="min-h-screen flex flex-col">

    <!-- NAVBAR -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">

                <!-- LEFT -->
                <div class="flex items-center space-x-10">
                    <span class="text-xl font-bold text-indigo-600">
                        KPI System
                    </span>

                    <a href="{{ route('bpd.index') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2
                        {{ request()->routeIs('bpd.*')
                            ? 'border-indigo-500 text-gray-900'
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}
                        text-sm font-medium transition">
                        BPD Management
                    </a>
                </div>

                <!-- RIGHT -->
                <div class="flex items-center gap-4">

                    <span class="text-gray-500 text-sm">
                        Department: {{ session('department_code') }}
                    </span>

                    <!-- LOGOUT BUTTON -->
                    <button type="button"
                        onclick="openLogoutModal()"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-md
                               bg-red-600 hover:bg-red-700 text-white text-sm font-medium
                               shadow-sm transition">

                        <!-- Icon Sign Out -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15a.75.75 0 011.5 0v3.75A3.75 3.75 0 0113.5 22.5h-6A3.75 3.75 0 013.75 18.75V5.25A3.75 3.75 0 017.5 1.5h6a3.75 3.75 0 013.75 3.75V9a.75.75 0 01-1.5 0z"
                                clip-rule="evenodd"/>
                            <path fill-rule="evenodd"
                                d="M21.53 12.53a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06L19.19 11.25H9.75a.75.75 0 000 1.5h9.44l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                clip-rule="evenodd"/>
                        </svg>

                        <span>Logout</span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="flex-grow py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-4">
                    <p class="text-sm text-green-700">
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-gray-200">
        <div class="max-w-7xl mx-auto py-6 px-4">
            <p class="text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} KPI Management System
            </p>
        </div>
    </footer>
</div>

<!-- LOGOUT MODAL -->
<div id="logoutModal" class="fixed inset-0 z-50 hidden">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50" onclick="closeLogoutModal()"></div>

    <!-- Modal Box -->
    <div class="fixed inset-0 flex items-center justify-center px-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 text-center">

            <!-- Icon -->
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 text-red-600"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </div>

            <h3 class="mt-4 text-lg font-semibold text-gray-900">
                Konfirmasi Logout
            </h3>

            <p class="mt-2 text-sm text-gray-600">
                Apakah Anda yakin ingin keluar dari sistem?
            </p>

            <div class="mt-6 flex justify-center gap-3">
                <button onclick="closeLogoutModal()"
                    class="px-4 py-2 rounded-md border border-gray-300
                           text-gray-700 bg-white hover:bg-gray-50 text-sm">
                    Batal
                </button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 rounded-md bg-red-600 hover:bg-red-700
                               text-white text-sm font-medium shadow-sm">
                        Ya, Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
    function openLogoutModal() {
        document.getElementById('logoutModal').classList.remove('hidden');
    }

    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.add('hidden');
    }
</script>

</body>
</html>
