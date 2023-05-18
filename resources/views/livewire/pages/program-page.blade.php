<div class="pt-4">
    <div class="min-h-screen flex flex-col pt-6 sm:pt-0">

        <div class="flex flex-col items-start text-left">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Das aktuelle
                Halbjahresprogramm</h1>
            <p class="mt-3 text-lg text-gray-600">Finde alles auf einen Blick: Unser akutelles Halbjahresprogram</p>
        </div>


        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                    Tag</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Uhrzeit</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Thema</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Moderator</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">

                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">

                            @foreach ($program->items as $items)
                                <tr>
                                    <td
                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                        Tag
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $items->started_at }} - {{ $items->started_at }}
                                        {{-- start_time - end_time --}}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $items->topic->title }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $items->moderators->pluck('name')->join(', ') }} </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div>
