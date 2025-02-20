<div class="max-w-6xl mx-auto flex overflow-x-auto  space-x-4 py-6" x-data="{ draggingAbstractId: null }">
    
    <div class="flex-none w-64 bg-gray-100 p-4 rounded-lg shadow overflow-y-auto max-h-[72vh]" @dragover.prevent="$event.dataTransfer.dropEffect = 'move'"
        @drop.prevent="draggingAbstractId && $wire.call('assignAbstractToReviewer', draggingAbstractId, null)">
        <h2 class="font-bold mb-4 text-gray-800">Unassigned Abstracts</h2>
        <div class="space-y-2">
            @foreach($unassignedAbstracts as $abstract)
                <div class="bg-white p-2 shadow rounded-lg cursor-move" draggable="true"
                     @dragstart="draggingAbstractId = {{ $abstract->id }}"
                     @dragend="draggingAbstractId = null">
                    <p class="truncate">{{ $abstract->original_name }}</p>
                </div>
            @endforeach
        </div>
    </div>

    @foreach($reviewers as $reviewer)
        <div class="flex-none w-64 bg-blue-100 p-4 rounded-lg shadow overflow-y-auto max-h-[72vh]" @dragover.prevent="$event.dataTransfer.dropEffect = 'move'"
            @drop.prevent="draggingAbstractId && $wire.call('assignAbstractToReviewer', draggingAbstractId, {{ $reviewer->id }})">
            <h2 class="font-bold mb-4 text-blue-800">{{ $reviewer->name }}</h2>
            <div class="space-y-2">
                @foreach($reviewer->assignedAbstracts as $abstract)
                    <div class="bg-white p-2 shadow rounded-lg cursor-move" draggable="true"
                         @dragstart="draggingAbstractId = {{ $abstract->id }}"
                         @dragend="draggingAbstractId = null">
                        <p class="truncate">{{ $abstract->original_name }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>