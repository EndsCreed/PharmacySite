<div>
    <h2 class="headerStyle-text mx-4 mb-4 whitespace-nowrap overflow-hidden">Add New Patient</h2>
    <form wire:submit="save" class="mx-4">
        <label for="company_id" class="input-label whitespace-nowrap overflow-hidden">Company Name</label>
        <input wire:model="company_id" name="company_id" type="text" id="company_id" class="input-text-field">
        <div>
            @error('company_id') <span class="error"> {{ $message }} </span> @enderror
        </div>
        <label for="supervisor_id" class="input-label whitespace-nowrap overflow-hidden">Supervisor ID</label>
        <input wire:model="supervisor_id" name="supervisor_id" type="text" id="supervisor_id" class="input-text-field">
        <div>
            @error('supervisor_id') <span class="error"> {{ $message }} </span> @enderror
        </div>
        <label for="start" class="input-label whitespace-nowrap overflow-hidden">Start Date</label>
        <input wire:model="start" name="start" type="date" id="start" class="input-text-field">
        <div>
            @error('start') <span class="error"> {{ $message }} </span> @enderror
        </div>
        <label for="end" class="input-label whitespace-nowrap overflow-hidden">Expires</label>
        <input wire:model="end" name="end" type="date" id="end" class="input-text-field">
        <div>
            @error('end') <span class="error"> {{ $message }} </span> @enderror
        </div>
        <button type="submit" class="input-text-field hover:text-gray-400 active:bg-gray-900 active:text-white mt-4">Save</button>
    </form>
</div>
