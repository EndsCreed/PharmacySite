<?php

namespace App\Livewire\Pages\Doctor;

use App\Models\Patient;
use App\Models\Prescription;
use Livewire\Attributes\On;
use Livewire\Component;

class PatientView extends Component {

    public String $patient_id;
    public int $key = 1;

    #[Computed]
    public $patient;

    public function mount($patient_id = NULL) {
        $this->patient = Patient::all()->firstWhere('sin', '=', decrypt($patient_id));
        $this->key++;
    }

    #[On('prescription-submit-success')]
    public function submitSuccess() {
        $this->key++; // Changes the key on the child component to force a refresh of just the child component
        $this->successToast('Prescription Added!');
    }

    #[On('prescription-delete-success')]
    public function deleteSuccess() {
        $this->key++; // Changes the key on the child component to force a refresh of just the child component
        $this->failToast('Prescription Removed'); // Doesn't actually fail. Just want red.
    }

    public function render()
    {
        return view('livewire.pages.doctor.patient-view');
    }
}
