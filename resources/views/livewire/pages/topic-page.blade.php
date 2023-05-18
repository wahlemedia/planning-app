<div class="pt-4">
    <div class="min-h-screen flex flex-col pt-6 sm:pt-0">

        <div class="flex flex-col items-start text-left">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Inspirierende Ideen für das
                Halbjahresprogramm</h1>
            <p class="mt-3 text-lg text-gray-600">Finde die perfekten Themen für dein Halbjahresprogramm - Mit
                unserer Filterfunktion spielend einfach!</p>

        </div>


        <section class="flex justify-between items-center mt-6">
            <div>
                <div class="relative w-full transform transition-all opacity-100 scale-100">
                    <div class="overflow-hidden rounded-lg bg-white">
                        <div class="relative">
                            <form role="search">
                                <input wire:model="search" id="search" name="s"
                                    class="block w-full rounded-lg  appearance-none bg-transparent py-2 pr-10 text-base text-slate-900 placeholder:text-slate-600 focus:outline-none sm:text-sm sm:leading-6"
                                    placeholder="Find anything..." aria-label="Search components" type="text"
                                    aria-autocomplete="list" value="{{ $search }}" tabindex="0">
                                <svg class="pointer-events-none absolute right-4 top-2 h-6 w-6 fill-slate-400"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20.47 21.53a.75.75 0 1 0 1.06-1.06l-1.06 1.06Zm-9.97-4.28a6.75 6.75 0 0 1-6.75-6.75h-1.5a8.25 8.25 0 0 0 8.25 8.25v-1.5ZM3.75 10.5a6.75 6.75 0 0 1 6.75-6.75v-1.5a8.25 8.25 0 0 0-8.25 8.25h1.5Zm6.75-6.75a6.75 6.75 0 0 1 6.75 6.75h1.5a8.25 8.25 0 0 0-8.25-8.25v1.5Zm11.03 16.72-5.196-5.197-1.061 1.06 5.197 5.197 1.06-1.06Zm-4.28-9.97c0 1.864-.755 3.55-1.977 4.773l1.06 1.06A8.226 8.226 0 0 0 18.75 10.5h-1.5Zm-1.977 4.773A6.727 6.727 0 0 1 10.5 17.25v1.5a8.226 8.226 0 0 0 5.834-2.416l-1.061-1.061Z">
                                    </path>
                                </svg>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <fieldset class="mt-2">
                <legend class="sr-only">Ändere die Ansicht</legend>

                <div class="flex">
                    <x-topics.list-view-select wire:model="listView" label="list" value="list" :current="$listView" />
                    <x-topics.list-view-select wire:model="listView" label="grid" value="grid" :current="$listView" />
                </div>

        </section>

        @if ($listView === 'list')
            <x-topics.topic-table :topics="$topics" />
        @elseif ($listView === 'grid')
            <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 mt-8">

                @foreach ($topics as $topic)
                    <x-topics.topic-card :topic="$topic" wire:key='topic-{{ $topic->id }}' />
                @endforeach
            </ul>
        @endif




        <x-topics.topic-detail-modal :topic="$selectedTopic" />
    </div>
</div>
