<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alumni_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_schema_id')->constrained('form_schemas')->cascadeOnDelete();
            
            #fix fields
            $table->string('nisn', 20)->unique();
            $table->string('nama_lengkap');
            $table->string('tahun_lulus', 4);
            $table->string('no_hp', 15)->nullable();
            $table->string('email')->nullable();

            // Status setelah lulus
            $table->enum('status_setelah_lulus', [
                'kuliah',
                'bekerja',
                'wirausaha',
                'tidak_bekerja',
                'lainnya',
            ])->nullable();

            // Pendidikan lanjut (diisi jika kuliah)
            $table->string('nama_institusi')->nullable(); // nama kampus / tempat kerja
            $table->string('jurusan_prodi')->nullable();
            $table->string('jenjang')->nullable(); // D3, D4, S1, dll

            // Pekerjaan (diisi jika bekerja / wirausaha)
            $table->string('nama_perusahaan')->nullable();
            $table->string('posisi_jabatan')->nullable();
            $table->string('bidang_pekerjaan')->nullable();

            // Lokasi
            $table->string('provinsi')->nullable();
            $table->string('kota_kabupaten')->nullable();

            $table->timestamp('submitted_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni_responses');
    }
};
