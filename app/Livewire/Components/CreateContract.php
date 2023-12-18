<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateContract extends Component
{
    #[Rule('required|string')]
    public $company_id = '';
    #[Rule('required|integer')]
    public $supervisor_id = '';
    #[Rule('required|string')]
    public $start = '';
    #[Rule('required|string')]
    public $end = '';
    public $user;

    public function save() {
        $this->user = Auth::guard(Session::get('role'))->user();
        $validator = Validator::make($this->all(), $this->getRules(), $this->getMessages(), $this->getValidationAttributes());

        if ($validator->fails()) {
            $this->dispatch('contract-submit-failed');
        }

        $validator->validate();

        if (! DB::table('contracts')->insertOrIgnore([ 'pharmacy' => $this->user['id'],
                                                            'company' => $this->company_id,
                                                            'supervisorID' => $this->supervisor_id,
                                                            'issued' => $this->start,
                                                            'expires' => $this->end,
                                                            'created_at' => now()])) {
            $this->dispatch('contract-submit-failed');
        }

        $this->dispatch('contract-submit-success');
        $this->company_id = '';
        $this->supervisor_id = '';
        $this->start = '';
        $this->end = '';
    }

    public function render()
    {
        return view('livewire.components.create-contract');
    }
}
