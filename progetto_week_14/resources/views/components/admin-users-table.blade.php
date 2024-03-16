<div class="admin-projects-table m-10 p-8 bg-slate-200">
    <div class=" flex flex-col md:flex-row  items-center justify-between pb-6">
        <div class="flex">
            <span class="text-4xl pb-4 mb-2">Users</span>
            <a type="button" href="#"
                class="bg-green-700 ms-5 py-2 px-3 mb-5 rounded-lg text-lg text-slate-200 hover:bg-green-400 hover:text-slate-700">NEW</a>
        </div>
        <div class="flex items-center justify-between ">
            <form class="flex items-center p-2 rounded-md bg-slate-200">

                <input class="bg-gray-50 outline-none ml-1 block " type="text" name="" id=""
                    placeholder="search user...">
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
    <div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead class="text-base  text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="text-base text-left">
                            <th scope="col" class="px-6 py-3">
                                User
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Role
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Phone
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Activities
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Projects
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Owned
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-base">
                                    <a href="#">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-14 h-14">
                                                <img class="w-full h-full rounded-full" src="{{ $user->profile_image }}"
                                                    alt="{{ $user->name }}" />
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $user->name }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-base">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ ucfirst($user->role) }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-base">
                                    <a href="mailto:{{ $user->email }}">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $user->email }}
                                        </p>
                                    </a>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-base">
                                    <a href="tel:{{ $user->phone_number }}">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $user->phone_number }}
                                        </p>
                                    </a>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-base">
                                    @php
                                        $activities = $user->activities->count();
                                    @endphp
                                    <div class="activities-number">
                                        <x-activities-admin-user-table :activities="$activities" />
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-lg">
                                    @php
                                        $allProjects = [];
                                        foreach ($user->activities as $activity) {
                                            $allProjects[] = $activity->project_id;
                                        }
                                        $projects = count(array_unique($allProjects));

                                    @endphp
                                    <div class="projects-number ">
                                        <x-projects-admin-user-table :projects="$projects" />
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-lg">
                                    @php
                                        $ownerCounter = $user->projects->count();
                                    @endphp
                                    <div class="owned-number ">
                                        <x-owned-admin-user-table :ownerCounter="$ownerCounter" />
                                    </div>

                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-base">
                                    <a href="#"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
