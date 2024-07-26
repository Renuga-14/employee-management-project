@extends('layouts.app')
@section('title', 'Grid Employee')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Employee Grid View</h1>

    <!-- Filter Section -->
    <div class="mb-6">
        <form action="{{ route('employees.grid') }}" method="GET" class="flex flex-col md:flex-row items-center gap-4">
            <div class="w-full md:w-1/3">
                <label for="search" class="block text-gray-700 text-sm font-bold mb-2">Search</label>
                <input type="text" id="search" name="search" value="{{ request()->get('search') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="w-full md:w-1/3">
                <label for="department" class="block text-gray-700 text-sm font-bold mb-2">Department</label>
              
            </div>
            <div class="w-full md:w-1/3">
                <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                <select id="role" name="role" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">All Roles</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ request()->get('role') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Filter</button>
            </div>
        </form>
    </div>

    <!-- Employee Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($employees as $employee)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-4">
                    <h2 class="text-xl font-semibold">{{ $employee->name }}</h2>
                    <p class="text-gray-700">Register Number: {{ $employee->employee_register_number }}</p>
                    <p class="text-gray-700">Email: {{ $employee->email }}</p>
                    <p class="text-gray-700">Contact: {{ $employee->contact_number }}</p>
                    <p class="text-gray-700">Department: {{ $employee->department->name }}</p>
                    <p class="text-gray-700">Role: {{ $employee->role->name }}</p>
                </div>
                <div class="bg-gray-100 p-4 flex justify-between items-center">
                    <a href="{{ route('employees.show', $employee->id) }}" class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600">View</a>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-700">
                No employees found.
            </div>
        @endforelse
    </div>
</div>
@endsection
