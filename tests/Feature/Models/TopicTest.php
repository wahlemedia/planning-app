<?php

declare(strict_types=1);

use App\Models\Topic;
use App\Models\Moderator;

it('can be created', function () {
    // Arrange
    Topic::factory()->create();


    // Act & Assert
    expect(Topic::all())->toHaveCount(1);
});

it('can be updated', function () {
    // Arrange
    $topic = Topic::factory()->create();

    // Act
    $topic->update([
        'title' => 'New Title',
    ]);

    // Assert
    expect($topic->title)->toBe('New Title');
});

it('can be deleted', function () {
    // Arrange
    $topic = Topic::factory()->create();

    // Act
    $topic->delete();

    // Assert
    expect(Topic::all())->toHaveCount(0);
});

it('can be created with links', function () {
    // Arrange
    Topic::factory()->withLinks(2)->create();

    // Act & Assert
    expect(Topic::all())->toHaveCount(1);
    expect(Topic::first()->links)->toHaveCount(2);
});

it('can be updated with links', function () {
    // Arrange
    $topic = Topic::factory()->create();

    // Act
    $topic->update([
        'links' => [
            [
                'title' => 'New Title',
                'url' => 'https://example.com',
                'target' => '_blank',
            ],
        ],
    ]);

    // Assert
    expect($topic->links)->toHaveCount(1);
    expect($topic->links[0]['title'])->toBe('New Title');
});

it('can be deleted with links', function () {
    // Arrange
    $topic = Topic::factory()->withLinks(2)->create();

    // Act
    $topic->delete();

    // Assert
    expect(Topic::all())->toHaveCount(0);
});

it('has files', function () {
    // Arrange
    $topic = Topic::factory()->withMedia(2)->create();

    // Assert
    expect($topic->getMedia())->toHaveCount(2);
});

it('can be created with tags', function () {
    // Arrange
    Topic::factory()->withTags(2)->create();

    // Act & Assert
    expect(Topic::all())->toHaveCount(1);
    expect(Topic::first()->tags)->toHaveCount(2);
});

it('can be updated with tags', function () {
    // Arrange
    $topic = Topic::factory()->create();

    // Act
    $topic->attachTags(['New Tag']);

    // Assert
    expect($topic->tags)->toHaveCount(1);
    expect($topic->tags[0]['name'])->toBe('New Tag');
});

it('has a moderators', function () {
    // Arrange
    $topic = Topic::factory()->withModerators()->create();

    // Act & Assert
    expect($topic->moderators)->each->toBeInstanceOf(Moderator::class);
});
