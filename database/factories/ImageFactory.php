<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Post;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $post = Post::factory()->create();

        return [
            'imageable_id' => $post->id,
            'imageable_type' => 'App\Models\Post',
            'original' => $this->faker->imageUrl(1024, 800),
            'large' => $this->faker->imageUrl(1024, 800),
            'medium' => $this->faker->imageUrl(600, 375),
            'small' => $this->faker->imageUrl(100, 100),
        ];
    }
}
