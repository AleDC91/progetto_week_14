@if ($user->activities->count() === 0)
    <div class="relative flex flex-col text-gray-700 bg-white shadow-md w-96 rounded-xl bg-clip-border">
        <nav class="flex min-w-[240px] flex-col gap-1 p-4 font-sans text-base font-normal text-blue-gray-700 italic">
            You don't have any task assigned yet.
        </nav>
    </div>
@else
    <div class="relative flex flex-col text-gray-700  rounded-xl bg-clip-border">
        <nav class="flex min-w-[240px] flex-col gap-1  font-sans text-base font-normal text-blue-gray-700">
            @foreach ($user->activities as $activity)
                <x-single-activity :activity="$activity" />
            @endforeach
        </nav>
    </div>

@endif
