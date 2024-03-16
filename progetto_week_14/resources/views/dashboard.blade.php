<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 lg:container mx-auto flex flex-col lg:flex-row w-full px-3">
        <div class="left-dashboard flex flex-col w-full">
            <div class="projects-section me-5 flex flex-col md:flex-row">
                <div class="my-projects-box mb-10 md:me-4">
                    <h2 class="text-3xl mb-4">Your Projects</h2>
                    <x-owned-projects :user="$user" />
                </div>
                <div class="working-on-projects">
                    <h2 class="text-3xl mb-4">Working on Projects</h2>
                    <x-working-projects :userProjects="$userProjects" />
                </div>
            </div>

            <div class="my-activities me-4 flex-grow mt-3">
                <h2 class="text-3xl mb-4">Your tasks</h2>
                <x-user-activities :user="$user" />
            </div>

        </div>
        <div class="chat-box">
            <h2 class="text-3xl my-4 lg:hidden">Other Users</h2>
            <x-chat-box :users="$users" />
        </div>
    </div>

    @push('scripts')
        @vite(['resources/js/closeAlertBox.js'])
    @endpush
</x-app-layout>
