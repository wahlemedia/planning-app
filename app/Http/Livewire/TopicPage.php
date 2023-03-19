<?php

namespace App\Http\Livewire;

use App\Models\Topic;
use Livewire\Component;
use Illuminate\Support\Collection;

class TopicPage extends Component
{

    /**
     * The component's listeners.
     *
     * @var array
     */
    protected $listeners = [];



    /**
     * All topics
     *
     * @var Collection<int, Topic>
     */
    public $topics;


    /**
     * show a detailed topic
     *
     * @var Topic
     */
    public Topic $selectedTopic;

    /**
     * Modal open
     * 
     * @var bool
     */
    public bool $detailModalOpen = false;


    public function mount()
    {
        $this->topics = Topic::all();
    }
    public function render()
    {
        return view('livewire.pages.topic-page')
            ->layout('layouts.guest');
    }

    public function showTopicDetail(Topic $topic)
    {
        $this->selectedTopic = $topic;
        $this->detailModalOpen = true;
    }
}
