<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Factory;
use App\Http\Requests\Factory\StoreFactoryRequest;
use App\Http\Requests\Factory\UpdateFactoryRequest;

class FactoryController extends Controller
{
    public function index()
    {
        $factories = Factory::withCount('employees')->paginate(10);

        return view('factories.index', compact('factories'));
    }

    public function create()
    {
        return view('factories.create');
    }

    public function store(StoreFactoryRequest $request)
    {
        Factory::create($request->validated());

        return redirect()->route('factories.index')
                         ->with('success', 'Factory created successfully.');
    }

    public function show(Factory $factory)
    {
        $factory->load('employees');

        return view('factories.show', compact('factory'));
    }

    public function edit(Factory $factory)
    {
        return view('factories.edit', compact('factory'));
    }

    public function update(UpdateFactoryRequest $request, Factory $factory)
    {
        $factory->update($request->validated());

        return redirect()->route('factories.show', $factory)
                         ->with('success', 'Factory updated successfully.');
    }

    public function destroy(Factory $factory)
    {
        $factory->delete();

        return redirect()->route('factories.index')
                         ->with('success', 'Factory deleted successfully.');
    }
}
