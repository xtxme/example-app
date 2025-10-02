 <x-app-layout>
     <x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
             {{ __('Edit Diary Entry') }}
         </h2>
     </x-slot>

     <div class="py-6">
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                     <!-- Display user greeting -->
                     <h1 class="text-2xl font-bold mb-4">{{ __('Hello, ') . Auth::user()->name . '!' }}</h1>
                     <p class="mt-4"><b>{{ __("Update Your Diary Entry") }}</b></p>
                 </div>
             </div>
         </div>
     </div>

     <div class="py-6">
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 text-gray-900 dark:text-gray-100">
                     <!-- Form to edit the diary entry -->
                     <form method="POST" action="{{ route('diary.update', $diaryEntry) }}">
                         @csrf
                         @method('PUT') <!-- Include the PUT method for updates -->

                         <div class="mb-4">
                             <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                             <input type="date" id="date" name="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100" value="{{ old('date', $diaryEntry->date->format('Y-m-d')) }}" required>
                             @error('date')
                                 <div class="text-red-500 text-sm">{{ $message }}</div> <!-- Displaying the error message -->
                             @enderror
                         </div>

                         <div class="mb-4">
                             <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Content</label>
                             <textarea id="content" name="content" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100" required>{{ old('content', $diaryEntry->content) }}</textarea>
                             @error('content')
                                 <div class="text-red-500 text-sm">{{ $message }}</div> <!-- Displaying the error message -->
                             @enderror
                         </div>

                         <x-primary-button>{{ __('Update Entry') }}</x-primary-button>
                     </form>
                 </div>
             </div>
         </div>
     </div>
    {{-- Tags --}}
    <div class="mb-4">
        <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Select
                Tags</label>
            <div class="flex flex-wrap">
                @foreach ($tags as $tag)
                    <div class="mr-4 mb-2">
                        <input type="checkbox" id="tag_{{ $tag->id }}" name="tags[]"
                            value="{{ $tag->id }}"
                            class="h-5 w-5 text-indigo-600 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-indigo-600"
                            {{-- Pre-check if this tag is already attached --}} @checked(in_array($tag->id, old('tags', $diaryEntry->tags->pluck('id')->toArray())))>
                        <label for="tag_{{ $tag->id }}"
                            class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ $tag->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            @error('tags')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <center>
        <!-- Back to Previous Page Button with Button Component -->
        <x-secondary-button type="button" onclick="window.location.href='{{ url()->previous() }}'">
            {{ __('Back to Previous') }}
        </x-secondary-button>
    </center>

     <script>
         function disableFormSubmissionAndGoBack() {
             window.onbeforeunload = null;  // Disable any beforeunload alert.
             window.history.back();  // Navigate back to the previous page.
         }
     </script>
 </x-app-layout>