<nav x-data="{ mobileMenuOpen: false, userMenuOpen: false }" class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <div class="flex flex-shrink-0 items-center">
                    <a href="/">
                        <h2 class="font-bold text-2xl">Barta</h2>
                    </a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="#"
                        class="inline-flex items-center border-b-2 px-1 pt-1 text-sm hover:border-gray-300 hover:text-gray-800
                        @if(Route::is('home'))
                            font-semibold text-gray-900 border-gray-800
                        @else
                            border-transparent font-medium text-gray-600
                        @endif
                        ">
                        Discover
                    </a>
                    <a href="#"
                        class="inline-flex items-center border-b-2 px-1 pt-1 text-sm hover:border-gray-300 hover:text-gray-800
                        @if(Route::is('profile'))
                            font-semibold text-gray-900 border-gray-800
                        @else
                            border-transparent font-medium text-gray-600
                        @endif
                        ">
                        For you
                    </a>
                    <a href="{{ route('user.index') }}"
                        class="inline-flex items-center border-b-2 px-1 pt-1 text-sm hover:border-gray-300 hover:text-gray-800
                        @if(Route::is('user.index', 'user.public.profile'))
                            font-semibold text-gray-900 border-gray-800
                        @else
                            border-transparent font-medium text-gray-600
                        @endif
                        ">
                        People
                    </a>
                </div>
            </div>
            <div class="hidden sm:ml-6 sm:flex gap-2 sm:items-center">
                <!-- Create Post Button (Hidden on Mobile) -->
                @if(Route::is('home') )
                    <button type="button" onclick="showPostForm()"
                        class="text-gray-900 hover:text-white border-2 border-gray-800 hover:bg-gray-900 focus:ring-2 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center hidden md:block">
                        Create Post
                    </button>
                @else
                    <a href="{{ route('post.create') }}" class="text-gray-900 hover:text-white border-2 border-gray-800 hover:bg-gray-900 focus:ring-2 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center hidden md:block">
                        Create Post
                    </a>
                @endif

                <!-- Notification Button -->
                <button type="button"
                    class="rounded-full bg-white p-2 text-gray-800 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    <span class="sr-only">View notifications</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                </button>

                <!-- Messages Button -->
                <button type="button"
                    class="rounded-full bg-white p-2 text-gray-800 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    <span class="sr-only">Messages</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0="
                            12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                    </svg>
                </button>

                <!-- Profile Dropdown (Authenticated Users Only) -->
                @auth
                    <div class="relative ml-3" x-data="{ open: false }">
                        <div>
                            <button @click="open = !open" type="button"
                                class="flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 object-cover aspect-square rounded-full" src="{{ asset("storage/".auth()->user()->pro_pic) }}"
                                    alt="{{ auth()->user()->name }}" />
                            </button>
                        </div>

                        <!-- Dropdown menu for authenticated users -->
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                role="menuitem" tabindex="-1">
                                Your Profile
                            </a>
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                tabindex="-1">
                                Edit Profile
                            </a>
                            <form class="block w-full" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem" tabindex="-1">
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Guest Links (Login/Signup) -->
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="ml-4 text-gray-700 hover:text-gray-900">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg x-show="!mobileMenuOpen" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>

                    <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" class="sm:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pt-2 pb-3">

            <a 
                @if(Route::is('home') )
                    href="#"  
                    onclick="showPostForm()" @click="mobileMenuOpen = !mobileMenuOpen"
                @else
                    href="{{ route('post.create') }}"  
                @endif

                class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100">
                Create Post
            </a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100">
                Discover
            </a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100">For you</a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100">People</a>
            @auth
                <a href="{{ route('profile') }}"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100">Your
                    Profile</a>
                <a href="{{ route('profile.edit') }}"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100">Edit
                    Profile</a>
                <form class="block w-full" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button
                        class="block w-full text-left rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100">
                        Sign out
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100">Login</a>
                <a href="{{ route('register') }}"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100">Register</a>
            @endauth
        </div>
    </div>
</nav>
