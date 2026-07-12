@extends('layouts.tracer')
@section('title', 'Terima Kasih')

@section('content')
<div class="max-w-md mx-auto text-center py-12">
    <div class="bg-white rounded-3xl border border-slate-100 p-8 shadow-sm">
        <div class="relative w-20 h-20 mx-auto mb-6 flex items-center justify-center rounded-2xl bg-emerald-50 text-3xl border border-emerald-100">
            🎉
            <span class="absolute -top-1 -right-1 flex h-4 w-4">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-4 w-4 bg-emerald-500"></span>
            </span>
        </div>
        
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight mb-2">
            Pengiriman Sukses!
        </h2>
        <p class="text-slate-500 text-sm leading-relaxed mb-6">
            Terima kasih banyak atas waktu yang telah Anda luangkan. Data Tracer Study Anda telah kami terima secara aman di sistem.
        </p>

        <div class="bg-slate-50 rounded-xl p-4 text-xs text-slate-500 text-left border border-slate-100 space-y-1.5 mb-8">
            <div class="flex items-center justify-between">
                <span class="font-medium text-slate-400">Status Verifikasi</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-100">PENDING</span>
            </div>
            <p class="text-[10px] text-slate-400 leading-normal pt-1 border-t border-slate-200/60">
                Tim admin madrasah akan memverifikasi kesesuaian data Anda dalam waktu dekat.
            </p>
        </div>

        <a href="{{ route('tracer.landing') }}"
           class="inline-flex items-center justify-center gap-2 w-full bg-slate-900 hover:bg-slate-800 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-150 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            Kembali ke Beranda
        </a>
    </div>
</div>
@endsection