<?php

use App\Models\Moderator;

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
