{{-- resources/views/reminders/_form.blade.php --}}
@props(['reminder' => null, 'tags' => []])

@php
    $isEdit = filled($reminder?->id);
    $selectedTagIds = old('tags', $isEdit ? $reminder->tags->pluck('id')->toArray() : []);
@endphp

<form method="POST"
      action="{{ $isEdit ? route('reminders.update', $reminder) : route('reminders.store') }}"
      class="space-y-6">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    {{-- Title --}}
    <div>
        <label class="block text-sm font-medium mb-1">Title</label>
        <input type="text" name="title"
               value="{{ old('title', $reminder->title ?? '') }}"
               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
        @error('title')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Remind At --}}
    <div>
        <label class="block text-sm font-medium mb-1">Remind At</label>
        <input type="datetime-local" name="remind_at"
               value="{{ old('remind_at', optional($reminder?->remind_at)->format('Y-m-d\TH:i')) }}"
               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
        @error('remind_at')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Tags --}}
    <div>
        <label class="block text-sm font-medium mb-2">Select Tags</label>
        <div class="flex flex-wrap gap-3">
            @foreach ($tags as $tag)
                <label class="inline-flex items-center gap-2 rounded-full bg-gray-100 px-3 py-1">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                           @checked(in_array($tag->id, $selectedTagIds))>
                    <span class="text-sm">{{ $tag->name }}</span>
                </label>
            @endforeach
        </div>
        @error('tags')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Actions --}}
    <div class="pt-2 flex items-center gap-3">
        <button type="submit"
                class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
            {{ $isEdit ? 'Update' : 'Save' }}
        </button>
        <a href="{{ route('reminders.index') }}" class="text-gray-600 hover:underline">Cancel</a>
    </div>
</form>
