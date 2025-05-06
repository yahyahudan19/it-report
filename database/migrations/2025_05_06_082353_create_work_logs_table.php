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
        Schema::create('work_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('staff_id');
            $table->string('action'); // contoh: "Menambahkan Daily Report", "Mengubah Status Laporan"
            $table->uuid('related_id')->nullable(); // opsional: ID terkait, misal report_id
            $table->string('related_type')->nullable(); // polymorphic: DailyReport, Report, dll
            $table->timestamps();

            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_logs');
    }
};
