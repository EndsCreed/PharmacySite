<?php

namespace App\Livewire\Pages\Doctor;

use App\Models\Drug;
use App\Models\Patient;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Prescriptions extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';

    public $prescription;

    public $patients;

    public $drugs;

    public function getPatient($patientSin) {
        if ($this->patients) {
            return $this->patients->firstWhere('sin', '=', $patientSin);
        }
        $this->patients = Patient::all();
        return $this->patients->firstWhere('sin', '=', $patientSin);
    }

    public function getDrug($drugId) {
        if ($this->drugs) {
            return $this->drugs->firstWhere('id', '=', $drugId);
        }
        $this->drugs = Drug::all();
        return $this->drugs->firstWhere('id', '=', $drugId);
    }

    public function destroy($patient_id) {
        DB::table('patient_doctor')->where('patient', '=', $patient_id)->delete();
        $this->failToast('Patient Removed');
        $this->resetPage();
    }

    public function updated($property) {
        if ($property === 'search') {
            $this->resetPage();
        }
    }

    #[On('patient-submit-success')]
    public function submitSuccess() {
        $this->resetPage();
        $this->successToast('Patient Added!');
    }

    #[On('patient-submit-failed')]
    public function submitFail() {
        $this->failToast('Submit Failed!');
    }

    public function render()
    {
        return view('livewire.pages.doctor.prescriptions', [
            'prescriptions' => DB::table('prescriptions AS psc')
                ->join('patients AS p', 'psc.patient', '=', 'p.sin')
                ->where('doctor', '=', Auth::guard(Session::get('role'))->user()->sin)
                ->where( function (Builder $query) {
                    $query->where('patients.name', 'like', '%'.$this->search.'%')
                        ->orWhere('patients.sin', 'like', '%'.$this->search.'%');
                })->paginate(15)
        ]);
    }
}

