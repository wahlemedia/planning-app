<?php

use App\Http\Livewire\TopicCard;
use App\Models\Topic;

use function Pest\Laravel\get;

it('returns a 200', function () {
    // Act & Assert
    get(route('pages.topics.index'))
        ->assertSuccessful();
});


it('sees a topic livewire component', function () {
    // Arrange
    Topic::factory()->create();

    // Act & Assert
    get(route('pages.topics.index'))
        ->assertSuccessful()
        ->assertSeeLivewire(TopicCard::class);
});
