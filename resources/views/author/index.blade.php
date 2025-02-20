<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Abstract') }}
        </h2>
    </x-slot>

    <div class="py-12 flex flex-col items-center justify-center">
        @if($papers->isEmpty())
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <form method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col items-center justify-center">
                        <x-label for="document" value="{{ __('Upload Document') }}" class="mb-4" />
                        <input id="document" type="file" name="document" class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 focus:file:outline-none focus:file:ring-2 focus:file:ring-blue-200 focus:file:border-blue-300" required />
                    </div>
                    <div class="flex items-center justify-center mt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-700 disabled:opacity-25 transition">
                            {{ __('Upload') }}
                        </button>
                    </div>
                </form>
            </div>
        @else
        <div class="flex w-full justify-center">
            <!-- Abstract viewer left side -->
            <div class="w-2/5 p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-4 h-[78vh]">
                <iframe src="{{ asset($papers[0]->file_path) }}" class="w-full h-full" style="border:none;"></iframe>
            </div>
        
            <!-- Right panel container with flex direction and divide the height -->
            <div class="flex flex-col w-1/5 ml-12 space-y-4 h-[78vh]">
                <!-- Top right section with download and delete buttons -->
                <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6 flex flex-col space-y-4">
                    <div class="flex flex-col space-y-4"> <!-- Stack the buttons vertically -->
                        <a href="{{ asset($papers[0]->file_path) }}" download class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-700 transition ease-in-out duration-150 w-full">
                            Download Abstract
                        </a>
                        <form method="POST" action="{{ route('delete', $papers[0]->id) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-700 transition ease-in-out duration-150 w-full">
                                Delete Abstract
                            </button>
                        </form>
                    </div>
                    <!-- Re-upload form below the buttons -->
                    <div class="pt-4 border-t border-gray-200"> <!-- Maintain separation with a top border -->
                        <form method="POST" action="{{ route('reupload', $papers[0]->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="flex flex-col items-center justify-center">
                                <x-label for="document" value="{{ __('Upload Document') }}" class="mb-4" />
                                <input id="document" type="file" name="document" class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 focus:file:outline-none focus:file:ring-2 focus:file:ring-blue-200 focus:file:border-blue-300" required />
                            </div>
                            <div class="flex items-center justify-center mt-4">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-700 disabled:opacity-25 transition">
                                    {{ __('Upload') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
        
                <!-- Review section with scrollbar -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 flex-grow overflow-y-auto">
                    @livewire('review-abstract', ['abstractId' => $papers[0]->id])
                </div>
            </div>
        </div>
        
        @endif
    </div>
</x-app-layout>
