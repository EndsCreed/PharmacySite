<div>
    <h2 class="headerStyle-text mx-4 mb-4 whitespace-nowrap overflow-hidden">Add New Patient</h2>
    <form wire:submit="save" class="mx-4">
        @if ($this->patient_id === null)
            <label for="patient_id" class="input-label whitespace-nowrap overflow-hidden">Patient ID</label>
            <input wire:model="patient_id" name="patient_id" type="text" id="patient_id" class="input-text-field">
            <div>
                @error('patient_id') <span class="error"> {{ $message }} </span> @enderror
            </div>
        @endif

        <label for="drug_id" class="input-label whitespace-nowrap overflow-hidden">Drug ID</label>
        <input wire:model="drug_id" name="drug_id" type="text" id="drug_id" class="input-text-field">
        <div>
            @error('drug_id') <span class="error"> {{ $message }} </span> @enderror
        </div>
        <label for="quantity" class="input-label whitespace-nowrap overflow-hidden">Quantity</label>
        <input wire:model="quantity" name="quantity" type="text" id="quantity" class="input-text-field">
        <div>
            @error('quantity') <span class="error"> {{ $message }} </span> @enderror
        </div>
        <button type="submit" class="input-text-field hover:text-gray-400 active:bg-gray-900 active:text-white mt-4">Save</button>
    </form>
</div>
