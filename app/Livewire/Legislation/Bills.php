<?php

namespace App\Livewire\Legislation;

use Livewire\Component;
use App\Models\Legislation\Bill;
use App\Models\Legislation\BillType;
use App\Models\DecisionMakers;
use Livewire\WithPagination;

class Bills extends Component
{
    use WithPagination;
    public function render()
    {
        $bills = Bill::with(['billType', 'sponsors', 'sponsors.political_parties'])
            ->orderBy('lastUpdate', 'desc')
            ->paginate(25);

        return view('livewire.legislation.bills', compact('bills'))->layout('layouts.app');
    }
}
