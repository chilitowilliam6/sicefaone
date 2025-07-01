<?php

namespace Modules\SSTSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SSTSENA\Entities\Accident;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\Person;
use Modules\SSTSENA\Entities\AccidentPerson;
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

    public function buscarPorDocumento(Request $request)
    {
        $documento = $request->query('documento');

        $persona = Person::where('document_number', $documento)->first();

        if (!$persona) {
            return response()->json(['success' => false, 'message' => 'Persona no encontrada']);
        }

        // Comprobamos si tiene al menos un empleado, contratista o aprendiz relacionado
        $empleado = $persona->employees()->with('employee_type')->first();
        $contratista = $persona->contractors()->with('employee_type')->first();
        $aprendiz = $persona->apprentices()->first();

        // Determinar tipo
        $tipo = 'Visitante';
        $cargo = 'Visitante';

        if ($empleado) {
            $tipo = 'Empleado';
            $cargo = $empleado->employee_type->name ?? 'Desconocido';
        } elseif ($contratista) {
            $tipo = 'Contratista';
            $cargo = $contratista->employee_type->name ?? 'Desconocido';
        } elseif ($aprendiz) {
            $tipo = 'Aprendiz';
            $cargo = 'Aprendiz' ?? 'Desconocido';
        }

        return response()->json([
            'success' => true,
            'persona' => [
                'id' => $persona->id,
                'nombre' => $persona->first_name,
                'apellido1' => $persona->first_last_name,
                'apellido2' => $persona->second_last_name,
                'tipo' => $tipo,
                'cargo' => $cargo,
            ],
        ]);
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
        'accident_type_id' => 'required|exists:accident_types,id',
        'description' => 'required|string|max:255',
        'severity' => 'required|in:minor,moderate,serious,fatal',
        'evidence' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048',
        'personas.*.document_number' => 'required|exists:people,document_number',
        'personas.*.injury_type_id' => 'required|exists:injury_types,id',
        'personas.*.observation' => 'nullable|string|max:500',
    ]);

    $filename = null;


if ($request->hasFile('evidence')) {
    $file = $request->file('evidence');

    if ($file->isValid()) {
        $filename = time() . '_' . $file->getClientOriginalName();

        // Ruta absoluta al directorio storage/app/public/evidences
        $destinationPath = storage_path('app/public/evidences');

        // Asegúrate de que la carpeta exista
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Mueve el archivo al destino
        $file->move($destinationPath, $filename);

        // Guarda el nombre del archivo para almacenar en la base de datos
        $evidence = $filename;
    } else {
        // Manejar archivo inválido
        return back()->withErrors(['evidence' => 'El archivo no es válido.']);
    }
}

    $accident = Accident::create([
        'date_time' => $request->date_time,
        'environment_id' => $request->environment_id,
        'risk_type_id' => $request->risk_type_id,
        'accident_type_id' => $request->accident_type_id,
        'description' => $request->description,
        'created_by' => auth()->user()->id,
        'evidence' => $filename, // CORRECTO AHORA
        'severity' => $request->severity,

        
    ]);

    foreach ($request->personas as $personaData) {
        $persona = Person::where('document_number', $personaData['document_number'])->first();
        if ($persona) {
            AccidentPerson::create([
                'person_id' => $persona->id,
                'accident_id' => $accident->id,
                'injury_type_id' => $personaData['injury_type_id'],
                'observation' => $personaData['observation'] ?? null,
            ]);
        }
    }

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
        'date_time' => 'required|date',
        'environment_id' => 'required|exists:environments,id',
        'risk_type_id' => 'required|exists:risk_types,id',
        'accident_type_id' => 'required|exists:accident_types,id',
        'description' => 'required|string|max:255',
        'severity' => 'required|in:minor,moderate,serious,fatal',
        'evidence' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048',
        'personas.*.document_number' => 'required|exists:people,document_number',
        'personas.*.injury_type_id' => 'required|exists:injury_types,id',
        'personas.*.observation' => 'nullable|string|max:500',
    ]);

    // Manejo de archivo de evidencia manualmente
    $evidence = $accident->evidence;

    if ($request->hasFile('evidence')) {
        $file = $request->file('evidence');

        if ($file->isValid()) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = storage_path('app/public/evidences');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);
            $evidence = $filename;
        } else {
            return back()->withErrors(['evidence' => 'El archivo no es válido.']);
        }
    }

    // Actualizar accidente
    $accident->update([
        'date_time' => $request->date_time,
        'environment_id' => $request->environment_id,
        'injury_type_id' => $request->injury_type_id,
        'risk_type_id' => $request->risk_type_id,
        'accident_type_id' => $request->accident_type_id,
        'description' => $request->description,
        'evidence' => $evidence,
        'severity' => $request->severity,
    ]);

    // Obtener IDs de personas recibidas en el formulario
    $documentNumbersFromForm = collect($request->personas)->pluck('document_number');

    // Obtener todas las personas asociadas previamente
    $existingAccidentPersons = $accident->accidentPersons;

    // Eliminar las personas que ya no están en el formulario
    foreach ($existingAccidentPersons as $ap) {
        if (!$documentNumbersFromForm->contains($ap->person->document_number)) {
            $ap->delete(); // Elimina la relación AccidentPerson
        }
    }

    // Actualizar o crear las personas del formulario
    foreach ($request->personas as $personaData) {
        $persona = Person::where('document_number', $personaData['document_number'])->first();
        if ($persona) {
            $accidentPerson = AccidentPerson::updateOrCreate(
                ['accident_id' => $accident->id, 'person_id' => $persona->id],
                [
                    'injury_type_id' => $personaData['injury_type_id'],
                    'observation' => $personaData['observation'] ?? null,
                ]
            );
        }
    }

    return redirect()->route('sstsena.funcionario.accidents.index')
        ->with('success', 'Accidente actualizado correctamente.');
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
