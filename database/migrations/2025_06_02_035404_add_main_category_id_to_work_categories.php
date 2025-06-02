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
        Schema::table('work_categories', function (Blueprint $table) {
            $table->uuid('main_category_id')->nullable()->after('id');

            $table->foreign('main_category_id')
                  ->references('id')
                  ->on('work_main_categories')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('work_categories', function (Blueprint $table) {
            $table->dropForeign(['main_category_id']);
            $table->dropColumn('main_category_id');
        });
    }
};
