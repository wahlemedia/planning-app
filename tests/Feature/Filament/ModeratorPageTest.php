<?php


use App\Models\User;
use App\Models\Moderator;
use function Pest\Laravel\get;
use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;
use Filament\Pages\Actions\DeleteAction;
use App\Filament\Resources\ModeratorResource;


beforeEach(function () {
    $this->user = User::factory()->create();

    actingAs($this->user);
});

it('can render page', function () {
    // Act & Assert
    get(ModeratorResource::getUrl('index'))
        ->assertSuccessful();
});

it('can list moderaotrs', function () {
    // Arrange
    $moderators = Moderator::factory()->count(10)->create();

    // Act & Assert
    livewire(ModeratorResource\Pages\ListModerators::class)
        ->assertCanSeeTableRecords($moderators);
});

it('can create a moderator', function () {
    // Arrange
    $moderator = Moderator::factory()->make();


    // Act & Assert
    livewire(ModeratorResource\Pages\CreateModerator::class)
        ->fillForm([
            'name' => $moderator->name,
            'email' => $moderator->email,
        ])
        ->call('create')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('moderators', [
        'name' => $moderator->name,
        'email' => $moderator->email,
    ]);
});

it('can update a moderator', function () {
    // Arrange
    $moderator = Moderator::factory()->create();

    // Act & Assert
    livewire(ModeratorResource\Pages\EditModerator::class, ['record' => $moderator->getRouteKey()])
        ->fillForm([
            'name' => 'New Name',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('moderators', [
        'name' => 'New Name',
    ]);
});

it('can soft delete a moderator', function () {
    // Arrange
    $moderator = Moderator::factory()->create();

    // Act & Assert
    livewire(ModeratorResource\Pages\EditModerator::class, ['record' => $moderator->getRouteKey()])
        ->callPageAction(DeleteAction::class);

    $this->assertSoftDeleted('moderators', [
        'id' => $moderator->id,
    ]);
});
