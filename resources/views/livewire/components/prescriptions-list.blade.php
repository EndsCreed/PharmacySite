<div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg py-3">
    <h2 class="headerStyle-text mx-4 border-b pb-2 border-gray-600">
        Prescription List
    </h2>
    <div class="mt-4 mb-4">
        {{ $prescriptions->links() }}
    </div>
    @if(!$prescriptions)
        <p class="mx-2 px-2 py-4 text-gray-500">
            No Prescriptions found for {{ $this->patientName }}
        </p>
    @endif
    <ul class="divide-y divide-gray-600">
    @foreach($prescriptions as $prescription)
        <div wire:key="{{ $prescription->id }}" class="mx-2 px-2">
            <?php $this->loadDrugName($prescription->drug); ?>

            <livewire:components.ModelListItem
                :key="$prescription->id"
                :model_id="$prescription->id"
                modelName="prescription"
                :topLeft="$this->patientName"
                :topRight="'Issued: '.$prescription->created_at"
                :bottomLeft="'Drug Name: '.$this->drugName"
                :bottomRight="'QTY: '.$prescription->quantity"
                :useDelete="true"
            />
        </div>
    @endforeach
    </ul>
</div>
