<?php

namespace Modules\SSTSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SSTSENA\Entities\Accident;
use Modules\SICA\Entities\Environment;
use Modules\SSTSENA\Entities\InjuryType;
use Modules\SSTSENA\Entities\RiskType;
use Modules\SSTSENA\Entities\AccidentType;
use Modules\SSTSENA\Entities\TypePerson;

class AccidentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
   public function index(Request $request)
{
    $query = Accident::with([
        'environment',
        'injuryType',
        'riskType',
        'accidentType',
        'user',
    ]);

    // Filtrar por una sola fecha exacta (solo parte de la fecha sin hora)
    if ($request->filled('fecha')) {
        $query->whereDate('date_time', $request->fecha);
    }

    $accidents = $query->latest()->get();

    $typePersons = TypePerson::all();

    return view('sstsena::modulos.accidents.index', compact('accidents', 'typePersons'));
}


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $environmets = Environment::all();
        $injuryTypes = InjuryType::all();
        $riskTypes = RiskType::all();
        $accidentTypes = AccidentType::all();
        return view('sstsena::modulos.accidents.create', compact('environmets', 'injuryTypes', 'riskTypes', 'accidentTypes'));
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
            'injury_type_id' => 'required|exists:injury_types,id',
            'risk_type_id' => 'required|exists:risk_types,id',
            'accident_type_id' => 'required|exists:accident_types,id',
            'description' => 'required|string|max:255',
            'severity' => 'required|in:minor,moderate,serious,fatal',
            'evidence' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048',
        ]);

        $evidenceFileName = null;

        if ($request->hasFile('evidence')) {
            $file = $request->file('evidence');
            $evidenceFileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('evidences', $evidenceFileName, 'public'); // Guarda en storage/app/public/evidences
        }

        Accident::create([
            'date_time' => $request->date_time,
            'environment_id' => $request->environment_id,
            'injury_type_id' => $request->injury_type_id,
            'risk_type_id' => $request->risk_type_id,
            'accident_type_id' => $request->accident_type_id,
            'description' => $request->description,
            'created_by' => auth()->user()->id,
            'evidence' => $evidenceFileName, // Solo nombre del archivo
            'severity' => $request->severity,
        ]);

        return redirect()->route('sstsena.funcionario.accidents.index')
            ->with('success', 'Accidente creado correctamente.');
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
        $accident = Accident::with([
            'environment',
            'injuryType',
            'riskType',
            'accidentType',
        ])->findOrFail($id);
        $environments = Environment::all();
        $injuryTypes = InjuryType::all();
        $riskTypes = RiskType::all();
        $accidentTypes = AccidentType::all();
        return view('sstsena::modulos.accidents.edit', compact('accident', 'environments', 'injuryTypes', 'riskTypes', 'accidentTypes'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {

        $accident = Accident::findOrFail($id);
        $request->validate([
            // Validar los campos del formulario
            'date_time' => 'required|date',
            'environment_id' => 'required|exists:environments,id',
            'injury_type_id' => 'required|exists:injury_types,id',
            'risk_type_id' => 'required|exists:risk_types,id',
            'accident_type_id' => 'required|exists:accident_types,id',
            'description' => 'required|string|max:255',
            'severity' => 'required|in:minor,moderate,serious,fatal',
        ]);
        // Actualizar el accidente con los datos del formulario
        $accident->update([
            'date_time' => $request->date_time,
            'environment_id' => $request->environment_id,
            'injury_type_id' => $request->injury_type_id,
            'risk_type_id' => $request->risk_type_id,
            'accident_type_id' => $request->accident_type_id,
            'description' => $request->description,
            'evidence' => $request->hasFile('evidence')
                ? $request->file('evidence')->store('evidence', 'public')
                : $accident->evidence, // Mantener evidencia existente si no se sube una nueva
            'severity' => $request->severity,
        ]);
        return redirect()->route('sstsena.funcionario.accidents.index')
            ->with('success', 'Accident created successfully.');
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $accident = Accident::findOrFail($id);
        $accident->delete();

        return redirect()->route('sstsena.funcionario.accidents.index')
            ->with('success', 'Accident deleted successfully.');
    }
}
