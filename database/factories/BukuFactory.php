<?php

namespace Database\Factories;

use App\Models\Buku;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku>
 */
class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Buku::class;
    public function definition(): array
    {
        return [
            'judul' => $this->faker->text(50),
            'penulis' => $this->faker->name(),
            'harga' => $this->faker->numberBetween(20000, 500000),
            'tgl_terbit' => $this->faker->date('Y-m-d', 'now')
        ];
    }
}
