@extends('layouts.tracer')
@section('title', 'Tracer Study Alumni')

@section('content')
<div class="text-center py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-2">Tracer Study Alumni</h1>
    <p class="text-gray-500 mb-8">MAN 2 Bantul mengundang seluruh alumni untuk mengisi formulir penelusuran ini. Data Anda sangat bermanfaat bagi pengembangan madrasah.</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
        <div class="bg-white rounded-xl shadow-sm border p-5 text-left">
            <div class="text-green-600 text-2xl mb-2">📝</div>
            <div class="font-semibold text-gray-700">Isi Formulir</div>
            <div class="text-gray-400 text-sm mt-1">Lengkapi data diri dan informasi kegiatan Anda setelah lulus.</div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border p-5 text-left">
            <div class="text-green-600 text-2xl mb-2">🔒</div>
            <div class="font-semibold text-gray-700">Data Aman</div>
            <div class="text-gray-400 text-sm mt-1">Data Anda hanya digunakan untuk keperluan pengembangan madrasah.</div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border p-5 text-left">
            <div class="text-green-600 text-2xl mb-2">⏱️</div>
            <div class="font-semibold text-gray-700">Hanya 5 Menit</div>
            <div class="text-gray-400 text-sm mt-1">Formulir singkat, mudah diisi dari HP maupun komputer.</div>
        </div>
    </div>

    @if($formActive)
        <a href="{{ route('tracer.form') }}"
           class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-xl transition">
            Isi Formulir Sekarang →
        </a>
    @else
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-xl px-6 py-4 inline-block">
            Formulir belum tersedia saat ini. Silakan kembali lagi nanti.
        </div>
    @endif
</div>
@endsection