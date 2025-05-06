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
        Schema::create('handling_team', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('report_handling_id');
            $table->uuid('staff_id');
            $table->timestamps();

            $table->foreign('report_handling_id')->references('id')->on('report_handling')->onDelete('cascade');
            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('handling_team');
    }
};
