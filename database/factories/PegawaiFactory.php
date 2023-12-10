<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nip' => mt_rand(0000001, 9999999),
            'jabatan_id' => Arr::random([1, 2, 3, 4, 5]),
            'nama' => fake()->name(),
            'jenis_kelamin' => Arr::random(['Laki-laki', 'Perempuan']),
            'email' => fake()->email(),
            'password' =>fake()->password(),
            'foto' => '',
            'is_active' => '1',
            'role' => 2,
        ];
    }
}
