<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Social Media Links') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <div class="mb-4 text-center">
                    <a href="{{ route('social-links.create') }}"
                       class="inline-flex items-center px-4 py-2 rounded-md text-white font-semibold
                              bg-gradient-to-r from-sky-500 to-yellow-300 hover:opacity-90">
                        {{ __('Add New Link') }}
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-slate-200 to-lime-100">
                                <th class="text-left px-4 py-2">{{ __('Platform') }}</th>
                                <th class="text-left px-4 py-2">{{ __('URL') }}</th>
                                <th class="text-right px-4 py-2">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse ($links as $link)
                                <tr>
                                    <td class="px-4 py-3 font-medium">{{ $link->platform }}</td>
                                    <td class="px-4 py-3">
                                        <a href="{{ $link->url }}" target="_blank" class="text-blue-600 underline">
                                            {{ $link->url }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-3 text-right space-x-2">
                                        <a href="{{ route('social-links.edit', $link) }}"
                                           class="px-3 py-1 rounded-md bg-yellow-400 text-black font-semibold">Edit</a>
                                        <form action="{{ route('social-links.destroy', $link) }}"
                                              method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Delete this link?')"
                                                class="px-3 py-1 rounded-md bg-red-500 text-white font-semibold">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="px-4 py-6 text-center text-gray-500">No links yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            @if (session('status'))
                Swal.fire({icon:'success', title:'Success', text:'{{ session('status') }}'});
            @endif
        });
    </script>
</x-app-layout>
