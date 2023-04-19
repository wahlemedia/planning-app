<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ProgramStateEnum;
use App\Models\ProgramItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Program>
 */
class ProgramFactory extends Factory
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
            'slug' => $this->faker->slug,
            'description' => $this->faker->text,
            'state' => $this->faker->randomElement(ProgramStateEnum::values()),
        ];
    }

    public function withProgramItems(int $count = 5): self
    {
        return $this->has(ProgramItem::factory()->count($count), 'items');
    }
}