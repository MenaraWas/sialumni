<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Tracer Study') — MAN 2 Bantul</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-gray-50">

    {{-- Header --}}
    <header class="bg-green-700 text-white shadow">
        <div class="max-w-3xl mx-auto px-4 py-4 flex items-center gap-3">
            <img src="/logo-man2bantul.png" alt="MAN 2 Bantul" class="h-10 w-10 object-contain">
            <div>
                <div class="font-bold text-lg leading-tight">MAN 2 Bantul</div>
                <div class="text-green-200 text-sm">Tracer Study Alumni</div>
            </div>
        </div>
    </header>

    {{-- Content --}}
    <main class="max-w-3xl mx-auto px-4 py-8">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="text-center text-gray-400 text-sm py-6 mt-8 border-t">
        &copy; {{ date('Y') }} MAN 2 Bantul — Sistem Tracer Study
    </footer>

    @livewireScripts
</body>
</html>