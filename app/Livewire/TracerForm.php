<?php

namespace App\Livewire;

use App\Models\AlumniResponse;
use App\Models\AlumniVerification;
use App\Models\FormSchema;
use App\Models\ResponseAnswer;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TracerForm extends Component
{
    public ?FormSchema $schema = null;

    // Field tetap
    public string $nisn = '';
    public string $nama_lengkap = '';
    public string $tahun_lulus = '';
    public string $no_hp = '';
    public string $email = '';
    public string $status_setelah_lulus = '';

    // Pendidikan lanjut
    public string $nama_institusi = '';
    public string $jurusan_prodi = '';
    public string $jenjang = '';

    // Pekerjaan
    public string $nama_perusahaan = '';
    public string $posisi_jabatan = '';
    public string $bidang_pekerjaan = '';

    // Lokasi
    public string $provinsi = '';
    public string $kota_kabupaten = '';

    // Jawaban field dinamis: ['key' => 'value']
    public array $dynamicAnswers = [];

    // State
    public int $step = 1; // 1: data diri, 2: kegiatan, 3: field dinamis
    public bool $alreadySubmitted = false;

    public function mount(): void
    {
        $this->schema = FormSchema::getActive();
    }

    // Validasi per step
    protected function rulesForStep(int $step): array
    {
        return match ($step) {
            1 => [
                'nisn'          => 'required|digits:10',
                'nama_lengkap'  => 'required|string|max:255',
                'tahun_lulus'   => 'required|digits:4|integer|min:1990|max:' . date('Y'),
                'no_hp'         => 'nullable|string|max:15',
                'email'         => 'nullable|email|max:255',
            ],
            2 => [
                'status_setelah_lulus' => 'required|in:kuliah,bekerja,wirausaha,tidak_bekerja,lainnya',
                'nama_institusi'       => 'nullable|string|max:255',
                'jurusan_prodi'        => 'nullable|string|max:255',
                'jenjang'              => 'nullable|string|max:50',
                'nama_perusahaan'      => 'nullable|string|max:255',
                'posisi_jabatan'       => 'nullable|string|max:255',
                'bidang_pekerjaan'     => 'nullable|string|max:255',
                'provinsi'             => 'nullable|string|max:100',
                'kota_kabupaten'       => 'nullable|string|max:100',
            ],
            3 => $this->dynamicFieldRules(),
            default => [],
        };
    }

    protected function dynamicFieldRules(): array
    {
        $rules = [];
        foreach ($this->schema?->fields ?? [] as $field) {
            $key = 'dynamicAnswers.' . $field['key'];
            $rule = $field['required'] ? 'required' : 'nullable';

            $rules[$key] = match ($field['type']) {
                'number' => $rule . '|numeric',
                'date'   => $rule . '|date',
                default  => $rule . '|string|max:2000',
            };
        }
        return $rules;
    }

    public function nextStep(): void
    {
        // Cek duplikat NISN di step 1
        if ($this->step === 1) {
            $this->validate($this->rulesForStep(1));

            $existing = AlumniResponse::where('nisn', $this->nisn)->first();
            if ($existing) {
                $this->alreadySubmitted = true;
                return;
            }
        } else {
            $this->validate($this->rulesForStep($this->step));
        }

        $this->step++;
    }

    public function previousStep(): void
    {
        $this->step = max(1, $this->step - 1);
    }

    public function submit(): void
    {
        // Validasi step terakhir
        if ($this->schema && count($this->schema->fields) > 0) {
            $this->validate($this->rulesForStep(3));
        }

        DB::transaction(function () {
            // Simpan response utama
            $response = AlumniResponse::create([
                'form_schema_id'       => $this->schema->id,
                'nisn'                 => $this->nisn,
                'nama_lengkap'         => $this->nama_lengkap,
                'tahun_lulus'          => $this->tahun_lulus,
                'no_hp'                => $this->no_hp ?: null,
                'email'                => $this->email ?: null,
                'status_setelah_lulus' => $this->status_setelah_lulus,
                'nama_institusi'       => $this->nama_institusi ?: null,
                'jurusan_prodi'        => $this->jurusan_prodi ?: null,
                'jenjang'              => $this->jenjang ?: null,
                'nama_perusahaan'      => $this->nama_perusahaan ?: null,
                'posisi_jabatan'       => $this->posisi_jabatan ?: null,
                'bidang_pekerjaan'     => $this->bidang_pekerjaan ?: null,
                'provinsi'             => $this->provinsi ?: null,
                'kota_kabupaten'       => $this->kota_kabupaten ?: null,
                'submitted_at'         => now(),
            ]);

            // Simpan jawaban dinamis
            foreach ($this->schema->fields as $field) {
                $value = $this->dynamicAnswers[$field['key']] ?? null;
                if ($value !== null && $value !== '') {
                    ResponseAnswer::create([
                        'alumni_response_id' => $response->id,
                        'field_key'          => $field['key'],
                        'field_label'        => $field['label'],
                        'value'              => is_array($value)
                            ? implode(', ', $value)
                            : $value,
                    ]);
                }
            }

            // Buat record verifikasi awal (pending)
            AlumniVerification::create([
                'alumni_response_id' => $response->id,
                'status'             => 'pending',
            ]);
        });

        session()->flash('submitted', true);
        $this->redirect(route('tracer.thankyou'), navigate: true);
    }

    public function render()
    {
        return view('livewire.tracer-form')
            ->layout('layouts.tracer', ['title' => 'Isi Formulir']);
    }
}