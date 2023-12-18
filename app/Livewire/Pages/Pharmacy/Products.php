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

class Products extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';

    public function destroy($product_id) {
        $pharmacy_id = Auth::guard(Session::get('role'))->user()->id;
        DB::table('pharmacy_sells')->where('drug', '=', $product_id)
            ->where('pharmacy', '=', $pharmacy_id)->delete();
        $this->failToast('Product Removed');
        $this->resetPage();
    }

    public function updated($property) {
        if ($property === 'search') {
            $this->resetPage();
        }
    }

    #[On('product-submit-success')]
    public function submitSuccess() {
        $this->resetPage();
        $this->successToast('Price Added!');
    }

    #[On('product-submit-failed')]
    public function submitFail() {
        $this->failToast('Submit Failed!');
    }

    public function render()
    {
        return view('livewire.pages.pharmacy.products', [
            'products' => DB::table('pharmacy_sells AS ps')->select(['d.*','ps.price'])
                ->join('contracts AS c', 'c.pharmacy', '=', 'ps.pharmacy')
                ->join('company_creates AS cc', 'cc.company', '=', 'c.company')
                ->join('drugs AS d', 'd.id', '=', 'cc.drug')
                ->where('c.pharmacy', '=', Auth::guard(Session::get('role'))->user()->id)
                ->where( function (Builder $query) {
                    $query->where('d.tradeName', 'like', '%'.$this->search.'%')
                        ->orWhere('d.formula', 'like', '%'.$this->search.'%');})
                ->orderBy('ps.price', 'desc')
                ->paginate(15)
        ]);
    }
}
