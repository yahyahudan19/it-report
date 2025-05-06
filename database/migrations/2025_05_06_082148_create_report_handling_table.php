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
        Schema::create('report_handling', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('report_id');
            $table->uuid('staff_id');        // penanggung jawab penanganan
            $table->uuid('task_id');         // relasi ke work_tasks
            $table->uuid('category_id');     // relasi ke work_categories
            $table->text('issue_description');
            $table->text('action_taken');
            $table->uuid('room_id');
            $table->timestamp('handling_time')->nullable();
            $table->timestamp('response_time')->nullable();
            $table->enum('status', ['accept', 'handling', 'done', 'pending']);
            $table->integer('quantity')->default(1);
            $table->timestamps();

            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('work_tasks')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('work_categories')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_handling');
    }
};
