<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KPI System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black font-sans antialiased h-screen flex items-center justify-center overflow-hidden relative">
    <!-- Atmospheric Background Effects -->
    <div
        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-purple-600/30 rounded-full blur-[120px] mix-blend-screen opacity-50 pointer-events-none">
    </div>
    <div
        class="absolute top-2/3 left-1/3 w-[600px] h-[600px] bg-indigo-600/20 rounded-full blur-[100px] mix-blend-screen opacity-50 pointer-events-none">
    </div>
    <div
        class="absolute bottom-0 right-0 w-[800px] h-[500px] bg-gradient-to-t from-blue-900/20 to-transparent blur-[80px] opacity-40 pointer-events-none">
    </div>

    <div class="w-full max-w-sm relative z-10 px-4">
        @yield('content')
    </div>
</body>

</html>