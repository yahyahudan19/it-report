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
        Schema::create('attachments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('attachmentable_id');   // polymorphic key
            $table->string('attachmentable_type'); // class: DailyReport, Report, ReportHandling
            $table->string('file_path');
            $table->string('file_type')->nullable(); // optional, e.g. 'image', 'pdf'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
