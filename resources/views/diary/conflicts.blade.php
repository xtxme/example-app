<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Conflicting Emotions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-6">{{ __('Summary') }}</h3>

                    @if ($entries->isEmpty())
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ __('No conflicting diary entries found right now.') }}
                        </p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-900">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Content</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Emotion</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Intensity</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($entries as $row)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $row->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ \Carbon\Carbon::parse($row->date)->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 text-sm">
                                                {{ \Illuminate\Support\Str::limit($row->content, 120) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-indigo-600">
                                                {{ $row->emotion_name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if(isset($row->intensity))
                                                    <span class="inline-flex items-center justify-center h-7 w-7 rounded-full bg-red-100 text-red-600 text-sm font-bold">
                                                        {{ $row->intensity }}
                                                    </span>
                                                @else
                                                    <span class="text-gray-400 text-sm">—</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
