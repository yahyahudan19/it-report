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
        Schema::create('work_tasks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('staff_id'); // siapa yang punya tugas ini
            $table->string('title');  // contoh: Monitoring Perangkat Jaringan
            $table->text('description')->nullable();
            $table->integer('target_quantity');
            $table->string('unit'); // contoh: kegiatan, unit, project
            $table->timestamps();

            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_tasks');
    }
};
