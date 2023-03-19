@props(['id' => null, 'maxWidth' => null, 'topic' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" wire:model="detailModalOpen" {{ $attributes }}>

    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-base font-semibold leading-6 text-gray-900">{{ $topic->title }}</h3>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                {{-- <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Full name</dt>
                    <dd class="mt-1 text-sm text-gray-900">Margot Foster</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Application for</dt>
                    <dd class="mt-1 text-sm text-gray-900">Backend Developer</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Email address</dt>
                    <dd class="mt-1 text-sm text-gray-900">margotfoster@example.com</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Salary expectation</dt>
                    <dd class="mt-1 text-sm text-gray-900">$120,000</dd>
                </div> --}}
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">About</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $topic->description }}</dd>
                </div>

                {{-- Links --}}
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Links</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">

                            <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                <div class="flex w-0 flex-1 items-center">
                                    <x-heroicon-o-link class="h-5 w-5 flex-shrink-0 text-gray-400" />
                                    <span class="ml-2 w-0 flex-1 truncate">External Link</span>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Open</a>
                                </div>
                            </li>
                        </ul>
                    </dd>
                </div>

                {{-- Attachments --}}
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Attachments</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">

                            <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                <div class="flex w-0 flex-1 items-center">
                                    <x-heroicon-o-document class="h-5 w-5 flex-shrink-0 text-gray-400" />
                                    <span class="ml-2 w-0 flex-1 truncate">coverletter_back_end_developer.pdf</span>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <a href="#"
                                        class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                                </div>
                            </li>
                        </ul>
                    </dd>
                </div>
            </dl>
        </div>
    </div>

</x-modal>