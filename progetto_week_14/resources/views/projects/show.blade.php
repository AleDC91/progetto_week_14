<x-app-layout>
    <div class="container mx-auto px-4 py-16">
        <h1 class="text-3xl my-3 text-center">{{ ucfirst($project->name) }}</h1>
        <div class="project-details">
            <h4><span class="font-semibold text-xl">Project Name:</span> {{ $project->name }}</h4>
            <h4><span class="font-semibold text-xl">Description:</span>
                {{ $project->description ? $project->description : 'No description provided' }}</h4>
            <h4><span class="font-semibold text-xl">Start Date:</span> {{ $project->start_date }}</h4>

            <div class="flex items-center">
                <h4 class="font-semibold text-xl me-5">Priority:</h4>
                @switch($project->priority)
                    @case('low')
                        <span style="color: green; font-size: 25px">
                            <i class="fa-solid fa-face-smile-wink me-2"></i>
                        </span>
                    @break

                    @case('medium')
                        <span style="color: orange; font-size: 25px">
                            <i class="fa-solid fa-face-rolling-eyes  me-2"></i>
                        </span>
                    @break

                    @case('high')
                        <span style="color:red; font-size: 25px">
                            <i class="fa-solid fa-face-sad-cry me-2"></i>
                        </span>
                    @break

                    @default
                @endswitch
                {{strtoupper($project->priority)}}
            </div>
        </div>
        <div class="project-activities">
            @foreach($project->activities as $activity)
                <x-single-activity :activity="$activity" />
            @endforeach
        </div>
        <div class="chat-box">

        </div>
    </div>
</x-app-layout>
