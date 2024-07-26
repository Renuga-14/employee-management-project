<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Role;

class TotalRoles extends Component
{
    public $totalRoles;

    public function mount()
    {
        $this->totalRoles = Role::count();
    }

    public function render()
    {
        return view('livewire.total-roles');
    }
}
