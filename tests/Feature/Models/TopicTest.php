<?php

use App\Models\Topic;

it('can be created', function () {
    // Arrange
    Topic::factory()->create();


    // Act & Assert
    expect(Topic::all())->toHaveCount(1);
});