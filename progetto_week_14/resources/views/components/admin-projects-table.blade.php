<div class="admin-projects-table m-10 p-8 bg-slate-200">
    
    <div class="flex flex-col md:flex-row items-center justify-between pb-6">
        <div>
            <span class="text-4xl pb-4 mb-2">Projects</span>
            <a type="button" href="{{route("projects.create")}}" class="bg-green-700 ms-5 py-2 px-3 mb-5 rounded-lg text-lg text-slate-200 hover:bg-green-400 hover:text-slate-700">NEW</a>
        </div>
        <div class="flex items-center justify-between ">
            <form class="flex items-center p-2 rounded-md bg-slate-200">

                <input class="bg-gray-50 outline-none ml-1 block " type="text" name="" id=""
                    placeholder="search project...">
                <button type="submit" class="ms-3 bg-slate-300 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                        fill="grey">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </form>

        </div>
    </div>
    
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-base">
                    <th scope="col" class="px-6 py-3">
                        Project Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Project Owner
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Start Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Deadline
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Client
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Priority
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Activities
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Workers
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 text-base">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                           <a  href="{{ route('projects.show', ['project' => $project->id]) }}"> {{ $project->name }}</a>
                        </th>
                        <td class="px-6 py-4 text-base ">
                            {{ $project->owner->name }}
                        </td>
                        <td class="px-6 py-4 text-base">
                            {{ $project->start_date }}
                        </td>
                        <td class="px-6 py-4 text-base">
                            {{ $project->end_date }}
                        </td>
                        <td class="px-6 py-4 text-base">
                            {{ $project->client_name }}
                        </td>

                        <td class="px-6 py-4 text-zinc-900 ttext-base">
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

                            {{ strtoupper($project->priority) }}
                        </td>
                        <td class="px-6 py-4 text-base">
                            {{ $project->activities->count() }}
                        </td>
                        <td class="px-6 py-4 text-base">
                            @php
                                $count = 0;
                                foreach ($project->activities as $activity) {
                                    $count += $activity->users->count();
                                }
                                echo $count;
                            @endphp
                        </td>

                        <td class="px-6 py-4 text-right text-base">
                            <a href="#"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
