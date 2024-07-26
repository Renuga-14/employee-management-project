<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;

 Route::view('/', 'welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';





// Dashboard route
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Resource routes for employees, departments, and roles
/* Route::resource('employees', EmployeeController::class);
Route::resource('departments', DepartmentController::class);
Route::resource('roles', RoleController::class);
 */


// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/employees/allRecords', [EmployeeController::class, 'displayAllRecords']);

// Employee routes
Route::get('/employees/import', [EmployeeController::class, 'showImportForm'])->name('employees.import.form');

Route::resource('employees', EmployeeController::class);
Route::get('employees/grid', [EmployeeController::class, 'grid'])->name('employees.grid');// Grid view route
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('/employees/export-pdf', [EmployeeController::class, 'exportPdf'])->name('employees.export');;

Route::post('/employees/import', [EmployeeController::class, 'import'])->name('employees.import');
