<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreatePrescription extends Component
{
    #[Rule('required|integer')]
    public $patient_id = '';
    #[Rule('required|integer')]
    public $drug_id = '';
    #[Rule('required|integer')]
    public $quantity;

    public $user;

    public function mount($patient_id = null) {
        $this->patient_id = $patient_id;
    }

    public function save() {
        $this->user = Auth::guard(Session::get('role'))->user();
        $validator = Validator::make($this->all(), $this->getRules(), $this->getMessages(), $this->getValidationAttributes());

        if ($validator->fails()) {
            $this->dispatch('prescription-submit-failed');
        }

        $validator->validate();

        if (! DB::table('prescriptions')->insertOrIgnore([ 'doctor' => $this->user['sin'], 'patient' => $this->patient_id, 'drug' => $this->drug_id, 'quantity' => $this->quantity ])) {
            $this->dispatch('prescription-submit-failed');
        }

        $this->dispatch('prescription-submit-success');
        $this->drug_id = '';
        $this->quantity = '';
    }

    public function render()
    {
        return view('livewire.components.create-prescription');
    }
}
