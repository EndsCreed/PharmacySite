<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <!-- Identity -->
        <div>
            @if($this->role === 'admin')
                <x-input-label for="sin" :value="__('Email')"/>
            @elseif($this->role === 'pharmacy')
                <x-input-label for="sin" :value="__('Store ID')"/>
            @else
                <x-input-label for="sin" :value="__('Sin')"/>
            @endif

            <x-text-input wire:model="sin" id="sin" class="block mt-1 w-full" type="text" name="sin" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('sin')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mt-4 flex justify-between">
            <div>
                <input wire:model.live="role" value="patient" id="patient" type="radio" checked="checked" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="role">
                <label for="patient" class="me-2 text-sm text-gray-600 dark:text-gray-400">Patient</label>
                <input wire:model.live="role" value="doctor" id="doctor" type="radio" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="role">
                <label for="doctor" class="me-2 text-sm text-gray-600 dark:text-gray-400">Doctor</label>
                <input wire:model.live="role" value="pharmacy" id="pharmacy" type="radio" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="role">
                <label for="pharmacy" class="me-2 text-sm text-gray-600 dark:text-gray-400">Pharmacy</label>
            </div>
        </div>
        <div class="mt-2 flex justify-end">
            <input wire:model.live="role" value="admin" id="admin" type="radio" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="role">
            <label for="admin" class="mx-2 text-sm text-gray-600 dark:text-gray-400">RXAdmin</label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</div>
