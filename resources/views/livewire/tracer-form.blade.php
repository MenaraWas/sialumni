<div>
    @if(!$schema)
        <div class="bg-white rounded-3xl border border-slate-100 p-8 shadow-sm text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center text-2xl border border-amber-100">
                ⏳
            </div>
            <h3 class="font-bold text-slate-800 text-lg">Formulir Tidak Aktif</h3>
            <p class="text-slate-400 text-sm mt-1 max-w-xs mx-auto">Silakan hubungi pihak madrasah atau kembali beberapa saat lagi.</p>
        </div>
    @elseif($alreadySubmitted)
        <div class="bg-white rounded-3xl border border-slate-100 p-8 shadow-sm text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center text-2xl border border-emerald-100">
                ✔️
            </div>
            <h3 class="font-bold text-slate-800 text-lg">Sudah Mengisi</h3>
            <p class="text-slate-400 text-sm mt-2 max-w-sm mx-auto">
                NISN <strong class="text-slate-700">{{ $nisn }}</strong> sudah terdaftar mengisi kuesioner. Jika merasa ada kesalahan atau perubahan data, silakan hubungi bagian administrasi madrasah.
            </p>
        </div>
    @else

        {{-- Progress Wizard Header --}}
        <div class="mb-8 max-w-2xl mx-auto">
            <div class="flex items-center justify-between relative px-2">
                {{-- Decorative connecting line --}}
                <div class="absolute top-[21px] left-0 right-0 h-0.5 bg-slate-100 z-0">
                    <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-500 transition-all duration-300"
                        style="width: {{ $step === 1 ? '0%' : ($step === 2 ? '50%' : '100%') }}"></div>
                </div>

                @foreach(['Data Diri', 'Kegiatan', 'Kuesioner'] as $i => $label)
                    <div class="flex flex-col items-center z-10 relative">
                        <div class="w-11 h-11 rounded-2xl flex items-center justify-center text-sm font-bold shadow-sm transition-all duration-300 border
                            {{ $step > $i + 1 
                                ? 'bg-emerald-500 text-white border-emerald-500 scale-100' 
                                : ($step === $i + 1 
                                    ? 'bg-white text-emerald-600 border-emerald-500 ring-4 ring-emerald-50 scale-110' 
                                    : 'bg-white text-slate-400 border-slate-200') }}">
                            @if($step > $i + 1)
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            @else
                                {{ $i + 1 }}
                            @endif
                        </div>
                        <span class="text-xs mt-2.5 font-bold tracking-tight transition-all duration-200
                            {{ $step === $i + 1 ? 'text-emerald-700 font-extrabold' : 'text-slate-400' }}">
                            {{ $label }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Main Wizard Card --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 sm:p-10 transition-all duration-300">

            {{-- STEP 1: Data Diri --}}
            @if($step === 1)
                <div class="space-y-6">
                    <div>
                        <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Data Diri Dasar</h2>
                        <p class="text-xs text-slate-400 mt-1">Lengkapi informasi identitas diri Anda sebagai alumni MAN 2 Bantul.</p>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label class="text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5 block">
                                NISN <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" wire:model.live.debounce.300ms="nisn" maxlength="10"
                                placeholder="Masukkan 10 digit NISN Anda"
                                class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100/50 outline-none transition-all duration-150">
                            @error('nisn') 
                                <p class="text-rose-500 text-xs font-semibold mt-1.5 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                                    {{ $message }}
                                </p> 
                            @enderror
                        </div>

                        <div>
                            <label class="text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5 block">
                                Nama Lengkap <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" wire:model="nama_lengkap"
                                placeholder="Masukkan nama lengkap sesuai ijazah"
                                class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100/50 outline-none transition-all duration-150">
                            @error('nama_lengkap') 
                                <p class="text-rose-500 text-xs font-semibold mt-1.5 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                                    {{ $message }}
                                </p> 
                            @enderror
                        </div>

                        <div>
                            <label class="text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5 block">
                                Tahun Lulus <span class="text-rose-500">*</span>
                            </label>
                            <input type="number" wire:model="tahun_lulus"
                                placeholder="Contoh: 2022" min="1990" max="{{ date('Y') }}"
                                class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100/50 outline-none transition-all duration-150">
                            @error('tahun_lulus') 
                                <p class="text-rose-500 text-xs font-semibold mt-1.5 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                                    {{ $message }}
                                </p> 
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5 block">
                                    No. HP / WhatsApp
                                </label>
                                <input type="text" wire:model="no_hp" placeholder="Contoh: 081234567890"
                                    class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100/50 outline-none transition-all duration-150">
                            </div>
                            <div>
                                <label class="text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5 block">
                                    Email Aktif
                                </label>
                                <input type="email" wire:model="email" placeholder="Contoh: alumni@email.com"
                                    class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100/50 outline-none transition-all duration-150">
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- STEP 2: Kegiatan Setelah Lulus --}}
            @if($step === 2)
                <div class="space-y-6">
                    <div>
                        <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Kegiatan Saat Ini</h2>
                        <p class="text-xs text-slate-400 mt-1">Pilih aktivitas utama yang sedang Anda tekuni saat ini.</p>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-3 block">
                                Status Kesibukan <span class="text-rose-500">*</span>
                            </label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @foreach([
                                    'kuliah'       => '🎓 Kuliah',
                                    'bekerja'      => '💼 Bekerja',
                                    'wirausaha'    => '🏪 Wirausaha',
                                    'tidak_bekerja'=> '🔍 Cari Kerja',
                                    'lainnya'      => '📌 Lainnya',
                                ] as $value => $label)
                                    <label class="flex flex-col items-center justify-center border rounded-2xl p-4 cursor-pointer text-center group transition-all duration-150
                                        {{ $status_setelah_lulus === $value 
                                            ? 'border-emerald-500 bg-emerald-50/50 text-emerald-900 font-bold ring-2 ring-emerald-500/20' 
                                            : 'border-slate-150 text-slate-600 bg-white hover:bg-slate-50/50 hover:border-slate-300' }}">
                                        <input type="radio" wire:model.live="status_setelah_lulus"
                                            value="{{ $value }}" class="sr-only">
                                        <span class="text-sm font-semibold tracking-tight">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('status_setelah_lulus') 
                                <p class="text-rose-500 text-xs font-semibold mt-2 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                                    {{ $message }}
                                </p> 
                            @enderror
                        </div>

                        {{-- Kuliah --}}
                        @if($status_setelah_lulus === 'kuliah')
                            <div class="border-l-2 border-emerald-500/30 pl-4 sm:pl-6 ml-1.5 space-y-4 pt-2">
                                <div>
                                    <label class="text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5 block">
                                        Nama Perguruan Tinggi
                                    </label>
                                    <input type="text" wire:model="nama_institusi" placeholder="Contoh: Universitas Gadjah Mada"
                                        class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100/50 outline-none transition-all duration-150">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5 block">
                                            Program Studi / Jurusan
                                        </label>
                                        <input type="text" wire:model="jurusan_prodi" placeholder="Contoh: Teknik Informatika"
                                            class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100/50 outline-none transition-all duration-150">
                                    </div>
                                    <div>
                                        <label class="text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5 block">
                                            Jenjang Pendidikan
                                        </label>
                                        <select wire:model="jenjang"
                                            class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 shadow-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100/50 outline-none transition-all duration-150 bg-white">
                                            <option value="">-- Pilih Jenjang --</option>
                                            <option value="D3">Diploma III (D3)</option>
                                            <option value="D4">Diploma IV (D4)</option>
                                            <option value="S1">Sarjana (S1)</option>
                                            <option value="S2">Magister (S2)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Bekerja / Wirausaha --}}
                        @if(in_array($status_setelah_lulus, ['bekerja', 'wirausaha']))
                            <div class="border-l-2 border-emerald-500/30 pl-4 sm:pl-6 ml-1.5 space-y-4 pt-2">
                                <div>
                                    <label class="text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5 block">
                                        {{ $status_setelah_lulus === 'wirausaha' ? 'Nama Usaha' : 'Nama Perusahaan/Instansi' }}
                                    </label>
                                    <input type="text" wire:model="nama_perusahaan" placeholder="Contoh: {{ $status_setelah_lulus === 'wirausaha' ? 'Warkop Berkah Utama' : 'PT Telekomunikasi Indonesia' }}"
                                        class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100/50 outline-none transition-all duration-150">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5 block">
                                            Posisi / Jabatan
                                        </label>
                                        <input type="text" wire:model="posisi_jabatan" placeholder="Contoh: Staff IT / Owner"
                                            class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100/50 outline-none transition-all duration-150">
                                    </div>
                                    <div>
                                        <label class="text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5 block">
                                            Bidang Pekerjaan
                                        </label>
                                        <input type="text" wire:model="bidang_pekerjaan" placeholder="Contoh: Teknologi Informasi / Kuliner"
                                            class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100/50 outline-none transition-all duration-150">
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Lokasi Domisili (Selalu Tampil) --}}
                        <div class="border-t border-slate-100 pt-6 space-y-4">
                            <h3 class="text-sm font-bold text-slate-800">Lokasi Aktivitas Saat Ini</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5 block">
                                        Provinsi
                                    </label>
                                    <input type="text" wire:model="provinsi" placeholder="Contoh: D.I. Yogyakarta"
                                        class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100/50 outline-none transition-all duration-150">
                                </div>
                                <div>
                                    <label class="text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5 block">
                                        Kota / Kabupaten
                                    </label>
                                    <input type="text" wire:model="kota_kabupaten" placeholder="Contoh: Bantul"
                                        class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100/50 outline-none transition-all duration-150">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endif

            {{-- STEP 3: Field Dinamis --}}
            @if($step === 3)
                <div class="space-y-6">
                    <div>
                        <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Kuesioner Khusus</h2>
                        <p class="text-xs text-slate-400 mt-1">Harap isi beberapa kuesioner tambahan yang disiapkan oleh admin madrasah.</p>
                    </div>

                    @if(count($schema->fields) === 0)
                        <div class="text-center py-8 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                            <span class="text-2xl mb-2 block">📋</span>
                            <p class="text-slate-400 text-xs font-semibold">Tidak ada pertanyaan kuesioner tambahan.</p>
                            <p class="text-[10px] text-slate-350 mt-0.5">Anda bisa langsung mengirimkan formulir ini.</p>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($schema->fields as $field)
                                <div class="bg-slate-50/50 rounded-2xl border border-slate-100 p-5">
                                    <label class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-1 block">
                                        {{ $field['label'] }}
                                        @if($field['required']) <span class="text-rose-500">*</span> @endif
                                    </label>

                                    @if(!empty($field['helper_text']))
                                        <p class="text-[10px] text-slate-400 mb-3 leading-relaxed">{{ $field['helper_text'] }}</p>
                                    @endif

                                    @if($field['type'] === 'textarea')
                                        <textarea wire:model="dynamicAnswers.{{ $field['key'] }}" rows="3"
                                            placeholder="Tuliskan jawaban Anda di sini..."
                                            class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100/50 outline-none transition-all duration-150"></textarea>

                                    @elseif($field['type'] === 'select')
                                        <select wire:model="dynamicAnswers.{{ $field['key'] }}"
                                            class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 shadow-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100/50 outline-none transition-all duration-150 bg-white">
                                            <option value="">-- Pilih Jawaban --</option>
                                            @foreach($field['options'] ?? [] as $opt)
                                                <option value="{{ $opt }}">{{ $opt }}</option>
                                            @endforeach
                                        </select>

                                    @elseif($field['type'] === 'radio')
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-2">
                                            @foreach($field['options'] ?? [] as $opt)
                                                <label class="flex items-center gap-3 border border-slate-100 bg-white rounded-xl p-3 cursor-pointer hover:border-slate-200 transition-colors">
                                                    <input type="radio"
                                                        wire:model="dynamicAnswers.{{ $field['key'] }}"
                                                        value="{{ $opt }}" class="accent-emerald-600 w-4 h-4">
                                                    <span class="text-xs font-semibold text-slate-650">{{ $opt }}</span>
                                                </label>
                                            @endforeach
                                        </div>

                                    @elseif($field['type'] === 'checkbox')
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-2">
                                            @foreach($field['options'] ?? [] as $opt)
                                                <label class="flex items-center gap-3 border border-slate-100 bg-white rounded-xl p-3 cursor-pointer hover:border-slate-200 transition-colors">
                                                    <input type="checkbox"
                                                        wire:model="dynamicAnswers.{{ $field['key'] }}"
                                                        value="{{ $opt }}" class="accent-emerald-600 w-4 h-4 rounded">
                                                    <span class="text-xs font-semibold text-slate-650">{{ $opt }}</span>
                                                </label>
                                            @endforeach
                                        </div>

                                    @elseif($field['type'] === 'date')
                                        <input type="date" wire:model="dynamicAnswers.{{ $field['key'] }}"
                                            class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 shadow-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100/50 outline-none transition-all duration-150 bg-white">

                                    @elseif($field['type'] === 'number')
                                        <input type="number" wire:model="dynamicAnswers.{{ $field['key'] }}"
                                            placeholder="Masukkan angka..."
                                            class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100/50 outline-none transition-all duration-150">

                                    @else
                                        <input type="text" wire:model="dynamicAnswers.{{ $field['key'] }}"
                                            placeholder="Tulis jawaban..."
                                            class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100/50 outline-none transition-all duration-150">
                                    @endif

                                    @error('dynamicAnswers.' . $field['key'])
                                        <p class="text-rose-500 text-xs font-semibold mt-2 flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            {{-- Wizard Footer Navigation --}}
            <div class="flex justify-between items-center mt-10 pt-6 border-t border-slate-100">
                @if($step > 1)
                    <button wire:click="previousStep" type="button"
                        class="inline-flex items-center gap-1.5 px-5 py-3 border border-slate-200 text-slate-650 hover:bg-slate-50 active:bg-slate-100 rounded-xl font-bold text-xs transition-colors outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                        Sebelumnya
                    </button>
                @else
                    <div></div>
                @endif

                @if($step < 3)
                    <button wire:click="nextStep" type="button"
                        class="inline-flex items-center gap-1.5 px-6 py-3 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white rounded-xl font-bold text-xs shadow-sm hover:shadow transition-all outline-none">
                        Berikutnya
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                @else
                    <button wire:click="submit" type="button"
                        wire:loading.attr="disabled"
                        class="inline-flex items-center gap-1.5 px-6 py-3 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white rounded-xl font-bold text-xs shadow-sm hover:shadow transition-all outline-none disabled:opacity-50">
                        <span wire:loading.remove wire:target="submit" class="flex items-center gap-1.5">
                            Kirim Formulir
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                            </svg>
                        </span>
                        <span wire:loading wire:target="submit" class="flex items-center gap-1.5">
                            Mengirim...
                            <svg class="animate-spin -ml-1 mr-1 h-3.5 w-3.5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                    </button>
                @endif
            </div>

        </div>
    @endif
</div>