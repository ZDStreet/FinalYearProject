<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <nav class="flex space-x-4">
                <a href="{{ route('chair.reviewCriteria') }}" class="text-gray-800 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 {{ (request()->routeIs('chair.index') || request()->routeIs('chair.reviewCriteria')) ? 'border-b-2 border-blue-600' : '' }}">
                    Review Criteria
                </a>
                <a href="{{ route('chair.assignAbstracts') }}" class="text-gray-800 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 {{ (request()->routeIs('chair.assignAbstracts')) ? 'border-b-2 border-blue-600' : '' }}">
                    Assign Abstracts
                </a>
            </nav>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">
                @switch($activeSection)
                    @case('assignAbstracts')
                        @livewire('assign-abstract')
                        @break
                    @case('reviewCriteria')
                        @livewire('review-criteria-form')
                        @break
                @endswitch
            </div>            
        </div>
    </div>
</x-app-layout>
