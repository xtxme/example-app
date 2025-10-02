<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @php
        $user = auth()->user();
        $photoUrl = $user->profile_photo
            ? route('user.photo', ['filename' => $user->profile_photo])
            : asset('images/british-bilion.jpg');
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    <h1 class="text-2xl font-semibold mb-4">Hello, {{ $user->name }}!</h1>

                    @if ($user->birthdate)
                    <p class="mb-4">
                       <span class="text-indigo-600 font-semibold">
                        Birthdate is {{$user->birthdate->format('Y-m-d')}}!
                       </span>  
                    </p>
                    @endif

                    <img src="{{ $photoUrl }}"
                        alt="Profile Photo"
                        class="w-28 h-28 rounded-full object-cover mx-auto mb-3"
                        onerror="this.onerror=null;this.src='{{ asset('images/british-bilion.jpg') }}';"
                    />
                    <p class="mb-1 opacity-80">ยากมากๆเลยค่าา</p>
                    <p class="opacity-70">{{ __("You're logged in!") }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
