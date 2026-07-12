<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
    @if(!$schema)
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-xl px-6 py-6 text-center">
            <p class="font-semibold">Formulir belum tersedia</p>
            <p class="text-sm mt-1">Silakan kembali lagi nanti.</p>
        </div>
    @elseif($alreadySubmitted)
        <div class="bg-blue-50 border border-blue-200 text-blue-700 rounded-xl px-6 py-6 text-center">
            <p class="font-semibold text-lg">Anda sudah pernah mengisi formulir ini.</p>
            <p class="text-sm mt-1">NISN <strong>{{ $nisn }}</strong> sudah terdaftar di sistem kami.</p>
            <p class="text-sm mt-1">Jika ada perubahan data, hubungi pihak madrasah.</p>
        </div>
    @else

        {{-- Progress Bar --}}
        <div class="mb-8">
            <div class="flex items-center justify-between mb-2">
                @foreach(['Data Diri', 'Kegiatan', 'Pertanyaan Tambahan'] as $i => $label)
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-full flex items-center justify-center text-sm font-bold
                            {{ $step > $i + 1 ? 'bg-green-600 text-white' : ($step === $i + 1 ? 'bg-green-700 text-white' : 'bg-gray-200 text-gray-500') }}">
                            {{ $step > $i + 1 ? '✓' : $i + 1 }}
                        </div>
                        <span class="text-sm {{ $step === $i + 1 ? 'text-green-700 font-semibold' : 'text-gray-400' }}">
                            {{ $label }}
                        </span>
                    </div>
                    @if($i < 2)
                        <div class="flex-1 h-0.5 mx-2 {{ $step > $i + 1 ? 'bg-green-500' : 'bg-gray-200' }}"></div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border p-6 md:p-8">

            {{-- STEP 1: Data Diri --}}
            @if($step === 1)
                <h2 class="text-lg font-bold text-gray-800 mb-6">Data Diri</h2>
                <div class="space-y-5">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            NISN <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="nisn" maxlength="10"
                            placeholder="10 digit NISN"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        @error('nisn') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="nama_lengkap"
                            placeholder="Sesuai ijazah"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        @error('nama_lengkap') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Tahun Lulus <span class="text-red-500">*</span>
                        </label>
                        <input type="number" wire:model="tahun_lulus"
                            placeholder="contoh: 2022" min="1990" max="{{ date('Y') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        @error('tahun_lulus') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. HP / WhatsApp</label>
                            <input type="text" wire:model="no_hp" placeholder="08xxxxxxxxxx"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" wire:model="email" placeholder="alumni@email.com"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        </div>
                    </div>

                </div>
            @endif

            {{-- STEP 2: Kegiatan Setelah Lulus --}}
            @if($step === 2)
                <h2 class="text-lg font-bold text-gray-800 mb-6">Kegiatan Setelah Lulus</h2>
                <div class="space-y-5">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Status Saat Ini <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                            @foreach([
                                'kuliah'       => '🎓 Kuliah',
                                'bekerja'      => '💼 Bekerja',
                                'wirausaha'    => '🏪 Wirausaha',
                                'tidak_bekerja'=> '🔍 Sedang Mencari',
                                'lainnya'      => '📌 Lainnya',
                            ] as $value => $label)
                                <label class="flex items-center gap-2 border rounded-lg px-3 py-2.5 cursor-pointer
                                    {{ $status_setelah_lulus === $value ? 'border-green-500 bg-green-50' : 'border-gray-200 hover:border-green-300' }}">
                                    <input type="radio" wire:model.live="status_setelah_lulus"
                                        value="{{ $value }}" class="accent-green-600">
                                    <span class="text-sm">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('status_setelah_lulus') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Kuliah --}}
                    @if(in_array($status_setelah_lulus, ['kuliah']))
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 space-y-4">
                            <p class="text-sm font-medium text-blue-700">Informasi Pendidikan Lanjut</p>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Perguruan Tinggi</label>
                                <input type="text" wire:model="nama_institusi" placeholder="contoh: UGM, UNY, UII"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Program Studi</label>
                                    <input type="text" wire:model="jurusan_prodi"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenjang</label>
                                    <select wire:model="jenjang"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
                                        <option value="">Pilih jenjang</option>
                                        <option value="D3">D3</option>
                                        <option value="D4">D4</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Bekerja / Wirausaha --}}
                    @if(in_array($status_setelah_lulus, ['bekerja', 'wirausaha']))
                        <div class="bg-orange-50 border border-orange-100 rounded-xl p-4 space-y-4">
                            <p class="text-sm font-medium text-orange-700">Informasi Pekerjaan</p>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ $status_setelah_lulus === 'wirausaha' ? 'Nama Usaha' : 'Nama Perusahaan' }}
                                </label>
                                <input type="text" wire:model="nama_perusahaan"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Posisi / Jabatan</label>
                                    <input type="text" wire:model="posisi_jabatan"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Bidang Pekerjaan</label>
                                    <input type="text" wire:model="bidang_pekerjaan"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Lokasi --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                            <input type="text" wire:model="provinsi" placeholder="contoh: DI Yogyakarta"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kota / Kabupaten</label>
                            <input type="text" wire:model="kota_kabupaten" placeholder="contoh: Bantul"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
                        </div>
                    </div>

                </div>
            @endif

            {{-- STEP 3: Field Dinamis --}}
            @if($step === 3)
                <h2 class="text-lg font-bold text-gray-800 mb-6">Pertanyaan Tambahan</h2>

                @if(count($schema->fields) === 0)
                    <p class="text-gray-400 text-sm">Tidak ada pertanyaan tambahan.</p>
                @else
                    <div class="space-y-5">
                        @foreach($schema->fields as $field)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ $field['label'] }}
                                    @if($field['required']) <span class="text-red-500">*</span> @endif
                                </label>

                                @if(!empty($field['helper_text']))
                                    <p class="text-xs text-gray-400 mb-1">{{ $field['helper_text'] }}</p>
                                @endif

                                @if($field['type'] === 'textarea')
                                    <textarea wire:model="dynamicAnswers.{{ $field['key'] }}" rows="3"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none"></textarea>

                                @elseif($field['type'] === 'select')
                                    <select wire:model="dynamicAnswers.{{ $field['key'] }}"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
                                        <option value="">-- Pilih --</option>
                                        @foreach($field['options'] ?? [] as $opt)
                                            <option value="{{ $opt }}">{{ $opt }}</option>
                                        @endforeach
                                    </select>

                                @elseif($field['type'] === 'radio')
                                    <div class="space-y-2">
                                        @foreach($field['options'] ?? [] as $opt)
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="radio"
                                                    wire:model="dynamicAnswers.{{ $field['key'] }}"
                                                    value="{{ $opt }}" class="accent-green-600">
                                                <span class="text-sm text-gray-700">{{ $opt }}</span>
                                            </label>
                                        @endforeach
                                    </div>

                                @elseif($field['type'] === 'checkbox')
                                    <div class="space-y-2">
                                        @foreach($field['options'] ?? [] as $opt)
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="checkbox"
                                                    wire:model="dynamicAnswers.{{ $field['key'] }}"
                                                    value="{{ $opt }}" class="accent-green-600">
                                                <span class="text-sm text-gray-700">{{ $opt }}</span>
                                            </label>
                                        @endforeach
                                    </div>

                                @elseif($field['type'] === 'date')
                                    <input type="date" wire:model="dynamicAnswers.{{ $field['key'] }}"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">

                                @elseif($field['type'] === 'number')
                                    <input type="number" wire:model="dynamicAnswers.{{ $field['key'] }}"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">

                                @else
                                    <input type="text" wire:model="dynamicAnswers.{{ $field['key'] }}"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 outline-none">
                                @endif

                                @error('dynamicAnswers.' . $field['key'])
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif

            {{-- Navigasi --}}
            <div class="flex justify-between mt-8 pt-6 border-t">
                @if($step > 1)
                    <button wire:click="previousStep" type="button"
                        class="px-6 py-2.5 border border-gray-300 text-gray-600 rounded-lg hover:bg-gray-50 transition">
                        ← Kembali
                    </button>
                @else
                    <div></div>
                @endif

                @if($step < 3)
                    <button wire:click="nextStep" type="button"
                        class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition">
                        Lanjut →
                    </button>
                @else
                    <button wire:click="submit" type="button"
                        wire:loading.attr="disabled"
                        class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition disabled:opacity-50">
                        <span wire:loading.remove wire:target="submit">Kirim Formulir ✓</span>
                        <span wire:loading wire:target="submit">Menyimpan...</span>
                    </button>
                @endif
            </div>

        </div>
    @endif
</div>