<?php

namespace Database\Factories;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

class LanguageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name_en" => $this->faker->sentence(3),
            "name_es" => $this->faker->sentence(3),
            "meaning_name_en" => $this->faker->paragraph(2),
            "meaning_name_es" => $this->faker->paragraph(2)
        ];
    }
}
