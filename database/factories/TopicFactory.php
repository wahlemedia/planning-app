<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Topic;
use App\Models\Moderator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text(),
        ];
    }

    /**
     * Adds links to the topic.
     */
    public function withLinks(int $count = 1): static
    {
        $links = [];

        for ($i = 0; $i < $count; $i++) {
            $links[] = [
                'title' => $this->faker->sentence(),
                'url' => $this->faker->url(),
                'target' => '_blank',
            ];
        }


        return $this->state(function (array $attributes) use ($links) {
            return [
                'links' => $links,
            ];
        });
    }

    public function withTags(int $count = 1): static
    {
        return $this->afterCreating(function (Topic $topic) use ($count) {
            $topic->attachTags($this->faker->words($count));
        });
    }

    public function withMedia(int $count = 1): static
    {
        return $this->afterCreating(function (Topic $topic) use ($count) {
            for ($i = 0; $i < $count; $i++) {
                $topic->addMedia($this->faker->image())
                    ->preservingOriginal()
                    ->toMediaCollection('default');
            }
        });
    }

    public function withModerators(int $count = 1): static
    {
        return $this->has(Moderator::factory()->count($count));
    }
}
