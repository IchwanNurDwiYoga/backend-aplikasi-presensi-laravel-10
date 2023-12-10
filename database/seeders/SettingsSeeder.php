<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'jam_masuk' => '08:00',
            'jam_pulang' => '08:00',
            'lat' => '123',
            'long' => '123',
            'batas_jarak' => '123',
        ];

        Settings::create($data);
    }
}
