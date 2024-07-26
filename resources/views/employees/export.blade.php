<!DOCTYPE html>
<html>
<head>
    <title>Employee Records</title>
    <style>
        /* Inline Tailwind CSS styles for PDF rendering */
        @import url('https://fonts.googleapis.com/css2?family=Arial:wght@400;700&display=swap');

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            padding: 1rem;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        .table th, .table td {
            padding: 0.5rem;
            border: 1px solid #ddd;
            text-align: left;
        }
        .table th {
            background-color: #f9fafb;
        }
        .table tr:nth-child(even) {
            background-color: #f9fafb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Employee Records</h1>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-left">ID</th>
                    <th class="text-left">Register Number</th>
                    <th class="text-left">Name</th>
                    <th class="text-left">Email</th>
                    <th class="text-left">Contact Number</th>
                    <th class="text-left">DOB</th>
                    <th class="text-left">Address</th>
                   
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->employee_register_number }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->contact_number }}</td>
                        <td>{{ $employee->date_of_birth }}</td>
                        <td>{{ $employee->address }}</td>
                     
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
