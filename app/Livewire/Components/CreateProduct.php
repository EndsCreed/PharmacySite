<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateProduct extends Component
{
    #[Rule('required')]
    public $product_id = '';
    public $user;

    public function save() {
        $this->user = Auth::guard(Session::get('role'))->user();
        $validator = Validator::make($this->all(), $this->getRules(), $this->getMessages(), $this->getValidationAttributes());

        if ($validator->fails()) {
            $this->dispatch('product-submit-failed');
        }

        $validator->validate();

        if (! DB::table('pharmacy_sells')->insertOrIgnore([ 'pharmacy' => $this->user['sin'], 'product' => $this->product_id ])) {
            throw ValidationException::withMessages([
                'product_id' => 'Patient already has a doctor!',
            ]);
        }

        $this->dispatch('product-submit-success', product_id: $this->product_id);
        $this->product_id = '';
    }

    public function render()
    {
        return view('livewire.components.create-product');
    }
}
