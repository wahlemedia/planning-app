@props(['id' => null, 'maxWidth' => null, 'topic'])

<x-modal :id="$id" :maxWidth="$maxWidth" wire:model="detailModalOpen" {{ $attributes }}>

    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex justify-between">
            <h3 class="text-base font-semibold leading-6 text-gray-900">{{ $topic?->title }}</h3>

            @if (!is_null($topic))
                <div class="space-x-1">
                    @foreach ($topic->tags as $tag)
                        <span
                            class="inline-block flex-shrink-0 rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">{{ $tag->name }}</span>
                    @endforeach
                </div>
            @endif

        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">About</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $topic?->description }}</dd>
                </div>

                {{-- Links --}}

                @if (count($topic?->links ?? []) > 0)
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Links</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">
                                @foreach ($topic->links as $link)
                                    <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                        <div class="flex w-0 flex-1 items-center">
                                            <x-heroicon-o-link class="h-5 w-5 flex-shrink-0 text-gray-400" />
                                            <span class="ml-2 w-0 flex-1 truncate">{{ $link['name'] }}</span>
                                        </div>

                                        <div class="ml-4 flex-shrink-0">
                                            <a href="https://{{ $link['url'] }}" target="{{ $link['target'] }}"
                                                class="font-medium text-indigo-600 hover:text-indigo-500">Open</a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </dd>
                    </div>
                @endif

                {{-- Attachments --}}
                @if ($topic?->getMedia()->count() > 0)
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Attachments</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">

                                @foreach ($topic?->getMedia() as $media)
                                    <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                        <div class="flex w-0 flex-1 items-center">
                                            <x-heroicon-o-document class="h-5 w-5 flex-shrink-0 text-gray-400" />
                                            <span class="ml-2 w-0 flex-1 truncate">{{ $media->name }}</span>
                                        </div>
                                        <div class="ml-4 flex-shrink-0">
                                            <a href="{{ $media->getUrl() }}" target="_blank"
                                                class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </dd>
                    </div>
                @endif
            </dl>
        </div>
    </div>

</x-modal>
