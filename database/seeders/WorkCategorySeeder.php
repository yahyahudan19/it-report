<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WorkCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Monitoring', 'Troubleshooting', 'Maintenance', 'Development', 'Documentation'];
        foreach ($categories as $name) {
            DB::table('work_categories')->insert([
                'id' => Str::uuid(),
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
