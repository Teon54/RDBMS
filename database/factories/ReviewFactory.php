<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\InstagramFollowerProduct;
use App\Models\InstagramPageProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => fn() => $this->faker->text(10),
            'rate' => fn() => $this->faker->numberBetween(1, 10),
            'reviewable_id' => fn() => $this->faker->unique()->randomDigit(),
            'reviewable_type' => fn() => $this->faker->unique()->name,
            'user_id' => fn() => User::factory()->create(),
        ];
    }
    public function withUser(User $user): ReviewFactory
    {
        return $this->state([
            'user_id' => $user
        ]);
    }
    public function withReviewable(Product|Category $reviewable): ReviewFactory
    {
        return $this->state([
            'reviewable_id' => $reviewable,
            'reviewable_type' => $reviewable::class
        ]);
    }
}
