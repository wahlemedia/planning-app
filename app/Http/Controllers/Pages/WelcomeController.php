<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        return view('pages.welcome');
    }
}
