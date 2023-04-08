<?php

declare(strict_types=1);

use App\Http\Controllers\Pages\WelcomeController;
use App\Http\Livewire\TopicPage;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class)->name('home');

Route::get('/topics', TopicPage::class)->name('topics.index');
