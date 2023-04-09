<?php

use App\Models\Topic;

it('contains a title', function () {
    // Arrange
    $topic = Topic::factory()->create();

    // Act & Assert
    $this->blade('<x-topics.topic-card :topic="$topic" />', ['topic' => $topic])
        ->assertSeeText($topic->title);
});

it('contains a description', function () {
    // Arrange
    $topic = Topic::factory()->create();

    // Act & Assert
    $this->blade('<x-topics.topic-card :topic="$topic" />', ['topic' => $topic])
        ->assertSeeText($topic->description);
});

it('contains a link count', function () {
    // Arrange
    $topic = Topic::factory()->withLinks(2)->create();

    // Act & Assert
    $this->blade('<x-topics.topic-card :topic="$topic" />', ['topic' => $topic])
        ->assertSeeText('2 Links');
});

it('contains a file count', function () {
    // Arrange
    $topic = Topic::factory()->withMedia(2)->create();

    // Act & Assert
    $this->blade('<x-topics.topic-card :topic="$topic" />', ['topic' => $topic])
        ->assertSeeText('2 Files');
});

it('has tags', function () {
    // Arrange
    $topic = Topic::factory()->withTags()->create();

    // Act & Assert
    $this->blade('<x-topics.topic-card :topic="$topic" />', ['topic' => $topic])
        ->assertSeeText($topic->tags->first()->name);
});
