<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Factory;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('factory')->paginate(10);

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $factories = Factory::all();

        return view('employees.create', compact('factories'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        Employee::create($request->validated());

        return redirect()->route('employees.index')
                         ->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee)
    {
        $employee->load('factory');

        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $factories = Factory::all();

        return view('employees.edit', compact('employee', 'factories'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

        return redirect()->route('employees.show', $employee)
                         ->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')
                         ->with('success', 'Employee deleted successfully.');
    }
}
