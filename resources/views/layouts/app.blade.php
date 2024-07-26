<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100">
    <header class="bg-gradient-to-r from-blue-500 via-teal-500 to-green-500 text-black p-4 shadow-md">

        <div class="container mx-auto flex flex-wrap justify-between items-center">
               
                <nav class="space-x-4  md:flex">
                    <a href="{{ route('dashboard') }}" class="hover:bg-blue-700 px-3 py-2 rounded">Dashboard</a>
                    <a href="{{ route('employees.index') }}" class="hover:bg-blue-700 px-3 py-2 rounded">Employees</a>
                     <a href="{{ route('employees.import') }}" class="hover:bg-blue-700 px-3 py-2 rounded">Import</a>           
                     </nav>
        </div>
        <div class="flex-1 p-6 md:p-10">
            @yield('content')
        </div>
      
</header>
@vite('resources/js/app.js')
@livewireScripts
<script src="//unpkg.com/alpinejs" defer></script></body>
</html>

