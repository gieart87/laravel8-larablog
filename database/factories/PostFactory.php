<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create();

        $title = $this->faker->sentence();

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'post_type' => 'Post',
            'published_at' => date('Y-m-d H:i:s'),
            'status' => 1,
            'body' => $this->faker->paragraph(),
            'user_id' => $user->id,
        ];
    }
}
