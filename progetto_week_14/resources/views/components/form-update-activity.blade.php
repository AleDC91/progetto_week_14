<form action="{{ route('activities.update', ['activity' => $activity]) }}" class="m-10 p-8 mx-auto" method="post">
    @method('put')
    @csrf
    <div class="flex flex-col lg:flex-row gap-5">
        <div class="w-full">
            <div class="mb-5">
                <label for="activity_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Activity
                    Name</label>
                <input type="text" id="activity_name" name="activity_name" value="{{ $activity->name }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Activity name..." required />
            </div>
            <div class="mb-5">
                <label for="activity_description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Activity
                    Description</label>
                <input type="text" id="activity_description" name="activity_description"
                    value="{{ $activity->description }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Activity description..." 
                    required/>
            </div>
            <div class="flex justify-center">
                <div class="mb-5 w-full">
                    <label for="activity_start_date"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start
                        Date</label>
                    <input type="date" id="activity_start_date" name="activity_start_date"
                        value="{{ $activity->start_date }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required />
                </div>
                <div class="mb-5 w-full">
                    <label for="activity_end_date"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estimated
                        Deadline</label>
                    <input type="date" id="activity_end_date" name="activity_end_date"
                        value="{{ $activity->end_date }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
            </div>

            <div class="mb-5 w-full">
                <label for="activity_priority"
                    class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Priority</label>
                <select id="activity_priority" name="activity_priority"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="low" {{ $activity->priority === 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ $activity->priority === 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ $activity->priority === 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>
        </div>
        <div class="mb-5 w-full">
            <div class="mb-5 w-full">
                <label for="activity_hours"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estimated
                    Hours</label>
                <input type="number" id="activity_hours" name="activity_hours" value="{{ $activity->estimated_hours }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>

            <div class="mb-5 w-full">
                <label for="activity_status"
                    class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Status</label>
                <select id="activity_status" name="activity_status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="pending" {{ $activity->priority === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ $activity->priority === 'in_progress' ? 'selected' : '' }}>In
                        progress</option>
                    <option value="completed" {{ $activity->priority === 'completed' ? 'selected' : '' }}>Completed
                    </option>
                </select>
            </div>

            <div id="users-assigned-box">
                <div class="users-assigned">
                    <label for="assignees"
                        class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Assignees</label>
                    <select id="assignees">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="selected-users flex gap-2 mt-2 flex-wrap"></div>
            </div>
            @php
                $usersActivity = [];
                foreach ($activity->users as $user) {
                    $usersActivity[] = ["id" => $user->id, "name" => $user->name];
                }
            @endphp
            <input type="hidden" id="selected-users-data" name="selected-users-data" value="{{ json_encode($usersActivity) }}">
            {{-- <div class="m-2 bg-slate-300 rounded-md p-2" bis_skin_checked="1">Miss Sydnee Hahn IV<button class="remove-1 ms-4">X</button></div> --}}


        </div>

    </div>
    <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update!</button>
    @push('scripts')
        @vite(['resources/js/assignUsers.js'])
    @endpush
</form>
