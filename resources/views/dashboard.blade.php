@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold">Total Employees</h2>
        <livewire:total-employees />
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold">Total Departments</h2>
        <livewire:total-departments />
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold">Total Roles</h2>
        <livewire:total-roles />
    </div>
</div>
@endsection
