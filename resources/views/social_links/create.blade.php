<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Add New Social Media Link') }}</h2></x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('social-links.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium mb-1">Platform Name</label>
                        <input name="platform" value="{{ old('platform') }}" required
                               class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-gray-100"/>
                        @error('platform')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">URL</label>
                        <input name="url" type="url" value="{{ old('url') }}" required
                               class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-gray-100"/>
                        @error('url')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                    </div>
                    <x-primary-button>{{ __('Save Link') }}</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
