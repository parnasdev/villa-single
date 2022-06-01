<?php


namespace Packages\pay\src\Http\Livewire\Home\Dashboard;


use Livewire\WithPagination;

class TransactionPage extends \Livewire\Component
{
    use WithPagination;

    public $paginationTheme = 'new-paginate';


    public function render()
    {
        $transactions = user()->orders()->getRelation('transactions')->paginate(10);
        return view('pay::livewire.home.dashboard.transaction-page' , compact('transactions'));
    }
}
