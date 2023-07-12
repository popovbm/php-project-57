<header class="w-full">
    <nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900 shadow-md">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">

            <a href="/" class="flex items-center">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{ __('layout.name') }}</span>
            </a>

            <div class="flex items-center justify-between">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="{{ route('tasks.index') }}" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                            {{ __('layout.nav.tasks') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('task_statuses.index') }}" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                            {{ __('layout.nav.task_statuses') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('labels.index') }}" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                            {{ __('layout.nav.labels') }}
                        </a>
                    </li>
                </ul>
            </div>

            <div class="flex items-center">
                <div class="mr-5">
                    {{ language()->flags() }}
                </div>
                @if (Route::has('login'))
                @auth
                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{ route('logout') }}" data-method="post" rel="nofollow">{{ __('layout.nav.logout') }}</a>
                @else
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('layout.nav.login') }}</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">{{ __('layout.nav.registration') }}</a>
                @endif
                @endauth
                @endif
            </div>

        </div>
    </nav>
</header>
