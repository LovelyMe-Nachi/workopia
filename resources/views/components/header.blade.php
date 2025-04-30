<!-- Header -->
<header class="bg-blue-900 text-white p-4" x-data="{ open: false }">
    <div class="container mx-auto flex justify-between items-center md:px-8 max-[800px]:px-4">
        <h1 class="text-3xl font-semibold">
            <a href="{{ url('/') }}">Workopia</a>
        </h1>
        <nav class="hidden md:flex items-center space-x-4">

            <x-navlink url="/" :active="request()->is('/')">Home</x-navlink>

            <x-navlink url="/jobs" :active="request()->is('jobs')">All Jobs</x-navlink>

            @auth
                <x-navlink url="/bookmarks" :active="request()->is('bookmarks')">Saved Jobs</x-navlink>

                <x-navlink url="/dashboard" :active="request()->is('dashboard')" icon="gauge">Dashboard</x-navlink>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-white">
                        <i class="fa fa-sign-out"></i> Logout
                    </button>
                </form>

                <!-- User Avatar -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('dashboard.index') }}">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                class="w-10 h-10 rounded-full" /> 
                        @else
                            <img src="{{ asset('storage/avatars/default-avatar.png') }}" alt="{{ Auth::user()->name }}"
                                class="w-10 h-10 rounded-full" />
                        @endif
                    </a>
                </div>
                
                <x-button-link url="/jobs/create" icon="edit">
                    Create Job
                </x-button-link>

            @else

                <x-navlink url="/login" :active="request()->is('login')">Login</x-navlink>

                <x-navlink url="/register" :active="request()->is('register')">Register</x-navlink>

            @endauth

        </nav>
        <button class="text-white md:hidden flex items-center" @click="open = !open">
            <i class="fa fa-bars text-2xl"></i>
        </button>
    </div>
    <!-- Mobile Menu -->
    <nav x-show="open" @click.away="open = false" id="mobile-menu"
        class="md:hidden bg-blue-900 text-white mt-5 pb-4 space-y-2">

        <x-navlink url="/" :active="request()->is('/')">Home</x-navlink>

        <x-nav-link url="/jobs" :active="request()->is('jobs')" :mobile="true">All Jobs</x-nav-link>

        @auth

            <x-nav-link url="/bookmarks" :active="request()->is('bookmarks')" :mobile="true">Saved Jobs</x-nav-link>

            <x-nav-link url="/dashboard" :active="request()->is('dashboard')" :mobile="true">Dashbaord</x-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-white">
                    <i class="fa fa-sign-out"></i> Logout
                </button>
            </form>

            <x-button-link url="/jobs/create" icon="edit">
                Create Job
            </x-button-link>


        @else
            <x-nav-link url="/login" :active="request()->is('login')" :mobile="true">Login</x-nav-link>

            <x-nav-link url="/register" :active="request()->is('register')" :mobile="true">Register</x-nav-link>
        @endauth
    </nav>
</header>