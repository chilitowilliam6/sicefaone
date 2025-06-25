<?php

namespace Modules\SSTSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SSTSENA\Entities\UnsafeActType;
use Modules\SSTSENA\Entities\UnsafeAct;
use Modules\SICA\Entities\Environment;
use Modules\SSTSENA\Entities\RiskType;

class UnsafeActController extends Controller
{
    public function index_type()
    {
        $unsafe_act_types = UnsafeActType::get();
        return view('sstsena::modulos.unsafe_acts.type.index')->with(['unsafe_act_types' => $unsafe_act_types]);
    }

    public function create_type()
    {
        return view('sstsena::modulos.unsafe_acts.type.create');
    }

    public function store_type(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:risk_types,name',
            'description' => 'nullable|string|max:255',
        ]);

        $unsafe_act_type = new UnsafeActType();
        $unsafe_act_type->name = $request->input('name');
        $unsafe_act_type->description = $request->input('description');
        $unsafe_act_type->save();

        return redirect()->route('sstsena.admin.unsafe_act_types.index')->with('success', 'Tipo de Acto Inseguro registrado exitosamente');
    }

    public function edit_type($id)
    {
        $unsafe_act_type = UnsafeActType::findOrFail($id);
        return view('sstsena::modulos.unsafe_acts.type.edit', compact('unsafe_act_type'));
    }

    public function update_type(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:risk_types,name,' . $id,
            'description' => 'nullable|string|max:255',
        ]);

        $unsafe_act_type = UnsafeActType::findOrFail($id);
        $unsafe_act_type->name = $request->input('name');
        $unsafe_act_type->description = $request->input('description');
        $unsafe_act_type->save();

        return redirect()->route('sstsena.admin.unsafe_act_types.index')->with('success', 'Risk type updated successfully.');
    }

    public function destroy_type($id)
    {
        $unsafe_act_type = UnsafeActType::findOrFail($id);
        $unsafe_act_type->delete();

        return redirect()->route('sstsena.admin.unsafe_act_types.index')->with('success', 'Risk type deleted successfully.');
    }

    public function index()
    {
        $unsafe_acts = UnsafeAct::all(); // This should be replaced with actual data retrieval logic
        return view('sstsena::modulos.unsafe_acts.index', compact('unsafe_acts'));
    }

    public function create()
    {
        $environments = Environment::all();
        $unsafeActTypes = UnsafeActType::all();
        $riskTypes = RiskType::all();

        return view('sstsena::modulos.unsafe_acts.create', compact('environments', 'riskTypes', 'unsafeActTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'date_time' => 'required|date',
        'environment_id' => 'required|exists:environments,id',
        'risk_type_id' => 'required|exists:risk_types,id',
        'unsafe_act_type_id' => 'required|exists:unsafe_act_types,id',
        'description' => 'nullable|string',
        'severity' => 'required|in:minor,moderate,serious,fatal',
        'evidence' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $data = $request->only([
        'date_time',
        'environment_id',
        'risk_type_id',
        'unsafe_act_type_id',
        'description',
        'severity',
    ]);
    $file = $request->file('evidence');

    $destinationPath = storage_path('app/public/evidences');
    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0755, true);
    }

    $fileName = $file->getClientOriginalName();

    if ($file->move($destinationPath, $fileName)) {
        // Guardamos la ruta relativa para luego acceder con el disco 'public'
        $data['evidence'] = 'evidences/' . $fileName;
    } else {
        return back()->withErrors(['evidence' => 'Error al mover archivo'])->withInput();
    }

    $data['user_id'] = auth()->id();

    UnsafeAct::create($data);

        // Redirect or return a response
        return redirect()->route('sstsena.funcionario.unsafe_acts.index')->with('success', 'UnsafeAct created successfully.');
    }

    public function show($id)
    {
        return view('sstsena::show');
    }

    public function edit($id)
    {
        $unsafe_act = UnsafeAct::findOrFail($id);
        $unsafeActTypes = UnsafeActType::all();
        $environments = Environment::all();
        $riskTypes = RiskType::all();

        return view('sstsena::modulos.unsafe_acts.edit', compact('unsafe_act', 'environments', 'riskTypes', 'unsafeActTypes'));
    }

    public function update(Request $request, $id)
{
    $unsafe_act = UnsafeAct::findOrFail($id);

    $request->validate([
        'date_time' => 'required|date',
        'environment_id' => 'required|exists:environments,id',
        'risk_type_id' => 'required|exists:risk_types,id',
        'unsafe_act_type_id' => 'required|exists:unsafe_act_types,id',
        'description' => 'nullable|string',
        'severity' => 'required|in:minor,moderate,serious,fatal',
        'evidence' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    // Datos base
    $data = [
        'date_time' => $request->date_time,
        'environment_id' => $request->environment_id,
        'risk_type_id' => $request->risk_type_id,
        'unsafe_act_type_id' => $request->unsafe_act_type_id,
        'description' => $request->description,
        'severity' => $request->severity,
    ];

    // Si se sube una nueva evidencia
    if ($request->hasFile('evidence')) {
        $file = $request->file('evidence');

        $destinationPath = storage_path('app/public/evidences');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $fileName = time() . '_' . $file->getClientOriginalName();

        if ($file->move($destinationPath, $fileName)) {
            // Eliminar la anterior si existe
            if ($unsafe_act->evidence && file_exists(storage_path('app/public/' . $unsafe_act->evidence))) {
                unlink(storage_path('app/public/' . $unsafe_act->evidence));
            }

            // Guardar la nueva ruta relativa
            $data['evidence'] = 'evidences/' . $fileName;
        } else {
            return back()->withErrors(['evidence' => 'Error al mover el archivo'])->withInput();
        }
    }

    // Actualizar el registro
    $unsafe_act->update($data);

    return redirect()->route('sstsena.funcionario.unsafe_acts.index')->with('success', 'UnsafeAct updated successfully.');
}

    public function destroy($id)
    {
        $unsafe_act = UnsafeAct::findOrFail($id);
        $unsafe_act->delete();

        return redirect()->route('sstsena.funcionario.unsafe_acts.index')->with('success', 'UnsafeAct deleted successfully.');
    }
}
