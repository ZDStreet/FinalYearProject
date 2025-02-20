<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Reviews') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                    <!-- Todo Column -->
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <h3 class="font-bold text-lg mb-4">Todo</h3>
                        <div class="space-y-2">
                            @foreach($todoReviews as $review)
                                <a href="{{ route('abstracts.show', $review['abstract']->id) }}" class="block p-4 bg-white rounded shadow hover:bg-gray-50">
                                    <p class="truncate">{{ $review['abstract']->original_name }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- In Progress Column -->
                    <div class="bg-orange-100 p-4 rounded-lg">
                        <h3 class="font-bold text-lg mb-4">In Progress</h3>
                        <div class="space-y-2">
                            @foreach($inProgressReviews as $review)
                                <a href="{{ route('abstracts.show', $review['abstract']->id) }}" class="block p-4 bg-white rounded shadow hover:bg-yellow-50">
                                    <p class="truncate">{{ $review['abstract']->original_name }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Published Column -->
                    <div class="bg-green-100 p-4 rounded-lg">
                        <h3 class="font-bold text-lg mb-4">Published</h3>
                        <div class="space-y-2">
                            @foreach($publishedReviews as $review)
                                <a href="{{ route('abstracts.show', $review['abstract']->id) }}" class="block p-4 bg-white rounded shadow hover:bg-green-50">
                                    <p class="truncate">{{ $review['abstract']->original_name }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
