<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Employee;

class TotalEmployees extends Component
{
    public $totalEmployees;

    public function mount()
    {
        $this->totalEmployees = Employee::count();
    }

    public function render()
    {
        return view('livewire.total-employees');
    }
}
