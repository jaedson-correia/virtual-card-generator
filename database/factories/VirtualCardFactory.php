<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VirtualCard>
 */
class VirtualCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $string = substr(md5(rand()), 0, 12);

        return [
            'name' => $string,
            'linkedin' => $string,
            'github' => $string,
            'slug' => $string
        ];
    }
}
