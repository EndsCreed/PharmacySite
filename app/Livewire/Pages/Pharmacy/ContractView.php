<?php

namespace App\Livewire\Pages\Pharmacy;

use App\Models\Company;
use App\Models\Contract;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ContractView extends Component {
    use WithPagination;

    public $contract;
    public $companyName;

    public function mount($contract_id) {
        $this->contract = Contract::all()->firstWhere('id', '=', decrypt($contract_id));
        $this->companyName = $this->contract->company;
    }

    public function render()
    {
        return view('livewire.pages.pharmacy.contract-view', [
            'drugs' => DB::table('contracts AS con')->select(['d.tradeName', 'd.formula', 'd.id'])
                        ->join('company_creates AS cc', 'cc.company', '=', 'con.company')
                        ->join('drugs AS d', 'd.id', '=', 'cc.drug')
                        ->where('con.id', '=', $this->contract->id)->paginate(10)
        ]);
    }
}
