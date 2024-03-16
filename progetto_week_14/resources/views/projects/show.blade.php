
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$project->name}}
        </h2>
    </x-slot>

    <div class="py-12 lg:container mx-auto flex flex-col lg:flex-row w-full px-3">
        <div class="left-dashboard flex flex-col w-full">
            <div class="projects-section me-5 flex flex-col md:flex-row">
                <div class="my-projects-box mb-10 md:me-4  w-full">
                    <h2 class="text-3xl mb-4">{{$project->name}}</h2>
                    <x-single-project :project="$project" />
                </div>
                <div class="working-on-projects  w-full">
                    <h2 class="text-3xl mb-4">Activities</h2>
                    @foreach($project->activities as $activity) 
                        <x-single-activity :activity="$activity"/>
                    @endforeach
                </div>
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
