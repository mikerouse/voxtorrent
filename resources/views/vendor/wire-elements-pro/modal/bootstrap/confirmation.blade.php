<x-wire-elements-pro::bootstrap.modal onSubmit="confirm" :contentPadding="false">

    <x-slot name="title">{{ $prompt['title'] }}</x-slot>

    <div>

        <p class="px-3 pt-3">{{ $prompt['message'] }}</p>

        @if($tableData)
            <table class="table border-top mb-0">
                <thead>
                <tr>
                    @foreach($tableHeaders as $header)
                        <th scope="col" class="px-3 bg-light">
                            {{ $header }}
                        </th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($tableData as $columns)
                    <tr>
                        @foreach($columns as $column)
                            <td class="px-3">
                                {{ $column }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        @if($confirmPhrase)
            <div class="px-3 py-3">
                <input class="form-control" type="text" wire:model.defer="confirmPhraseInput" placeholder="{{ __("wire-elements-pro::modal.confirmation.please_enter_phrase_to_continue", ['phrase' => $confirmPhrase]) }}" required>

                @error('confirmPhraseInput')
                <div class="mt-2 text-danger">{{ $message }}</div>
                @enderror
            </div>
        @endif
    </div>

    <x-slot name="buttons">
            <button type="button" wire:click="$dispatch('modal.close')" class="btn btn-secondary" data-bs-dismiss="modal">{{ $prompt['cancel'] }}</button>
            <button type="submit" class="btn btn-primary">{{ $prompt['confirm'] }}</button>
    </x-slot>
</x-wire-elements-pro::bootstrap.modal>
