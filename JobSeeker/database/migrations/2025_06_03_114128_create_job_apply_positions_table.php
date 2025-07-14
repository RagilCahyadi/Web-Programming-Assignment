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
        Schema::create('job_apply_positions', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('society_id')->constrained('societies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('job_vacancy_id')->nullable()->constrained('job_vacancies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('position_id')->nullable()->constrained('available_positions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('job_apply_societies_id')->nullable()->constrained('job_apply_societies')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();

            $table->index('position_id', 'job_apply_position_id_foreign');
            $table->index('society_id', 'job_apply_position_society_id_foreign');
            $table->index('job_vacancy_id', 'job_apply_position_job_vacancy_id_foreign');
            $table->index('job_apply_societies_id', 'job_apply_position_job_apply_societies_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_apply_positions');
    }
};
