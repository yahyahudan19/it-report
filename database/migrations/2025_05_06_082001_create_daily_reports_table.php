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
        Schema::create('daily_reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('staff_id');
            $table->uuid('task_id');
            $table->uuid('category_id');
            $table->text('task_description');
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->enum('status', ['done', 'progress', 'pending']);
            $table->text('issues')->nullable();
            $table->integer('quantity')->default(1);
            $table->timestamps();

            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('work_tasks')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('work_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_reports');
    }
};
