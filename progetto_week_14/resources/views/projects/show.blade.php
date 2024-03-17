<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Project Page
        </h2>
    </x-slot>

    <div class="py-12 lg:container mx-auto flex flex-col lg:flex-row w-full px-3">
        <div class="left-dashboard flex flex-col w-full">
            <div class="projects-section me-5 flex flex-col md:flex-row">
                <div class="my-projects-box mb-10 md:me-4  w-full">
                    <div class="flex justify-between">
                        <h2 class="text-3xl mb-4">{{ $project->name }}</h2>
                        <div class="flex">
                            <a type="button" href="{{ route('projects.edit', ['project' => $project]) }}"
                                class="bg-blue-700 ms-5 py-2 px-3 mb-5 rounded-lg text-base text-slate-200 hover:bg-blue-400 hover:text-slate-900 me-2">Edit</a>
                            <form id="delete-form" action="{{ route('projects.destroy', ['project' => $project]) }}"
                                method="post">
                                @method('delete')
                                @csrf
                                <button type="submit"
                                    class="bg-red-700 ms-5 py-2 px-3 mb-5 rounded-lg text-base text-slate-200 hover:bg-red-400 hover:text-slate-900 me-2">Delete</a>
                            </form>
                        </div>

                    </div>

                    <x-single-project :project="$project" :usersWorking="$usersWorking" />
                </div>
                <div class="working-on-projects  w-full">
                    <div class="flex justify-between items-center">
                        <h2 class="text-3xl mb-4">Activities</h2>
                        <a type="button" href="{{ route('activities.create', ['project' => $project]) }}"
                            class="bg-green-700 ms-5 py-2 mb-5 rounded-lg text-xl px-4 text-slate-200 hover:bg-green-400 hover:text-slate-900 me-2">+</a>
                    </div>
                    @if ($project->activities->count() > 0)
                        @foreach ($project->activities as $activity)
                            <x-single-activity :activity="$activity" />
                        @endforeach
                    @else
                        <div
                            class="flex content-between flex-col px-4 py-4 italic bg-white hover:bg-slate-300 leading-tight transition-all rounded-lg border-b-2 mb-2 shadow-lg w-full">
                            This project has no activities yet
                        </div>
                    @endif
                </div>
            </div>

        </div>
        <div class="chat-box">
            <h2 class="text-3xl my-4 lg:hidden">Other Users</h2>
            <x-chat-box :users="$users" />
        </div>
    </div>

    @push('scripts')
        @vite(['resources/js/closeAlertBox.js', 'resources/js/askDeleteConfirmation.js'])
    @endpush
</x-app-layout>
