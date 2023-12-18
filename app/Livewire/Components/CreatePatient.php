<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Js;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class CreatePatient extends Component {
    #[Rule('required')]
    public $patient_id = '';
    public $user;

    public function save() {
        $this->user = Auth::guard(Session::get('role'))->user();
        $validator = Validator::make($this->all(), $this->getRules(), $this->getMessages(), $this->getValidationAttributes());

        if ($validator->fails()) {
            $this->dispatch('patient-submit-failed');
        }

        $validator->validate();

        if (! DB::table('patient_doctor')->insertOrIgnore([ 'doctor' => $this->user['sin'], 'patient' => $this->patient_id ])) {
            throw ValidationException::withMessages([
                'patient_id' => 'Patient already has a doctor!',
            ]);
        }

        $this->dispatch('patient-submit-success', patient_id: $this->patient_id);
        $this->patient_id = '';
    }

    public function render()
    {
        return view('livewire.components.create-patient');
    }
}
