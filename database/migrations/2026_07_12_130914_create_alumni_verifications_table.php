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
        Schema::create('alumni_verifications', function (Blueprint $table) {
            $table->id();
             $table->foreignId('alumni_response_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('verified_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->enum('status', ['pending', 'verified', 'rejected'])
                ->default('pending');
            $table->text('note')->nullable(); // catatan jika ditolak
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni_verifications');
    }
};
