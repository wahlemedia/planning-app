<?php

namespace App\Http\Livewire;

use App\Models\Topic;
use Livewire\Component;

class TopicPage extends Component
{

    public $topics;

    public function mount()
    {
        $this->topics = Topic::all();
    }
    public function render()
    {
        return view('livewire.pages.topic-page')
            ->layout('layouts.guest');
    }
}
