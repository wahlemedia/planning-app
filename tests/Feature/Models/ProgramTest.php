<?php

declare(strict_types=1);

use App\Enums\ProgramStateEnum;
use App\Models\Program;

it('has program items', function () {
    // Arrange
    $program = Program::factory()
        ->withProgramItems(1)
        ->create();

    // Act & Assert
    expect($program->items)
        ->toHaveCount(1);
});


it('has a state', function () {
    // Arrange
    $program = Program::factory()->create();

    // Act & Assert
    expect($program->state)
        ->toBeInstanceOf(ProgramStateEnum::class);
});
