<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Tracer Study') — MAN 2 Bantul</title>
    
    <!-- Google Fonts: Plus Jakarta Sans for premium typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="min-h-screen bg-slate-50/50 text-slate-800 antialiased selection:bg-emerald-500 selection:text-white">

    {{-- Decorative top bar --}}
    <div class="h-1.5 w-full bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500"></div>

    {{-- Header --}}
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="max-w-3xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="relative flex items-center justify-center w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100 shadow-sm">
                    <img src="/logo-man2bantul.png" alt="MAN 2 Bantul" class="h-8 w-8 object-contain">
                </div>
                <div>
                    <h1 class="font-bold text-base text-slate-900 leading-tight">MAN 2 Bantul</h1>
                    <p class="text-xs font-semibold text-emerald-600 tracking-wide uppercase">Tracer Study Alumni</p>
                </div>
            </div>
            <div class="hidden sm:block text-right">
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                    <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Sistem Online
                </span>
            </div>
        </div>
    </header>

    {{-- Content --}}
    <main class="max-w-3xl mx-auto px-4 py-8 sm:py-12">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="max-w-3xl mx-auto px-6 py-8 border-t border-slate-100 text-center">
        <p class="text-xs text-slate-400 font-medium">
            &copy; {{ date('Y') }} MAN 2 Bantul. Hak Cipta Dilindungi Undang-Undang.
        </p>
        <p class="text-[10px] text-slate-300 mt-1 font-semibold tracking-wider uppercase">
            Sistem Informasi Penelusuran Alumni
        </p>
    </footer>

    @livewireScripts
</body>
</html>