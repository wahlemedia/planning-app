<?php

use App\Models\Topic;
use Livewire\Livewire;

use function Pest\Laravel\get;
use App\Http\Livewire\TopicPage;

it('returns a 200 with topic page', function () {
    // Act & Assert
    get(route('pages.topics.index'))
        ->assertSuccessful()
        ->assertSeeLivewire(TopicPage::class);
});


it('can open a modal trigger', function () {
    // Arrange
    $topic =  Topic::factory()->create();

    // Act & Assert
    Livewire::test(TopicPage::class)
        ->call('showTopicDetail', $topic->id)
        ->assertSee('detailModalOpen', true);
});


it('can see the rendered topic', function () {
    // Arrange
    $topic =  Topic::factory()->create();

    // Act & Assert
    get(route('pages.topics.index'))
        ->assertSuccessful()
        ->assertSeeText($topic->title);
});

it('contains a topic card blade component', function () {
    // Arrange
    Topic::factory()->create();

    // Act & Assert
    Livewire::test(TopicPage::class)
        ->assertContainsBladeComponent('topics.topic-card');
});

it('contains a topic modal blade component', function () {
    // Arrange
    Topic::factory()->create();

    // Act & Assert
    Livewire::test(TopicPage::class)
        ->assertContainsBladeComponent('topics.topic-detail-modal');
});


it('is wired up with showTopicDetail', function () {
    // Arrange
    Topic::factory()->create();

    // Act & Assert
    Livewire::test(TopicPage::class)
        ->assertMethodWired('showTopicDetail');
});
