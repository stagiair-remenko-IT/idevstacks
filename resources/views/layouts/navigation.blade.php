<nav x-data="{ open: false }" class="bg-slate-800 border-b border-slate-700/80 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14">
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 no-underline text-white hover:text-slate-200 transition-colors">
                    <span class="font-bold text-lg tracking-tight text-white">IDEVSTACKS</span>
                    <span class="hidden sm:inline text-xs font-medium text-slate-400 uppercase tracking-wider">{{ __('IT Docs') }}</span>
                </a>

                <div class="hidden space-x-0.5 sm:-my-px sm:ml-8 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <span class="inline-flex items-center gap-2">
                            <x-icon name="dashboard" class="h-4 w-4 shrink-0" />
                            {{ __('Dashboard') }}
                        </span>
                    </x-nav-link>
                    <x-nav-link :href="route('documents.index')" :active="request()->routeIs('documents.*')">
                        <span class="inline-flex items-center gap-2">
                            <x-icon name="document" class="h-4 w-4 shrink-0" />
                            {{ __('Documentation') }}
                        </span>
                    </x-nav-link>
                    @if(Auth::user()?->isGlobalAdmin())
                        <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                            <span class="inline-flex items-center gap-2">
                                <x-icon name="category" class="h-4 w-4 shrink-0" />
                                {{ __('Categories & Fields') }}
                            </span>
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-3">
                @if(Auth::user()?->isGlobalAdmin())
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-300 hover:text-white font-medium px-3 py-2 rounded-md hover:bg-slate-700/50 transition">
                        <x-icon name="users" class="h-4 w-4 shrink-0" />
                        {{ __('Users') }}
                    </a>
                @endif

                <x-dropdown align="right" width="48" contentClasses="py-1 bg-slate-800 border border-slate-700 shadow-xl">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium rounded-md text-slate-200 bg-slate-700/50 hover:bg-slate-700 hover:text-white border border-slate-600/50 focus:outline-none transition">
                            <span class="flex items-center justify-center w-7 h-7 rounded-md bg-indigo-500/80 text-white text-xs font-semibold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            <span>
                                {{ Auth::user()->name }}
                                <span class="ml-1 text-xs text-slate-400 block leading-tight">
                                    {{ Auth::user()->isGlobalAdmin() ? __('Global Admin') : __('IT Worker') }}
                                </span>
                            </span>
                            <x-icon name="chevron-right" class="h-4 w-4 shrink-0 rotate-[-90deg] text-slate-400" />
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-slate-200 hover:bg-slate-700 hover:text-white">
                            <span class="inline-flex items-center gap-2">
                                <x-icon name="cog" class="h-4 w-4 shrink-0" />
                                {{ __('Profile') }}
                            </span>
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" class="text-slate-200 hover:bg-slate-700 hover:text-white border-t border-slate-700"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-white hover:bg-slate-700 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-slate-800 border-t border-slate-700">
        <div class="pt-2 pb-3 space-y-0.5">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <span class="inline-flex items-center gap-2">
                    <x-icon name="dashboard" class="h-4 w-4 shrink-0" />
                    {{ __('Dashboard') }}
                </span>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('documents.index')" :active="request()->routeIs('documents.*')">
                <span class="inline-flex items-center gap-2">
                    <x-icon name="document" class="h-4 w-4 shrink-0" />
                    {{ __('Documentation') }}
                </span>
            </x-responsive-nav-link>
            @if(Auth::user()?->isGlobalAdmin())
                <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                    <span class="inline-flex items-center gap-2">
                        <x-icon name="category" class="h-4 w-4 shrink-0" />
                        {{ __('Categories & Fields') }}
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                    <span class="inline-flex items-center gap-2">
                        <x-icon name="users" class="h-4 w-4 shrink-0" />
                        {{ __('Users') }}
                    </span>
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-3 border-t border-slate-700">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-slate-400">{{ Auth::user()->email }}</div>
                <div class="font-medium text-xs text-slate-500">
                    {{ Auth::user()->isGlobalAdmin() ? __('Global Admin') : __('IT Worker') }}
                </div>
            </div>
            <div class="mt-3 space-y-0.5">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
