<?php

namespace App\Livewire\Pages\Pharmacy;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Contracts extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';

    public function destroy($company_id) {
        $pharmacy_id = Auth::guard(Session::get('role'))->user()->id;
        DB::table('contracts')->where('id', '=', $company_id)
            ->where('pharmacy', '=', $pharmacy_id)->delete();
        $this->failToast('Contract Removed');
        $this->resetPage();
    }

    public function updated($property) {
        if ($property === 'search') {
            $this->resetPage();
        }
    }

    #[On('contract-submit-success')]
    public function submitSuccess() {
        $this->resetPage();
        $this->successToast('Contract Added!');
    }

    #[On('contract-submit-failed')]
    public function submitFail() {
        $this->failToast('Submit Failed!');
    }

    public function render()
    {
        return view('livewire.pages.pharmacy.contracts', [
            'contracts' => DB::table('contracts')->select(['contracts.*','pharmacies.id AS pID'])
                ->join('pharmacies', 'pharmacies.id', '=', 'contracts.pharmacy')
                ->where('contracts.pharmacy', '=', Auth::guard(Session::get('role'))->user()->id)
                ->where( function (Builder $query) {
                    $query->where('contracts.company', 'like', '%'.$this->search.'%')
                        ->orWhere('contracts.issued', 'like', '%'.$this->search.'%');
                })->paginate(15)
        ]);
    }
}
