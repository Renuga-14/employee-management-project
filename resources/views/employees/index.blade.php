@extends('layouts.app')

@section('title', 'Employee List')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-3xl font-bold mb-6 text-black-800">Employee List</h1>
    
    <div class="mb-4 flex justify-between items-center">
        <a href="{{ route('employees.export') }}" class="bg-green-600 text-black px-4 py-2 rounded-lg shadow hover:bg-green-700 transition duration-300">Export Employees to PDF</a>
        
        <!-- Display success message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-black-700 px-4 py-2 rounded-lg shadow mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        <a href="{{ route('employees.create') }}" class="bg-blue-600 text-black px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition duration-300">Add New Employee</a>
    </div>
    
    <form action="{{ route('employees.index') }}" method="GET" class="mb-6 bg-gray-50 p-4 rounded-lg shadow-md">
        <div class="flex flex-wrap gap-4">
            <div class="flex-1">
                <label for="name" class="block text-black-700 font-semibold mb-1">Name</label>
                <input type="text" id="name" name="name" value="{{ request('name') }}" class="form-input mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
            </div>
            
            <div class="flex-1">
                <label for="email" class="block text-black-700 font-semibold mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ request('email') }}" class="form-input mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
            </div>
            
            <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition duration-300">Filter</button>
        </div>
    </form>
    
    <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden shadow-md">
        <thead class="bg-gray-100">
            <tr class="text-left text-gray-600">
                <th class="px-6 py-3 border-b">Employee Register Number</th>
                <th class="px-6 py-3 border-b">Name</th>
                <th class="px-6 py-3 border-b">Contact Number</th>
                <th class="px-6 py-3 border-b">Email</th>
                <th class="px-6 py-3 border-b">Date of Birth</th>
                <th class="px-6 py-3 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $employee->employee_register_number }}</td>
                    <td class="px-6 py-4">{{ $employee->name }}</td>
                    <td class="px-6 py-4">{{ $employee->contact_number }}</td>
                    <td class="px-6 py-4">{{ $employee->email }}</td>
                    <td class="px-6 py-4">{{ $employee->date_of_birth }}</td>
                    <td class="px-6 py-4 flex space-x-2">
                        <a href="{{ route('employees.show', $employee->id) }}" class="text-blue-600 hover:text-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM9 4a1 1 0 011-1h1a1 1 0 011 1v5a1 1 0 01-1 1H8a1 1 0 01-1-1V5a1 1 0 011-1zm1 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        
                        <a href="{{ route('employees.edit', $employee->id) }}" class="text-yellow-600 hover:text-yellow-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M13.707 2.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.32.208l-3 1a1 1 0 01-1.21-1.209l1-3c.052-.155.115-.377.208-.32l9-9zM15 6l-1-1 2-2 1 1-2 2z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 bg-transparent border-0 p-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.707 6.293a1 1 0 011.414 0L10 9.586l2.879-2.88a1 1 0 111.414 1.414L11.414 11l2.88 2.879a1 1 0 11-1.414 1.414L10 12.414l-2.879 2.88a1 1 0 01-1.414-1.414L8.586 11 5.707 8.121a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No employees found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
