<div class="flex flex-col">
    <div class="overflow-auto p-4 max-h-[70vh]">
        @foreach ($sections as $index => $section)
            <div class="bg-white dark:bg-gray-800 shadow rounded p-4 mb-4">
                <input type="text" wire:model="sections.{{ $index }}.title" class="border p-2 rounded w-full mb-2" placeholder="Section Title">
                <textarea wire:model="sections.{{ $index }}.explanation" class="border p-2 rounded w-full mb-2"  rows="3" placeholder="Explanation"></textarea>
                <input type="number" wire:model="sections.{{ $index }}.max_grade" class="border p-2 rounded w-full mb-2" placeholder="Max Grade">
                <button wire:click.prevent="removeSection({{ $index }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full">
                    Remove
                </button>
            </div>
        @endforeach
    </div>

    <div class="p-4 bg-white dark:bg-gray-800 shadow rounded-t-lg">
        <div class="flex justify-between">
            <button wire:click.prevent="addSection" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                Add Section
            </button>
            <button wire:click.prevent="save" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                Save
            </button>
        </div>
    </div>
</div>
