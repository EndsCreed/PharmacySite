<div>
    <h2 class="headerStyle-text mx-4 mb-4 whitespace-nowrap overflow-hidden">Add New Patient</h2>
    <form wire:submit="save" class="mx-4">
        <label for="patient_id" class="input-label whitespace-nowrap overflow-hidden">Patient SIN</label>
        <input wire:model="patient_id" name="patient_id" type="text" id="patient_id" class="input-text-field">
        <div>
            @error('patient_id') <span class="error"> {{ $message }} </span> @enderror
        </div>
        <button type="submit" class="input-text-field hover:text-gray-400 active:bg-gray-900 active:text-white mt-4">Save</button>
    </form>
</div>
