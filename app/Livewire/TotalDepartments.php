<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Department;

class TotalDepartments extends Component
{
    public $totalDepartments;

    public function mount()
    {
        $this->totalDepartments = Department::count();
    }

    public function render()
    {
        return view('livewire.total-departments');
    }
}
