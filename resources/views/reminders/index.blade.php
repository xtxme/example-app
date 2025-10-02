<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reminders') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="mb-4 rounded-lg bg-green-100 text-green-800 px-4 py-2">
                            {{ session('success') }}
                        </div>
                    @endif

                        <a href="{{ route('reminders.create') }}"
                           class="inline-flex items-center px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                            + New Reminder
                        </a>

                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full text-left border-separate border-spacing-y-2">
                            <thead>
                                <tr class="text-sm text-gray-600 dark:text-gray-300">
                                    <th class="px-4 py-2">Title</th>
                                    <th class="px-4 py-2">Remind At</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Tags</th>
                                    <th class="px-4 py-2 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reminders as $reminder)
                                    <tr class="bg-gray-50 dark:bg-gray-900/40 hover:bg-gray-100 dark:hover:bg-gray-900/60">
                                        <td class="px-4 py-3 font-medium">
                                            <a href="{{ route('reminders.show', $reminder) }}"
                                               class="text-blue-700 dark:text-blue-400 hover:underline">
                                                {{ $reminder->title }}
                                            </a>
                                        </td>

                                        <td class="px-4 py-3 whitespace-nowrap">
                                            {{ optional($reminder->remind_at)->format('Y-m-d H:i') }}
                                        </td>

                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-semibold {{ $reminder->status_classes }}">
                                                {{ $reminder->status_label }}
                                            </span>
                                        </td>

                                        <td class="px-4 py-3">
                                            <div class="flex flex-wrap gap-2">
                                                @foreach ($reminder->tags as $tag)
                                                    <span class="inline-block rounded-full bg-gray-200 text-gray-800 text-sm px-2 py-1">
                                                        {{ $tag->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </td>

                                        <td class="px-4 py-3">
                                            <div class="flex items-center justify-end gap-4">
                                                <a href="{{ route('reminders.edit', $reminder) }}"
                                                   class="text-blue-600 hover:underline">Edit</a>

                                                <form action="{{ route('reminders.destroy', $reminder) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Delete this reminder?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:underline">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                            No reminders found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
