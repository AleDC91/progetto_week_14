<form action="{{ route('activities.store', ['project' => $project]) }}" class="m-10 p-8 mx-auto" method="post">
    @csrf
    <div class="flex flex-col lg:flex-row gap-5">
        <div class="w-full">
            <div class="mb-5">
                <label for="activity_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Activity
                    Name</label>
                <input type="text" id="activity_name" name="activity_name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Activity name..." required />
            </div>
            <div class="mb-5">
                <label for="activity_description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Activity
                    Description</label>
                <input type="text" id="activity_description" name="activity_description"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Activity description..." />
            </div>
            <div class="flex justify-center">
                <div class="mb-5 w-full">
                    <label for="activity_start_date"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start
                        Date</label>
                    <input type="date" id="activity_start_date" name="activity_start_date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required />
                </div>
                <div class="mb-5 w-full">
                    <label for="activity_end_date"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estimated
                        Deadline</label>
                    <input type="date" id="activity_end_date" name="activity_end_date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
            </div>

            <div class="mb-5 w-full">
                <label for="activity_priority"
                    class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Priority</label>
                <select id="activity_priority" name="activity_priority"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
        </div>
        <div class="mb-5 w-full">
            <div class="mb-5 w-full">
                <label for="activity_hours"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estimated
                    Hours</label>
                <input type="number" id="activity_hours" name="activity_hours"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>

            <div class="mb-5 w-full">
                <label for="activity_status"
                    class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Status</label>
                <select id="activity_status" name="activity_status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="pending">Pending</option>
                    <option value="in_progress">In progress</option>
                    <option value="completed">Completed
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

            <input type="hidden" id="selected-users-data" name="selected-users-data">



        </div>

    </div>
    <button type="submit"
        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create!</button>
    @push('scripts')
        @vite(['resources/js/assignUsersCreate.js'])
    @endpush
</form>
