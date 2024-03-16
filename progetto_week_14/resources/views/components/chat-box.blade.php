<div class="relative flex flex-col text-gray-700 bg-white shadow-md w-full lg:w-96 rounded-xl bg-clip-border">
    <nav class="flex min-w-[240px] flex-col gap-1 p-2 font-sans text-base font-normal text-blue-gray-700">
        @foreach ($users as $user)
            <div role="button"
                class="flex items-center w-full p-3 leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900  hover:bg-slate-300">
                <div class="grid mr-4 place-items-center">
                    <img alt="{{ $user->name }}" src="{{ $user->profile_image }}"
                        class="relative inline-block h-12 w-12 !rounded-full  object-cover object-center" />
                </div>
                <div>
                    <h6
                        class="block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                        {{ $user->name }}
                    </h6>
                    <p class="block font-sans text-sm antialiased font-normal leading-normal text-gray-700">
                        {{ $user->email }}
                    </p>
                </div>
            </div>
        @endforeach
    </nav>
</div>
