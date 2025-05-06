<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $itId = DB::table('departments')->where('name', 'SIRS')->value('id');
        $pkrsId = DB::table('departments')->where('name', 'PKRS')->value('id');

        DB::table('positions')->insert([
            [
                'id' => Str::uuid(),
                'name' => 'Network Administrator',
                'department_id' => $itId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Programmer',
                'department_id' => $itId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Penyuluh Kesehatan',
                'department_id' => $pkrsId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
