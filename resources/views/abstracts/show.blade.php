<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $abstract->original_name }}
        </h2>
        <h3 class="text-gray-600 dark:text-gray-400">By: {{ $abstract->user->name }}</h3>
    </x-slot>

    <div class="py-12 flex flex-col items-center justify-center">
        <div class="flex w-full justify-center">
            <div class="w-2/5 p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-4 max-h-[78vh] overflow-auto">
                <iframe src="{{ asset($abstract->file_path) }}" class="w-full h-full" style="border:none;"></iframe>
            </div>

            <div class="w-1/5 p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-4 max-h-[78vh] ml-12 overflow-y-auto">
                @livewire('review-abstract', ['abstractId' => $abstract->id])                   
            </div>
        </div>
    </div>
</x-app-layout>
