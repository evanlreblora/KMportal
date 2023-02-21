<?php

namespace Database\Factories;

use App\Models\AnnualReport;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnualReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AnnualReport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'filename' => $this->faker->title,
            'desc' => $this->faker->text,
            'unit' => $this->faker->text(5),
            'type' => $this->faker->text(5),
            'uploader' => $this->faker->text(5)
        ];
    }
}
