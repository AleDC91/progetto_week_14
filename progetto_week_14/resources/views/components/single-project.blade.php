<div class="bg-white p-3 rounded-lg shadow-xl">

    <p class="pb-2"> <span class="font-semibold text-lg">Description: </span>{{ $project->description }}</p>
    <p class="pb-2"><span class="font-semibold text-lg">Start date: </span class="italic">{{ $project->start_date }}</p>
    <p class="pb-2"><span class="font-semibold text-lg">DEADLINE: </span
            class="italic">{{ $project->end_date ? $project->end_date : 'Deadline not specified' }}</p>
    <p class="pb-2"><span class="font-semibold text-lg">Client: </span class="italic">{{ $project->client_name }}</p>

    <p class="pb-2"><span class="font-semibold text-lg">Activities for this project: </span
            class="italic">{{ $project->activities->count() > 0 ? $project->activities->count() : 'No activities for this project yet!' }}
    </p>
    <a href="#" class="flex items-center">
        <p class="font-semibold text-lg">Owner:</p>
        <div role="button"
            class="flex items-center w-full p-3 leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900  hover:bg-slate-300">
            <div class="grid mr-4 place-items-center">
                <img alt="{{ $project->owner->name }}" src="{{ $project->owner->profile_image }}"
                    class="relative inline-block h-12 w-12 !rounded-full  object-cover object-center" />
            </div>
            <div>
                <h6
                    class="block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    {{ $project->owner->name }}
                </h6>
                <p class="block font-sans text-sm antialiased font-normal leading-normal text-gray-700">
                    {{ $project->owner->email }}
                </p>
            </div>
        </div>
    </a>
    <p class="pb-2"><span class="font-semibold text-lg">Users Working on this project: </span
            class="italic">{{ count($usersWorking) > 0 ? count($usersWorking) : 'Nobody is working on this project yet!' }}
    </p>
    <div class="ms-4">
        @foreach ($usersWorking as $user)
        <img alt="{{ $user->name }}" src="{{ $user->profile_image }}"
        class="relative inline-block h-8 w-8 !rounded-full  object-cover object-center -ms-3 overflow-hidden" />
        @endforeach
    </div>
</div>
