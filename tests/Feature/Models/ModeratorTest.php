<?php

declare(strict_types=1);

use App\Models\Moderator;
use App\Models\Topic;

it('can be created', function () {
    // Arrange
    Moderator::factory()->create();

    // Act & Assert
    expect(Moderator::all())->toHaveCount(1);
});

it('can be updated', function () {
    // Arrange
    $moderator = Moderator::factory()->create();

    // Act
    $moderator->update([
        'name' => 'New Name',
    ]);

    // Assert
    expect($moderator->name)->toBe('New Name');
});

it('can be deleted', function () {
    // Arrange
    $moderator = Moderator::factory()->create();

    // Act
    $moderator->delete();

    // Assert
    expect(Moderator::all())->toHaveCount(0);
});

it('can have multiple topics', function () {
    // Arrange
    $moderator = Moderator::factory()->withTopics(3)->create();

    // Act & Assert
    expect($moderator->topics)
        ->toHaveCount(3);
    expect($moderator->topics)->each
        ->toBeInstanceOf(Topic::class);
});
