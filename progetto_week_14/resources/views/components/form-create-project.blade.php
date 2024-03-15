<form action="{{ route('projects.store') }}" class="m-10 p-8 mx-auto" method="post">
    @csrf
    <input type="hidden" name="project_owner_id" value="{{ Auth::user()->id }}" id="project_owner_id" />
    <div class="mb-5">
        <label for="project_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project
            Name</label>
        <input type="text" id="project_name" name="project_name"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Project name..." required />
    </div>
    <div class="mb-5">
        <label for="project_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project
            Description</label>
        <input type="text" id="project_description" name="project_description"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Project description..." />
    </div>
    <div class="flex justify-center">
        <div class="mb-5 w-full">
            <label for="project_start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start
                Date</label>
            <input type="date" id="project_start_date" name="project_start_date" value="<?php echo date('Y-m-d'); ?>"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Start Date" required />
        </div>
        <div class="mb-5 w-full">
            <label for="project_end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estimated
                Deadline</label>
            <input type="date" id="project_end_date" name="project_end_date"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Start Date" />
        </div>
    </div>
    <div class="mb-5 w-full">
        <label for="project_client" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Client</label>
        <input type="tsext" id="project_client" name="project_client"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Client name..." />
    </div>
    <div class="mb-5 w-full">
        <label for="project_priority"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Priority</label>
        <select id="project_priority" name="project_priority"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="low">Low</option>
            <option value="medium" selected>Medium</option>
            <option value="high">High</option>
        </select>
    </div>
    <div class="mb-5 w-full">
        <div>
            <div id="activities">
                <div class="activity">
                    <label for="activity_name block mb-2 text-sm font-medium text-gray-900 dark:text-white">Activity Name:</label>
                    <input type="text" id="activity_name" name="activity_name[]"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="activity name..." />
                </div>
            </div>
        </div>
        <button type="button" id="addActivity"
            class="text-white text-xl bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg w-full sm:w-auto px-3 py-1.5 mt-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            +
        </button>
    </div>
    <button type="submit"
        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create!</button>
    @push('scripts')
        @vite(['resources/js/addActivity.js'])
    @endpush
</form>




{{-- $table->id();
$table->string('name');
$table->text('description')->nullable();
$table->unsignedBigInteger('owner_id');
$table->date('start_date')->default(now());
$table->date('end_date')->nullable();
$table->string('client_name')->default('personal');
// si potrebbe creare una tabella clients e associarla tramite id,
// ma diventerebbe piu complesso per gli scopi dell'esercizio
$table->enum('priority', ['low', 'medium', 'high'])->default('medium');
$table->timestamps(); --}}
