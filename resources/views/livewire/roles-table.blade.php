<div>
@if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<div class="row">
    <div class="col-md-12">
        <h1 class="text-2xl font-bold">{{ __('Roles') }}</h1>
    </div>
</div>

<div class="row">
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
        {{ __("This page is visible to System Administrators only - handle with care!") }}
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

<div class="row">
    <div class="col-md-12">
        <a href="{{ route('manage-roles.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">
            {{ __('Create New Role') }}
            </a>
</div>

<div class="row">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <table class="table-auto w-full">
                    <thead class="bg-gray-50">
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
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>{!! $role->self_selectable ? '<span>&#10004;</span>' : '<span>&#10006;</span>' !!}</td>
                                <td>{!! $role->backend_management ? '<span>&#10004;</span>' : '<span>&#10006;</span>' !!}</td>
                                <td class="text-center">
                                    <button wire:click="edit({{ $role->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                </td>
                                <td class="text-center">
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
        </div>
    </div>
</div>
</div>