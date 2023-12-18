<div class="space-y-4">

    <div class="max-w-2xl mt-1 tems-center justify-center items-center m-auto" id="political-parties-dashboard-container">

        <div class="w-full mx-auto sm:px-6 lg:px-8 justify-center">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-2 text-gray-900 dark:text-gray-100">
                    <h2 class="my-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __("political parties dashboard") }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="w-full mx-auto sm:px-6 lg:px-8 justify-center">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-2 text-gray-900 dark:text-gray-100">
                    @foreach($this->political_parties as $party)
                        <div class="p-4 mb-4 bg-white rounded shadow" x-data="{ open: false }">
                            <h2 class="text-xl font-bold text-gray-900">{{ $party->name }}</h2>
                            <p class="text-gray-700">ID: {{ $party->id }}</p>
                            <div class="all-fields-container" x-data="{ allFieldsOpen: false }">
                                <h5 @click="allFieldsOpen = !allFieldsOpen" class="cursor-pointer flex items-center font-bold text-sm">
                                    all fields
                                    <i :class="{ 'fas fa-caret-right': !allFieldsOpen, 'fas fa-caret-down': allFieldsOpen }" class="fa-xs ml-1 mt-1"></i>
                                </h5>
                                <div class="all-fields" x-show="allFieldsOpen">
                                    <div>
                                        @foreach($party->getAttributes() as $field => $value)
                                        <div>
                                            <h6 class="font-bold text-base">{{ $field }}: </h6>
                                        </div>
                                        <div>
                                            <p>{{ $value }}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="supporter-summary-container" x-data="{ supporterSummaryOpen: false }">
                                <h5 @click="supporterSummaryOpen = !supporterSummaryOpen" class="cursor-pointer flex items-center font-bold text-sm">
                                    supporter summary ( {{ $party->supporters->count() }} )
                                    <i :class="{ 'fas fa-caret-right': !supporterSummaryOpen, 'fas fa-caret-down': supporterSummaryOpen }" class="fa-xs ml-1 mt-1"></i>
                                </h5>
                                <div class="supporter-summary" x-show="supporterSummaryOpen">
                                    <div>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="px-4 py-2">name</th>
                                                    <th class="px-4 py-2">handle</th>
                                                    <th class="px-4 py-2">primary constituency</th>
                                                    <th class="px-4 py-2">torrents signed</th>
                                                </tr>
                                            </thead>
                                            @foreach($party->supporters as $supporter)
                                            <tr>
                                                <td class="border px-4 py-2">{{ $supporter->name }}</td>
                                                <td class="border px-4 py-2">
                                                    <a href="/{{ $supporter->handle }}" target="_blank">
                                                        {{ $supporter->handle }} <i class="fas fa-external-link fa-xs text-gray-400"></i>
                                                    </a>
                                                </td>
                                                <td class="border px-4 py-2">{{ $supporter->primary_constituency->name }}</td>  
                                                <td class="border px-4 py-2">{{ $supporter->torrents_signed->count() }}</td>  
                                            </tr>
                                            @endforeach
                                            <tfoot>
                                                <tr>
                                                    <td class="border px-4 py-2">total</td>
                                                    <td class="border px-4 py-2">{{ $party->supporters->count() }}</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

</div>