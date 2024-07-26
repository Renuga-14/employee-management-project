@extends('layouts.app')
@section('title', 'Display Employee Details')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Employee Details</h1>
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Employee Register Number:</label>
            <p>{{ $employee->employee_register_number }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
            <p>{{ $employee->name }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Contact Number:</label>
            <p>{{ $employee->contact_number }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
            <p>{{ $employee->email }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Date of Birth:</label>
            <p>{{ $employee->date_of_birth }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Address:</label>
            <p>{{ $employee->address }}</p>
        </div>
      
    </div>
    <div class="flex items-center justify-between">
        <a href="{{ route('employees.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Back to List</a>
    </div>
</div>
@endsection
