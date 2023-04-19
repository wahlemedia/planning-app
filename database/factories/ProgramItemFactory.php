<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Topic;
use App\Models\Moderator;
use App\Models\ProgramItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProgramItem>
 */
class ProgramItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'starts_at' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'ends_at' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'topic_id' => Topic::inRandomOrder()->first() ?? Topic::factory()->create(),
        ];
    }

    public function withModerators(int $count = 1): static
    {
        return $this->afterCreating(function (ProgramItem $item) use ($count) {
            $item->moderators()->attach(Moderator::inRandomOrder()->limit($count)->get() ?? Moderator::factory()->count($count)->create());
        });
    }
}
