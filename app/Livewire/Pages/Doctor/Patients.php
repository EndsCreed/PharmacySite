<?php

namespace App\Livewire\Pages\Doctor;

use App\Models\Patient;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;

class Patients extends Component {
    use WithPagination;

    #[Url]
    public $search = '';

    public $patient;

    public function getPatient($patientSin) {
        return Patient::all()->firstWhere('sin', '=', $patientSin);
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
        return view('livewire.pages.doctor.patients', [
            'patients' => DB::table('patient_doctor')
                            ->join('patients', 'patient_doctor.patient', '=', 'patients.sin')
                            ->where('doctor', '=', Auth::guard(Session::get('role'))->user()->sin)
                            ->where( function (Builder $query) {
                                $query->where('patients.name', 'like', '%'.$this->search.'%')
                                    ->orWhere('patients.sin', 'like', '%'.$this->search.'%');
                            })->paginate(15)
        ]);
    }
}
