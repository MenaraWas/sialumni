<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AlumniResponse extends Model
{
    //

    protected $fillable = [
        'form_schema_id',
        'nisn',
        'nama_lengkap',
        'tahun_lulus',
        'no_hp',
        'email',
        'status_setelah_lulus',
        'nama_institusi',
        'jurusan_prodi',
        'jenjang',
        'nama_perusahaan',
        'posisi_jabatan',
        'bidang_pekerjaan',
        'provinsi',
        'kota_kabupaten',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    public function formSchema(): BelongsTo
    {
        return $this->BelongsTo(FormSchema::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(ResponseAnswer::class);
    }

    public function verification(): HasOne
    {
        return $this->HasOne(AlumniVerification::class);
    }

    public function getVerificationStatusAttribute(): string
    {
        return $this->verification?->status ?? 'pending';
    }

}
