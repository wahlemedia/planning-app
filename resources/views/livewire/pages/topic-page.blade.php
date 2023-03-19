<div class="pt-4 bg-gray-100">
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">

        <div>
            <x-authentication-card-logo />
        </div>

        <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 max-w-6xl container mx-auto">
            @foreach ($topics as $topic)
                <x-topics.topic-card :topic="$topic" wire:key='topic-{{ $topic->id }}' />
            @endforeach
        </ul>

        <div class="mt-10">{{ $topic->id }}</div>
        {{-- 
        <div>
            <x-topics.topic-detail-modal :topic="$topic" :key="$topic->id" />
        </div> --}}

    </div>
</div>
