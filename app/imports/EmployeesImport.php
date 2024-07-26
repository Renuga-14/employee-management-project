<?php
// app/Imports/EmployeesImport.php
namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EmployeesImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Employee([
            'name' => $row['name'],
            'email' => $row['email'],
            'contact_number' => $row['contact_number'],
            'date_of_birth' => $row['date_of_birth'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.name' => 'required|string|max:255',
            '*.email' => 'required|email|unique:employees,email',
            '*.contact_number' => 'required|unique:employees,contact_number',
            '*.date_of_birth' => 'required|date',
        ];
    }

}
