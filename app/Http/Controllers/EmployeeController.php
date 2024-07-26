<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Role;
use App\Http\Requests\StoreEmployeeRequest;
use App\Imports\EmployeesImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function exportPdf()
    {
        // Fetch all employees
        $employees = Employee::all();

        // Load the view and pass in employee data
        $pdf = Pdf::loadView('employees.export', compact('employees'));

        // Download the PDF file
        return $pdf->download('employees.pdf');
    }
    public function index(Request $request)
    {
        // Retrieve filter inputs
        $name = $request->input('name');
        $email = $request->input('email');

        // Query with filters
        $query = Employee::query();

        if ($name) {
            $query->where('name', 'like', "%$name%");
        }

        if ($email) {
            $query->where('email', 'like', "%$email%");
        }

        $employees = $query->paginate(10); // Paginate results

        return view('employees.index', compact('employees'));
    }
    public function create()
    {
        return view('employees.create');
    }
    
    
    public function store(Request $request)
    
    {
    
        $lastEmployee = Employee::orderBy('id', 'desc')->first();
        $lastRegisterNumber = $lastEmployee ? $lastEmployee->employee_register_number : 'EMP000';
        $nextNumber = intval(substr($lastRegisterNumber, 3)) + 1;
        $nextRegisterNumber = 'EMP' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        $employee = new Employee();
        $employee->name = $request->input('name');
        $employee->contact_number = $request->input('contact_number');
        $employee->email = $request->input('email');
        $employee->date_of_birth = $request->input('date_of_birth');
        $employee->address = $request->input('address');
        $employee->employee_register_number = $nextRegisterNumber;
        $employee->save();

        return redirect()->route('employees')->with('success', 'Employee added successfully!');
    
    }
    

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
       
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|unique:employees,contact_number,' . $employee->id . '|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'date_of_birth' => 'required|date',
            'address' => 'nullable|string',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

    public function grid(Request $request)
{
    $query = Employee::query();

    if ($request->has('search')) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%')
              ->orWhere('contact_number', 'like', '%' . $request->search . '%');
    }

    if ($request->has('department') && $request->department) {
        $query->where('department_id', $request->department);
    }

    if ($request->has('role') && $request->role) {
        $query->where('role_id', $request->role);
    }

    $employees = $query->get();
 

    return view('employees.grid', compact('employees'));
}
public function showImportForm()
{
    return view('employees.import');
}

public function import(Request $request)
{  
    

    $request->validate([
        'file' => 'required|mimes:csv,txt',
    ]);

    $file = $request->file('file');
    $data = array_map('str_getcsv', file($file));

    $header = array_shift($data);
// Replace spaces with underscores in each element of the array
$header = array_map(function($item) {
    return str_replace(' ', '_', $item);
}, $header);

// Output the result
    $employees = [];

    foreach ($data as $k=>$row) {
        $employee = array_combine($header, $row);
        $lastEmployee = Employee::orderBy('id', 'desc')->first();
    $lastRegisterNumber = $lastEmployee ? $lastEmployee->employee_register_number : 'EMP000';
    $nextNumber = intval(substr($lastRegisterNumber, 3)) + ($k+1);
    $nextRegisterNumber = 'EMP' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
   
    // Convert to YYYY-MM-DD format
$date = \DateTime::createFromFormat('d-m-Y', $row[3]);
$formattedDate = $date->format('Y-m-d');
    $employee['employee_register_number'] = $nextRegisterNumber;
    $employee['date_of_birth'] = $formattedDate;
        $employees[] = $employee;
       
       
    }
    

    $validationErrors = [];
    foreach ($employees as $index => $employee) { 
        $validator = Validator::make(array_change_key_case($employee, CASE_LOWER), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'contact_number' => 'required|unique:employees,contact_number',
            'date_of_birth' => 'required|date',
        ]);

        if ($validator->fails()) {
            $validationErrors[$index + 1] = $validator->errors()->all();
        }
    } 
 
     if (!empty($validationErrors)) {
        return redirect()->back()->withErrors($validationErrors);
    }

    foreach ($employees as $employee) { //print_r(array_change_key_case($employee, CASE_LOWER));
        unset($employee['Date_Of_Birth']);

        Employee::create(array_change_key_case($employee, CASE_LOWER));
    }
 
    return redirect()->back()->with('success', 'Employees imported successfully.'); 
}
 
public function displayAllRecords()
{
    $employees = Employee::all(); // Fetch all employees
    
    // Return employees in JSON format
    return response()->json($employees);
}
}
