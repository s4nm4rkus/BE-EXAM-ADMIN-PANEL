<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Factory;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('factory')->paginate(10);
        $factories = Factory::all();
        $employee  = null;

        $tab = request()->query('tab');
        $id  = request()->query('id');

        if (in_array($tab, ['edit', 'show']) && $id) {
            $employee = Employee::with('factory')->findOrFail($id);
        }

        return view('employees.index', compact('employees', 'factories', 'employee'));
    }

    public function create()
    {
        return redirect()->route('employees.index', ['tab' => 'create']);
    }

    public function store(StoreEmployeeRequest $request)
    {
        Employee::create($request->validated());
        return redirect()->route('employees.index')
                         ->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee)
    {
        return redirect()->route('employees.index', ['tab' => 'show', 'id' => $employee->id]);
    }

    public function edit(Employee $employee)
    {
        return redirect()->route('employees.index', ['tab' => 'edit', 'id' => $employee->id]);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());
        return redirect()->route('employees.index')
                         ->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')
                         ->with('success', 'Employee deleted successfully.');
    }
}
