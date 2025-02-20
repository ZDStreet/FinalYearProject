<div class="overflow-auto p-4">
    
    @if ($criteria)
        <h4 class="font-semibold text-lg mb-4 text-gray-800 dark:text-white">Review Criteria</h4>
        @foreach ($criteria->sections as $section)
            <div class="mb-6 w-full bg-white dark:bg-gray-800 shadow sm:rounded-lg p-4">
                <h5 class="font-semibold text-md mb-2 text-gray-700 dark:text-gray-300">{{ $section->title }}</h5>
                <p class="text-sm mb-4 text-gray-600 dark:text-gray-400">{{ $section->explanation }}</p>
                <div class="text-right">
                    <span class="text-sm font-semibold text-gray-600 dark:text-gray-400">Max Marks: {{ $section->max_grade }}</span>
                </div>

                @if ($canReview && !$isPublished)
                    <textarea class="mt-4 w-full p-2 border border-gray-300 dark:border-gray-700 rounded shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" wire:model.defer="reviewTexts.{{ $section->id }}" placeholder="Enter your review here..."></textarea>
                    <input type="number" class="mt-2 w-full p-2 border border-gray-300 dark:border-gray-700 rounded shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" wire:model.defer="marks.{{ $section->id }}" placeholder="Marks" min="0" max="{{ $section->max_grade }}">
                @endif

                @if ($isPublished)
                    <div class="mt-4 p-2 bg-gray-100 dark:bg-gray-700 rounded">
                        <p class="text-gray-700 dark:text-white">{{ $reviewTexts[$section->id] ?? 'No review submitted.' }}</p>
                    </div>
                    <p class="mt-2 text-gray-700 dark:text-white">Marks: {{ $marks[$section->id] ?? 'No marks assigned.' }}</p>
                @endif
            </div>
        @endforeach
        
        @if ($canReview && !$isPublished)
            <div class="mt-auto p-4 bg-white dark:bg-gray-800 shadow rounded-lg">
                <button wire:click="saveReviewAsDraft" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out w-full">
                    Save as Draft
                </button>
                <button wire:click="publishReview" class="mt-2 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out w-full">
                    Publish Review
                </button>
            </div>
        @endif
    @else
        <p class="text-gray-600 dark:text-gray-400">No review criteria found.</p>
    @endif
</div>
