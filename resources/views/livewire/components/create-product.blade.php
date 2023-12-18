<div>
    <h2 class="headerStyle-text mx-4 mb-4 whitespace-nowrap overflow-hidden">Edit Price</h2>
    <form wire:submit="save" class="mx-4">
        <label for="product_id" class="input-label whitespace-nowrap overflow-hidden">Product ID</label>
        <input wire:model="product_id" name="product_id" type="text" id="product_id" class="input-text-field">
        <div>
            @error('product_id') <span class="error"> {{ $message }} </span> @enderror
        </div>
        <button type="submit" class="input-text-field hover:text-gray-400 active:bg-gray-900 active:text-white mt-4">Save</button>
    </form>
</div>
