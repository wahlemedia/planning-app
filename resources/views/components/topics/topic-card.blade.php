<li class="col-span-1">
    <button class="divide-y divide-gray-200 rounded-lg bg-white shadow w-full hover:bg-gray-50"
        wire:click="showTopicDetail('{{ $topic->id }}')" wire:key="topic-card-{{ $topic->id }}">
        <div class="flex w-full items-center justify-between space-x-6 p-6">
            <div class="flex-1 truncate">
                <div class="flex items-center justify-between">
                    <h3 class="truncate text-sm font-medium text-gray-900">{{ $topic->title }}</h3>

                    <div class="space-x-1">
                        @foreach ($topic->tags as $tag)
                            <span
                                class="inline-block flex-shrink-0 rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">{{ $tag->name }}</span>
                        @endforeach
                    </div>

                </div>

                <p class="mt-1 text-sm text-gray-500 truncate">{{ $topic->description }}</p>

                <footer class="mt-4">
                    <div class="grid grid-cols-3">
                        <div class="flex items-center">
                            <x-heroicon-o-link class="h-5 w-5 flex-shrink-0 text-gray-400" />
                            <span class="ml-2">{{ count($topic->links ?? []) }} Links</span>
                        </div>
                        <div class="flex items-center">
                            <x-heroicon-o-document class="h-5 w-5 flex-shrink-0 text-gray-400" />
                            <span class="ml-2">{{ $topic->getMedia()->count() }} Files</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </button>
</li>
