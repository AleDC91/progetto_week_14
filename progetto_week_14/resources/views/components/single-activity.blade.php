<div class="flex content-between flex-col px-4 pb-3 bg-white hover:bg-slate-300 leading-tight transition-all rounded-lg border-b-2 mb-2 shadow-lg w-full">
    <a role="button" href="{{ route('projects.show', ['project' => $activity->project]) }}"
        class="">

        <div
            class="flex justify-between items-center w-full p-3 outline-none bg-blue-gray-50/50 text-start text-blue-gray-700 hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
            <h3 class="text-lg"> {{ $activity->name }} </h3>
            <div class="flex items-center">
                <h4 class="me-3 text-slate-900"> Priority: </h4> 

                @switch($activity->priority)
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
            @if (strlen($activity->description) < 100)
                {{ $activity->description }}
            @else
                {{ $excerpt($activity->description, 100) }}
            @endif
        </div>
        <h5 class="pt-2"><span class="text-base font-medium ">Project: </span><span class="text-sm ms-2 font-semibold italic">{{$activity->project->name}}</span></h5>

        <div>
            <h5 class="pt-2"><span class="text-xs font-bold ">DEADLINE: </span><span class="text-sm ms-2 font-semibold italic">{{$activity->end_date ? $activity->end_date : "No deadline given"}}</span></h5>
        </div>
        <div class="colleagues py-2">
            <h3 class="text-base bold"> Your colleagues</h3>
            <div class="colleagues-images flex py-2 ms-5" >
                @foreach ($activity->users as $user)
                <div class="grid mr-4 place-items-center -ms-5 h-8 w-8 !rounded-full overflow-hidden outline-offset-2 outline-4 outline-red-600">
                    <img alt="{{ $user->name }}" src="{{ $user->profile_image }}"
                    class="shadow-lg relative inline-block h-8 w-8 !rounded-full  object-cover object-center" />
                </div>
                @endforeach
            </div>
        </div>
        {{-- @if (Route::currentRouteName() === 'projects.show')  --}}

    </a>
    @if (Route::currentRouteName() === 'projects.show')
    <div class="text-right w-full">

    <x-footer-activity :activity="$activity"/>
</div>
@endif
</div>