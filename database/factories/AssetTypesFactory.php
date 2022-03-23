<?php

namespace Database\Factories;

use App\Models\asset_types;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetTypesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = asset_types::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [];
    }
}
