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
        Schema::create('response_answers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('alumni_response_id')->constrained()->cascadeOnDelete();
            $table->string('field_key');
            $table->string('field_label');
            $table->text('value')->nullable();

            $table->timestamps();

            $table->index(['alumni_response_id', 'field_key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('response_answers');
    }
};
