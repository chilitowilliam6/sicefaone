<?php

namespace Modules\SSTSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SSTSENA\Entities\IncidentType;

class IncidentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $incidentTypes = IncidentType::all();
        return view('sstsena::modulos.incident_type.index', compact('incidentTypes'));
        
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sstsena::modulos.incident_type.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:incident_types,name',
            'description' => 'nullable|string|max:255',
        ]);

        // Store the incident type in the database
        $incidentType = new IncidentType();
        $incidentType->name = $request->input('name');
        $incidentType->description = $request->input('description');
        $incidentType->save();

        return redirect()->route('sstsena.admin.incident_types.index')->with('success', 'Incident type created successfully.');
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
        $incidentType = IncidentType::findOrFail($id);
        return view('sstsena::modulos.incident_type.edit', compact('incidentType'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:incident_types,name,' . $id,
            'description' => 'nullable|string|max:255',
        ]);

        // Update the incident type in the database
        $incidentType = IncidentType::findOrFail($id);
        $incidentType->name = $request->input('name');
        $incidentType->description = $request->input('description');
        $incidentType->save();

        return redirect()->route('sstsena.admin.incident_types.index')->with('success', 'Incident type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $incidentType = IncidentType::findOrFail($id);
        $incidentType->delete();

        return redirect()->route('sstsena.admin.incident_types.index')->with('success', 'Incident type deleted successfully.');
    }
}
