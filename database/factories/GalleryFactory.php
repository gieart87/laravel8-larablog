<?php

namespace Database\Factories;

use App\Models\Gallery;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create();
        $name = $this->faker->sentence(2);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'user_id' => $user->id,
        ];
    }
}
