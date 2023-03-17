<?php

declare(strict_types=1);

use function pest\Laravel\get;

it('can access the home page', function () {
    // Act & Assert
    expect(get(route('pages.home')))
        ->assertSuccessful();
});
