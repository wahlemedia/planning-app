<?php

declare(strict_types=1);

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


    public $listView = 'grid';

    public $search = '';

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


    protected $queryString = ['search', 'listView'];


    public function mount()
    {
        $this->topics = Topic::query()
            ->where('title', 'like', "%{$this->search}%")
            ->get();
    }

    public function updatedSearch()
    {
        $this->topics = Topic::query()
            ->where('title', 'like', "%{$this->search}%")
            ->get();
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
