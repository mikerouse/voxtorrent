<div class="container mx-auto px-4 dark:bg-gray-800 text-gray-900 dark:text-white">

    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight my-4">
        {{ __('System Roles Manager') }}
    </h2>

@if (session()->has('message'))
    <div class="alert alert-success my-4">
        {{ session('message') }}
    </div>
@endif


<div class="row my-4">
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
        {{ __("Handle with care!") }}
    </div>
</div>

<!-- Modal for Create and Edit -->
@if($isModalOpen)
    @include('livewire.create-role')
@endif

<script type="text/javascript">
window.addEventListener('roleUpdated', event => {
    location.reload();
})
</script>

<button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New Role</button>

<table class="table-auto w-full mt-4 text-gray-900 dark:text-white">
    <thead class="">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Role ID') }}</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Role Name') }}</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Role Description') }}</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Self-selectable') }}</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Backend Management') }}</th>
            <th colspan="2" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
        </tr>
    </thead>
    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700"">
        @foreach ($this->roles as $role)
            <tr class="text-gray-900 dark:text-gray-200">
                <td class="border px-4 py-2">{{ $role->id }}</td>
                <td class="border px-4 py-2">{{ $role->name }}</td>
                <td class="border px-4 py-2">{{ $role->description }}</td>
                <td class="border px-4 py-2">{!! $role->self_selectable ? '<span style="color: green!important;">&#10004;</span>' : '<span>&#10006;</span>' !!}</td>
                <td class="border px-4 py-2">{!! $role->backend_management ? '<span style="color: green!important;">&#10004;</span>' : '<span>&#10006;</span>' !!}</td>
                <td class="text-center border px-4 py-2">
                    <button wire:click="edit({{ $role->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                </td>
                <td class="text-center border px-4 py-2">
                    <form action="{{ route('manage-roles.destroy', $role) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this role?')">
                        @csrf
                        @method('DELETE')
                
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                            {{ __('Delete') }}
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>