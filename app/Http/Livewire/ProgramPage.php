<?php

namespace App\Http\Livewire;

use App\Models\Program;
use Livewire\Component;

class ProgramPage extends Component
{

    public $program;


    public function mount()
    {
        $this->program = Program::query()
            ->with('items.topic')
            ->current();
    }


    public function render()
    {
        return view('livewire.pages.program-page')
            ->layout('layouts.guest');
    }
}
