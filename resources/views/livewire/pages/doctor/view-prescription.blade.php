<div class="text-white mx-6">
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                {{ __('Prescription Information') }}
            </h2>
        </div>
    </x-slot>
    <!-- Content -->
    <div class="contentStyle">

        <x-model-field label="Doctor Name">
            {{ $this->doctorName }}
        </x-model-field>

        <x-model-field label="Patient Name">
            {{ $this->patientName }}
        </x-model-field>

        <x-model-field label="Drug Name">
            {{ $this->drugName }}
        </x-model-field>

        <x-model-field label="Drug Formula">
            {{ $this->drugFormula }}
        </x-model-field>

        <x-model-field label="Issued">
            {{ $this->created_at }}
        </x-model-field>
        <div class="flex justify-end">
            <button wire:click="destroy" class="headerStyle-link mx-4 px-2 hover:border-red-600 text-white hover:text-red-500">
                Remove Prescription
            </button>
        </div>

    </div>
</div>
