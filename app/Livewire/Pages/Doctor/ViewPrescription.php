<?php

namespace App\Livewire\Pages\Doctor;

use App\Models\Doctor;
use App\Models\Drug;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Providers\RouteServiceProvider;

class ViewPrescription extends Component {
    public $prescription_id = '';
    public $doctorName = '';
    public $patientName = '';
    public $previousPage = '';
    public $drugName = '';
    public $drugFormula = '';
    public $created_at = '';

    public function mount($prescription_id = NULL) {
        $this->prescription_id = decrypt($prescription_id);

        $prescription = Prescription::all()->firstWhere('id', '=', $this->prescription_id);
        $this->doctorName = Doctor::all('sin', 'name')->firstWhere('sin', '=', $prescription->doctor)->name;
        $this->patientName = Patient::all('sin', 'name')->firstWhere('sin', '=', $prescription->patient)->name;

        $drug = Drug::all('id', 'tradeName', 'formula')->firstWhere('id', '=', $prescription->drug);
        $this->drugName = $drug->tradeName;
        $this->drugFormula = $drug->formula;

        $this->created_at = $prescription->created_at;
    }

    public function destroy() {
        DB::table('prescriptions')->delete($this->prescription_id);
        $this->redirect(RouteServiceProvider::getRoute('home'));
    }

    public function render()
    {
        return view('livewire.pages.doctor.view-prescription');
    }
}
