@slot('header')
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            {{ __('Topics') }}
        </h2>

        <x-primary-button wire:click="createTopic">
            {{ __('Create Topic') }}
        </x-primary-button>
    </div>
@endslot

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow">
            {{ $this->table }}
        </div>
    </div>
</div>
