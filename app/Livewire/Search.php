<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\Invoice;
class Search extends Component
{
    public $search = '';
    public function render()
    {
        $transactions=[];
        $invoices=[];

        if($this->search){
            $transactions = Transaction::where('title','like','%'. $this->search.'%')->orWhere('description', 'like', '%' . $this->search . '%')->take(4)->get();

            $invoices = Invoice::where('number', 'like', '%' . $this->search . '%')
                ->take(4)->get();

        }

        return view('livewire.search', [
            'transactions'=> $transactions,
            'invoices'=> $invoices,
        ]);

    }
}
