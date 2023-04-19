<?php

declare(strict_types=1);

use App\Models\Moderator;
use App\Models\Program;
use App\Models\Topic;

it('has moderators', function () {
    // Arrange
    $program = Program::factory()
        ->withProgramItems(1)
        ->create();

    $program->items()->first()->moderators()->attach(
        Moderator::factory()->create()
    );

    // Act & Assert
    expect($program->items()->first()->moderators)
        ->toHaveCount(1);
});

it('has a topic', function () {
    // Arrange
    $program = Program::factory()
        ->withProgramItems(1)
        ->create();

    // Act & Assert
    expect($program->items()->first()->topic)
        ->toBeInstanceOf(Topic::class);
});
