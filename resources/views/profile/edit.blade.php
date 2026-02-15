<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <span class="flex h-12 w-12 shrink-0 items-center justify-center glass-icon bg-indigo-500/20 text-indigo-400 border-indigo-500/40">
                <x-icon name="user" class="h-6 w-6" />
            </span>
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight tracking-tight">
                    {{ __('Profile') }}
                </h2>
                <p class="mt-1 text-sm text-slate-400">
                    {{ __('Manage your account settings') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-3xl space-y-6">
        <div class="glass-card overflow-hidden">
                <div class="p-6 sm:p-8">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

        <div class="glass-card overflow-hidden">
            <div class="p-6 sm:p-8">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="glass-card overflow-hidden">
            <div class="p-6 sm:p-8">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
