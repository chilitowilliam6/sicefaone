<?php

namespace Modules\SSTSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SSTSENA\Entities\EmergencyType;

class EmergencyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
         $emergencyType = EmergencyType::all(); // obtén todos los registros
    return view('sstsena::modulos.emergency_type.index', compact('emergencyType'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sstsena::modulos.emergency_type.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:emergency_types,name',
            'description' => 'nullable|string|max:255',
        ]);
        
        // Store the emergency type in the database
        $emergencyType = new EmergencyType();
        $emergencyType->name = $request->input('name');
        $emergencyType->description = $request->input('description');
        $emergencyType->save();

        return redirect()->route('sstsena.admin.emergency_type.index')->with('success', 'Emergency type created successfully.');

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('sstsena::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $emergencyType = EmergencyType::findOrFail($id);
        // Aquí puedes pasar los datos de $emergencyType a la vista si es necesario
        // Por ejemplo, si necesitas pasar el nombre y la descripción:
        return view('sstsena::modulos.emergency_type.edit', compact('emergencyType'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $emergencyType = value([
            'name' => 'required|string|max:255|unique:emergency_types,name,' . $id,
            'description' => 'nullable|string|max:255',
        ]);
        $emergencyType = EmergencyType::findOrFail($id);
        $emergencyType->name = $request->input('name');
        $emergencyType->description = $request->input('description');
        $emergencyType->save();

        return redirect()->route('sstsena.admin.emergency_type.index')->with('success', 'Emergency type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $emergencyType = EmergencyType::findOrFail($id);
        $emergencyType->delete();

        return redirect()->route('sstsena.admin.emergency_type.index')->with('success', 'Emergency type deleted successfully.');
    }
}
