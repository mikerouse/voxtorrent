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
                        <div class="p-4 mb-4 bg-white rounded shadow">
                            <h2 class="text-xl font-bold text-gray-900">{{ $party->name }}</h2>
                            <p class="text-gray-700">ID: {{ $party->id }}</p>
                            <table class="table-auto w-full">
                                <tbody>
                                    @foreach($party->getAttributes() as $field => $value)
                                        <tr>
                                            <td class="border px-4 py-2 text-gray-700 font-bold">{{ $field }}</td>
                                            <td class="border px-4 py-2 text-gray-700">{{ $value }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

</div>