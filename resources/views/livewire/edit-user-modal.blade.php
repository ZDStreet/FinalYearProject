<div>
    @if ($showEditModal)
    <div class="fixed inset-0 flex items-center justify-center">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50"></div>
        <div class="relative bottom-19 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Edit User Details</h3>
                <div class="mt-2 px-7 py-3">
                    <form wire:submit.prevent="saveUser">
                        <input type="text" wire:model="editUserName" class="mb-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Name">
                        <input type="email" wire:model="editUserEmail" class="mb-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Email">
                        <select wire:model="selectedRole" class="mb-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @if ($currentRole)
                                <option value="{{ $currentRole }}">{{ ucfirst($currentRole) }}</option>
                            @else
                                <option value="">Select a Role</option>
                            @endif
                        
                            @foreach ($roles as $role)
                                @if ($role->name !== $currentRole)
                                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="flex flex-col items-center">
                            <button type="button" wire:click="closeUserEdit" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 mb-2">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
