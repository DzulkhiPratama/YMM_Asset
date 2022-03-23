<?php

namespace Database\Factories;

use App\Models\assets;
use Illuminate\Database\Eloquent\Factories\Factory;


class AssetsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = assets::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [

            // 'asset_id' => $this->faker->regexify('[A-C]{1}-[0-5]{5}'),
            'asset_id' => $this->faker->randomNumber(5, true),
            'user_id' => mt_rand(1, 15),
            'type_id' => mt_rand(1, 5),
            'asset_name' => $this->faker->sentence(3),
            'asset_desc' => $this->faker->paragraph(),
            'added_at' => $this->faker->dateTime(),
            'expired_date' => $this->faker->dateTime(),
            'asset_price' => $this->faker->randomNumber(5, true),
            'mis_id' => mt_rand(0, 1),
            'couse_exist' => $this->faker->paragraph(),
            'status_id' => mt_rand(1, 3),
            'location_id' => mt_rand(1, 3),
            'asset_log' => $this->faker->paragraph(),

        ];
    }
}
