<?php

namespace Modules\SSTSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SSTSENA\Entities\IncidentType;
use Modules\SSTSENA\Entities\RiskType;
use Modules\SICA\Entities\Environment;
use Modules\SSTSENA\Entities\Incidents;
use Illuminate\Support\Facades\Storage;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $incidents = Incidents::with([
            'environment',
            'riskType',
            'incidentType',
            'user',
        ])->latest()->get();

        return view('sstsena::modulos.incidents.index', compact('incidents'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $environments = Environment::all();
        $riskTypes = RiskType::all();
        $incidentTypes = IncidentType::all();

        return view('sstsena::modulos.incidents.create', compact('environments', 'riskTypes', 'incidentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
{
    $request->validate([
        'date_time' => 'required|date',
        'environment_id' => 'required|exists:environments,id',
        'risk_type_id' => 'required|exists:risk_types,id',
        'incident_type_id' => 'required|exists:incident_types,id',
        'description' => 'nullable|string',
        'severity' => 'required|in:minor,moderate,serious,fatal',
        'evidence' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $data = $request->only([
        'date_time',
        'environment_id',
        'risk_type_id',
        'incident_type_id',
        'description',
        'severity',
    ]);

    if ($request->hasFile('evidence')) {
        $file = $request->file('evidence');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('evidences', $filename, 'public'); // Guarda en storage/app/public/evidences
        $data['evidence'] = $filename; // Solo guarda el nombre del archivo
    }

    $data['created_by'] = auth()->id();

    Incidents::create($data);

    return redirect()->route('sstsena.funcionario.incidents.index')
        ->with('success', 'Incidente creado exitosamente.');
}


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $incident = Incidents::with([
            'environment',
            'riskType',
            'incidentType',
        ])->findOrFail($id);

        $environments = Environment::all();
        $riskTypes = RiskType::all();
        $incidentTypes = IncidentType::all();

        return view('sstsena::modulos.incidents.edit', compact('incident', 'environments', 'riskTypes', 'incidentTypes'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
{
    $incident = Incidents::findOrFail($id);

    $request->validate([
        'date_time' => 'required|date',
        'environment_id' => 'required|exists:environments,id',
        'risk_type_id' => 'required|exists:risk_types,id',
        'incident_type_id' => 'required|exists:incident_types,id',
        'description' => 'nullable|string',
        'severity' => 'required|in:minor,moderate,serious,fatal',
        'evidence' => 'nullable|image|max:2048', // Puedes ajustar los tipos y tamaño
    ]);

    $data = $request->only([
        'date_time', 'environment_id', 'risk_type_id',
        'incident_type_id', 'description', 'severity'
    ]);

    if ($request->hasFile('evidence')) {
        // Eliminar archivo anterior
        if ($incident->evidence && Storage::disk('public')->exists('evidences/' . $incident->evidence)) {
            Storage::disk('public')->delete('evidences/' . $incident->evidence);
        }

        $file = $request->file('evidence');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('evidences', $filename, 'public');
        $data['evidence'] = $filename;
    }

    $incident->update($data);

    return redirect()->route('sstsena.funcionario.incidents.index')->with('success', 'Incidente actualizado correctamente.');
}


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $incident = Incidents::findOrFail($id);
        $incident->delete();

        return redirect()->route('sstsena.funcionario.incidents.index')->with('success', 'Incidente eliminado exitosamente.');
    }
}
