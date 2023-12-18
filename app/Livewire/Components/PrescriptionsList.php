<?php

namespace App\Livewire\Components;

use App\Models\Drug;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class PrescriptionsList extends Component {
    use WithPagination;

    public $dSin;
    public $pSin;
    public $patientName;
    public $drugName;

    public function mount($dSin = null, $pSin = null) {
        $this->pSin = $pSin;
        $this->dSin = $dSin;
        $this->loadPatientName($pSin);
    }
    public function loadPatientName($patientId): void {
        $this->patientName = Patient::all()->firstWhere('sin', '=', $patientId)->name;
    }

    public function loadDrugName($drugId): void {
        $this->drugName = Drug::all()->firstWhere('id', '=', $drugId)->tradeName;
    }

    public function destroy($prescription_id) {
        Prescription::destroy($prescription_id);
        $this->dispatch('prescription-delete-success');
        $this->resetPage();
    }

    public function render() {
        return view('livewire.components.prescriptions-list', [
            'prescriptions' => DB::table('prescriptions')
                                ->where('doctor', '=', $this->dSin)
                                ->paginate(5)
        ]);
    }
}
