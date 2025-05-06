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
        Schema::create('reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('reporter_id');     // staff/unit yang melapor
            $table->uuid('location_id');     // room_id
            $table->date('report_date');
            $table->enum('priority', ['critical', 'high', 'medium', 'low']);
            $table->uuid('received_by');     // staff_id penerima laporan
            $table->boolean('is_assigned')->default(false);
            $table->timestamps();

            $table->foreign('reporter_id')->references('id')->on('staff')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('received_by')->references('id')->on('staff')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
