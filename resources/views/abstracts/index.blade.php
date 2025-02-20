<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Uploaded Abstracts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($abstracts as $abstract)
                            <a href="{{ route('abstracts.show', $abstract->id) }}" class="text-decoration-none">
                                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200">{{ $abstract->original_name }}</h3>
                                    <p class="text-gray-600 dark:text-gray-400">By: {{ $abstract->user->name }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="mt-8 flex justify-center">
                        {{ $abstracts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>