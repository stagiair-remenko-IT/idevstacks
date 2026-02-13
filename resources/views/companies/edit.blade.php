<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-500/20 text-indigo-400 border border-indigo-500/30 shadow-lg">
                <x-icon name="building" class="h-6 w-6" />
            </span>
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight tracking-tight">
                    {{ __('Edit company') }}: {{ $company->name }}
                </h2>
                <p class="mt-1 text-sm text-slate-400">
                    /{{ $company->slug }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-3xl space-y-6">
        <div class="rounded-xl border border-slate-700/80 bg-slate-800/80 shadow-xl overflow-hidden">
            <form method="POST" action="{{ route('companies.update', $company) }}" class="p-6 sm:p-8 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="name" value="{{ __('Company name') }}" class="text-slate-400" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-slate-700/50 border-slate-600 text-white"
                                  :value="old('name', $company->name)" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="email" value="{{ __('Email') }}" class="text-slate-400" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-slate-700/50 border-slate-600 text-white"
                                      :value="old('email', $company->email)" />
                    </div>
                    <div>
                        <x-input-label for="phone" value="{{ __('Phone') }}" class="text-slate-400" />
                        <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full bg-slate-700/50 border-slate-600 text-white"
                                      :value="old('phone', $company->phone)" />
                    </div>
                </div>

                <div>
                    <x-input-label for="address" value="{{ __('Address') }}" class="text-slate-400" />
                    <x-text-input id="address" name="address" type="text" class="mt-1 block w-full bg-slate-700/50 border-slate-600 text-white"
                                  :value="old('address', $company->address)" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <x-input-label for="city" value="{{ __('City') }}" class="text-slate-400" />
                        <x-text-input id="city" name="city" type="text" class="mt-1 block w-full bg-slate-700/50 border-slate-600 text-white"
                                      :value="old('city', $company->city)" />
                    </div>
                    <div>
                        <x-input-label for="state" value="{{ __('State / Province') }}" class="text-slate-400" />
                        <x-text-input id="state" name="state" type="text" class="mt-1 block w-full bg-slate-700/50 border-slate-600 text-white"
                                      :value="old('state', $company->state)" />
                    </div>
                    <div>
                        <x-input-label for="postal_code" value="{{ __('Postal code') }}" class="text-slate-400" />
                        <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full bg-slate-700/50 border-slate-600 text-white"
                                      :value="old('postal_code', $company->postal_code)" />
                    </div>
                </div>

                <div>
                    <x-input-label for="website" value="{{ __('Website') }}" class="text-slate-400" />
                    <x-text-input id="website" name="website" type="url" class="mt-1 block w-full bg-slate-700/50 border-slate-600 text-white"
                                  :value="old('website', $company->website)" placeholder="https://" />
                </div>

                <div>
                    <x-input-label for="notes" value="{{ __('Notes') }}" class="text-slate-400" />
                    <textarea id="notes" name="notes" rows="4"
                              class="mt-1 block w-full rounded-lg bg-slate-700/50 border-slate-600 text-white placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes', $company->notes) }}</textarea>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4">
                    <a href="{{ route('companies.show', $company) }}" class="text-sm text-slate-400 hover:text-white transition">
                        {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-500 transition">
                        {{ __('Save changes') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
