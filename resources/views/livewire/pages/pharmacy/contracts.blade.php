<div>
    <x-slot name="header">
        <div class="flex justify-between" x-data="{ open: false, toggle() { this.open = !this.open } }">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                {{ __('Contracts') }}
            </h2>
            <x-dropdown>
                <x-slot name="trigger">
                    <button class="headerStyle-link text-white">Create Contract</button>
                </x-slot>
                <x-slot name="content" class="contentStyle">
                    <livewire:components.create-contract class="items-center"/>
                </x-slot>
            </x-dropdown>
            {{--            <div class="relative">--}}
            {{--                <div x-cloak--}}
            {{--                     x-show="open"--}}
            {{--                     x-on:patient-submit-success.window="open = false"--}}
            {{--                     x-transition.opacity>--}}
            {{--                    <dialog class="contentStyle absolute z-50 origin-top border-2 border-gray-950 float-left">--}}
            {{--                        <livewire:components.create-patient class="items-center"/>--}}
            {{--                    </dialog>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--            <button x-on:click="toggle()" class="headerStyle-link">Add Patient</button>--}}
        </div>
    </x-slot>
    <!-- Regular slot -->
    <div class="sm:py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-rows-2 items-end">
                <label for="search" class="input-label">Search</label>
                <div class="flex">
                    <input type="text" id="search" wire:model.live.debounce.300ms="search" class="input-text-field lg:basis-1/3 md:basis-1/2 sm:basis-2/3" placeholder="Company Name or Contracted Date">
                </div>
            </div>
            <div class="mt-4 mb-4">
                {{ $contracts->links() }}
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <ul class="p-2 divide-y divide-gray-600 rounded-none">
                        @foreach($contracts->all() as $contract)
                            <div wire:key="{{ $contract->id }}">
                                <livewire:components.ModelListItem
                                    :key="$contract->id"
                                    :model_id="$contract->id"
                                    modelName="contract"
                                    :topLeft="$contract->company"
                                    :bottomLeft="$contract->supervisorID"
                                    :topRight="$contract->issued"
                                    :bottomRight="$contract->expires"
                                    :useDelete="true"
                                />
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="mt-4">
                {{ $contracts->links() }}
            </div>
        </div>
    </div>
</div>
