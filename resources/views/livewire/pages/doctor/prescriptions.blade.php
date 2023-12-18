<div>
    <x-slot name="header">
        <div class="flex justify-between" x-data="{ open: false, toggle() { this.open = !this.open } }">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                {{ __('Your Prescriptions') }}
            </h2>
            <x-dropdown>
                <x-slot name="trigger">
                    <button class="headerStyle-link text-white">Create Prescription</button>
                </x-slot>
                <x-slot name="content" class="contentStyle">
                    <livewire:components.create-prescription class="items-center" />
                </x-slot>
            </x-dropdown>
{{--            <a href="{{ RouteServiceProvider::getRoute('prescription.create', ['patient_id' => $this->patient_id]) }}" class="headerStyle-link">--}}
{{--                {{ __('Create a Prescription') }}--}}
{{--            </a>--}}
        </div>
    </x-slot>
    <!-- Regular slot -->
    <div class="sm:py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-rows-2 items-end">
                <label for="search" class="input-label">Search</label>
                <div class="flex">
                    <input type="text" id="search" wire:model.live.debounce.300ms="search" class="input-text-field lg:basis-1/3 md:basis-1/2 sm:basis-2/3" placeholder="Enter Name or SIN">
                </div>
            </div>
            <div class="mt-4 mb-4">
                {{ $prescriptions->links() }}
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <ul class="p-2 divide-y divide-gray-600 rounded-none">
                        @foreach($prescriptions->all() as $p)
                            <div wire:key="{{ $p->id }}">
                                    <?php $this->prescription = $p ?>
                                <livewire:components.ModelListItem
                                    :key="$this->prescription->id"
                                    :model_id="$this->prescription->id"
                                    modelName="prescription"
                                    :topLeft="$this->getPatient($this->prescription->patient)->name"
                                    :bottomLeft="$this->getPatient($this->prescription->patient)->address"
                                    :useDelete="true"
                                />
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="mt-4">
                {{ $prescriptions->links() }}
            </div>
        </div>
    </div>
</div>
