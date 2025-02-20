<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="p-6">
        <div class="flex justify-between mb-4">
            <button wire:click="$dispatch('openCreateUserModal')" class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded hover:bg-green-700 focus:outline-none">
                Add New User
            </button>
        </div>
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Name
                    </th>
                    <th class="px-5 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Email
                    </th>
                    <th class="px-5 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Role
                    </th>
                    <th class="px-5 py-3 border-b border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Actions
                    </th>
                    <th class="px-5 py-3 border-b border-gray-200 bg-gray-100"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $user->name }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $user->email }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ implode(', ', $user->getRoleNames()->toArray()) }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            <button wire:click="$dispatchTo('edit-user-modal', 'editUser', {userId: {{ $user->id }}})" class="text-blue-500">Edit</button>
                            <button wire:click="deleteUser({{ $user->id }})" class="ml-2 text-red-500">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-5 py-5 bg-white flex flex-col xs:flex-row items-center xs:justify-between">
        {{ $users->links() }}
    </div>
    @livewire('create-user-modal')
    @livewire('edit-user-modal')
</div>
