<div x-data="{ open: false }" class="lg:hidden">
    <button @click="open = true" class="fixed bottom-4 right-4 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-indigo-600 text-white shadow-lg hover:bg-indigo-500 transition">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
    <div x-show="open" x-cloak
         class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm"
         @click="open = false">
        <div @click.stop
             class="fixed left-0 top-0 h-full w-72 bg-slate-800 shadow-xl border-r border-slate-700">
            <div class="flex h-14 items-center justify-between border-b border-slate-700 px-4">
                <span class="font-bold text-lg text-white">IDEVSTACKS</span>
                <button @click="open = false" class="p-2 text-slate-400 hover:text-white">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <nav class="space-y-1 p-4">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-slate-300 hover:bg-slate-700/50 hover:text-white">
                    <x-icon name="dashboard" class="h-5 w-5" />
                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('companies.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-slate-300 hover:bg-slate-700/50 hover:text-white">
                    <x-icon name="building" class="h-5 w-5" />
                    {{ __('Companies') }}
                </a>
                <a href="{{ route('documents.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-slate-300 hover:bg-slate-700/50 hover:text-white">
                    <x-icon name="document" class="h-5 w-5" />
                    {{ __('Documentation') }}
                </a>
                @if(Auth::user()?->isGlobalAdmin())
                    <a href="{{ route('categories.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-slate-300 hover:bg-slate-700/50 hover:text-white">
                        <x-icon name="category" class="h-5 w-5" />
                        {{ __('Categories') }}
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-slate-300 hover:bg-slate-700/50 hover:text-white">
                        <x-icon name="users" class="h-5 w-5" />
                        {{ __('Users') }}
                    </a>
                @endif
            </nav>
        </div>
    </div>
</div>
