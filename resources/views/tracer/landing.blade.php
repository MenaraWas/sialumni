@extends('layouts.tracer')
@section('title', 'Tracer Study Alumni')

@section('content')
<div class="py-4">
    {{-- Hero Section --}}
    <div class="text-center max-w-2xl mx-auto mb-12">
        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100/80 mb-4 animate-fade-in">
            👋 Selamat Datang Alumni
        </span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-4">
            Penelusuran Alumni <br class="hidden sm:inline">
            <span class="bg-gradient-to-r from-emerald-600 to-teal-500 bg-clip-text text-transparent">MAN 2 Bantul</span>
        </h2>
        <p class="text-slate-500 text-sm sm:text-base leading-relaxed">
            Kehadiran dan kontribusi data Anda setelah lulus sangat berharga untuk peningkatan mutu madrasah, akreditasi, serta bimbingan karir bagi siswa-siswi kami.
        </p>
    </div>

    {{-- Info Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="group bg-white rounded-2xl border border-slate-100 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transform transition-all duration-300">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                📝
            </div>
            <h3 class="font-bold text-slate-800 text-base mb-2">Isi Formulir</h3>
            <p class="text-slate-400 text-xs leading-relaxed">
                Lengkapi data diri dasar serta status kegiatan Anda setelah menyelesaikan pendidikan di madrasah.
            </p>
        </div>
        
        <div class="group bg-white rounded-2xl border border-slate-100 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transform transition-all duration-300">
            <div class="w-12 h-12 rounded-xl bg-teal-50 flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                🔒
            </div>
            <h3 class="font-bold text-slate-800 text-base mb-2">Jaminan Data</h3>
            <p class="text-slate-400 text-xs leading-relaxed">
                Setiap informasi yang Anda masukkan dilindungi kerahasiaannya dan hanya digunakan untuk keperluan internal.
            </p>
        </div>

        <div class="group bg-white rounded-2xl border border-slate-100 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transform transition-all duration-300">
            <div class="w-12 h-12 rounded-xl bg-cyan-50 flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                ⚡
            </div>
            <h3 class="font-bold text-slate-800 text-base mb-2">Cepat & Praktis</h3>
            <p class="text-slate-400 text-xs leading-relaxed">
                Formulir didesain sesingkat mungkin agar menghemat waktu pengisian, baik lewat ponsel maupun komputer.
            </p>
        </div>
    </div>

    {{-- CTA --}}
    <div class="text-center">
        @if($formActive)
            <a href="{{ route('tracer.form') }}"
               class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-teal-500 hover:from-emerald-700 hover:to-teal-600 text-white font-bold px-8 py-3.5 rounded-xl shadow-lg shadow-emerald-600/20 hover:shadow-xl hover:shadow-emerald-600/30 hover:-translate-y-0.5 transform transition-all duration-150">
                Mulai Pengisian Form
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        @else
            <div class="inline-flex items-center gap-3 bg-amber-50/80 border border-amber-100 text-amber-800 rounded-2xl px-6 py-4 max-w-lg text-left">
                <span class="text-2xl">⏳</span>
                <div>
                    <h4 class="font-bold text-sm">Formulir Belum Dibuka</h4>
                    <p class="text-xs text-amber-700 mt-0.5">Sistem Tracer Study sedang disiapkan oleh Admin. Mohon tunggu informasi resmi lebih lanjut.</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection