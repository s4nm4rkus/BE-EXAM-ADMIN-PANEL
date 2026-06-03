<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Http\Requests\StoreFactoryRequest;
use App\Http\Requests\UpdateFactoryRequest;

class FactoryController extends Controller
{
    public function index()
    {
        $factories = Factory::withCount('employees')->paginate(10);
        $factory   = null;

        $tab = request()->query('tab');
        $id  = request()->query('id');

        if ($tab === 'show' && $id) {
            $factory = Factory::with('employees')->findOrFail($id);
        }

        return view('factories.index', compact('factories', 'factory'));
    }

    public function create()
    {
        return redirect()->route('factories.index');
    }

    public function store(StoreFactoryRequest $request)
    {
        Factory::create($request->validated());
        return redirect()->route('factories.index')
                         ->with('success', 'Factory created successfully.');
    }

    public function show(Factory $factory)
    {
        return redirect()->route('factories.index', ['tab' => 'show', 'id' => $factory->id]);
    }

    public function edit(Factory $factory)
    {
        return redirect()->route('factories.index', ['tab' => 'show', 'id' => $factory->id]);
    }

    public function update(UpdateFactoryRequest $request, Factory $factory)
    {
        $factory->update($request->validated());
        return redirect()->route('factories.index')
                         ->with('success', 'Factory updated successfully.');
    }

    public function destroy(Factory $factory)
    {
        $factory->delete();
        return redirect()->route('factories.index')
                         ->with('success', 'Factory deleted successfully.');
    }
}
