@if (count($userProjects) === 0)
    <div class="relative flex flex-col text-gray-700 bg-white shadow-md w-96 rounded-xl bg-clip-border">
        <nav class="flex min-w-[240px] flex-col gap-1 p-4 font-sans text-base font-normal text-blue-gray-700 italic">
            You're not working on any project yet.
        </nav>
    </div>
@else
    <div class="relative flex flex-col text-gray-700 rounded-xl bg-clip-border w-full">
        <nav class="flex min-w-[240px] flex-col gap-1  font-sans text-base font-normal text-blue-gray-700 w-full">
            @foreach ($userProjects as $project)
                <div class="flex content-between items-center w-full">
                    <a role="button" href="{{ route('projects.show', ['project' => $project]) }}"
                        class="px-4 pb-3 bg-white hover:bg-slate-300 leading-tight transition-all rounded-lg border-b-2 mb-2 shadow-lg w-full">

                        <div
                            class="flex justify-between items-center w-full p-3 outline-none bg-blue-gray-50/50 text-start text-blue-gray-700 hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                            <h3 class="text-lg"> {{ $project->name }} </h3>
                            <div class="flex items-center">
                               <h4 class="me-3 text-slate-900"> Priority: </h4> 
                                @switch($project->priority)
                                    @case('low')
                                    <span class="text-sm text-slate-900 me-2">LOW</span>
                                        <span style="color: green; font-size: 25px">
                                            <i class="fa-solid fa-face-smile-wink me-2"></i>
                                        </span>
                                    @break

                                    @case('medium')
                                    <span class="text-sm text-slate-900 me-2">MEDIUM</span>
                      
                                        <span style="color: orange; font-size: 25px">                                            
                                            <i class="fa-solid fa-face-rolling-eyes  me-2"></i>
                                        </span>
                                    @break

                                    @case('high')
                                    <span class="text-sm text-slate-900 me-2">HIGH</span>
                                        <span style="color:red; font-size: 25px">
                                            <i class="fa-solid fa-face-sad-cry me-2"></i>
                                        </span>
                                    @break

                                    @default
                                @endswitch
                            </div>
                        </div>
                        <div class="text-sm">
                            @if (strlen($project->description) < 100)
                                {{ $project->description }}
                            @else
                                {{ $excerpt($project->description, 100) }}
                            @endif
                        </div>
                        <div>
                            <h5 class="pt-2"><span class="text-xs font-bold ">DEADLINE: </span><span class="text-sm ms-2 font-semibold italic">{{$project->end_date ? $project->end_date : "No deadline given"}}</span></h5>
                        </div>
                        <div class="flex items-center my-2 py-2 mb-0 pb-0 border-t-2">
                            <div class="grid mr-4 place-items-center">
                                <img alt="{{ $project->owner->name }}" src="{{ $project->owner->profile_image }}"
                                    class="relative inline-block h-8 w-8 !rounded-full  object-cover object-center overflow-hidden" />
                            </div>
                            <h6
                                class="block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                                <span class="text-slate-900">Owner: </span>{{ $project->owner->name }}
                            </h6>
                        </div>
                    </a>
                </div>
            @endforeach
        </nav>
    </div>

@endif
