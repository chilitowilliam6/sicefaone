<?php

namespace Modules\SSTSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SSTSENA\Entities\Emergency;
use Modules\SICA\Entities\Environment;
use Modules\SSTSENA\Entities\IncidentType;
use Modules\SSTSENA\Entities\RiskType;
use Illuminate\Support\Facades\Storage;
use Modules\SSTSENA\Entities\EmergencyType;

class EmergencyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
{
    $query = Emergency::query();

    // Filtro por fecha si está presente en la solicitud
    if ($request->has('fecha') && !empty($request->fecha)) {
        $query->whereDate('date_time', $request->fecha);
    }

    $emergency = $query->get();
    return view('sstsena::modulos.emergencies.index', compact('emergency'));
}

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $environments = Environment::all(); // Assuming you have an Environment model
        
        $riskTypes = RiskType::all(); // Assuming you have a RiskType model
        $incidentTypes = IncidentType::all(); // Assuming you have an IncidentType model
        $emergencyTypes = EmergencyType::all(); // Assuming you have an Emergency model
        // Return the view with the necessary data
        return view('sstsena::modulos.emergencies.create', compact('environments', 'riskTypes', 'incidentTypes', 'emergencyTypes'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
        'date_time' => 'required|date',
        'environment_id' => 'required|exists:environments,id',
        'risk_type_id' => 'required|exists:risk_types,id',
        'emergency_types_id' => 'required|exists:emergency_types,id',
        'description' => 'nullable|string',
        'severity' => 'required|in:minor,moderate,serious,fatal',
        'evidence' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $data = $request->only([
        'date_time',
        'environment_id',
        'risk_type_id',
        'emergency_types_id',
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


    Emergency::create($data);



        // Redirect or return a response
        return redirect()->route('sstsena.funcionario.emergencies.index')->with('success', 'Emergency created successfully.');
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
        $emergency = Emergency::findOrFail($id); // Assuming you have an Emergency model
        $environments = Environment::all(); // Assuming you have an Environment model
        $riskTypes = RiskType::all(); // Assuming you have a RiskType model
        $emergencyTypes = EmergencyType::all(); // Assuming you have an Emergency model
        $injuryTypes = IncidentType::all(); // Assuming you have an InjuryType model

        return view('sstsena::modulos.emergencies.edit', compact('emergency', 'environments', 'riskTypes', 'emergencyTypes', 'injuryTypes'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $emergency = Emergency::findOrFail($id);
        $request->validate([
            'date_time' => 'required|date',
            'environment_id' => 'required|exists:environments,id',
            'risk_type_id' => 'required|exists:risk_types,id',
            'emergency_types_id' => 'required|exists:emergency_types,id',
            'description' => 'nullable|string',
            'severity' => 'required|in:minor,moderate,serious,fatal',
            'evidence' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

            $emergency->update([
            'date_time' => $request->date_time,
            'environment_id' => $request->environment_id,
            'emergency_types_id' => $request->emergency_types_id,
            'risk_type_id' => $request->risk_type_id,
            'description' => $request->description,
            'evidence' => $request->hasFile('evidence')
                ? $request->file('evidence')->store('evidence', 'public')
                : $emergency->evidence, // Mantener evidencia existente si no se sube una nueva
            'severity' => $request->severity,
        ]);
        return redirect()->route('sstsena.funcionario.emergencies.index')->with('success', 'Emergency updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $emergency = Emergency::findOrFail($id);
        $emergency->delete();

        return redirect()->route('sstsena.funcionario.emergencies.index')->with('success', 'Emergency deleted successfully.');
    }
}
