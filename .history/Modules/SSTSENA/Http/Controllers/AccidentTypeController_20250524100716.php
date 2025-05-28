<?php

namespace Modules\SSTSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SSTSENA\Entities\AccidentType;

class AccidentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $AccidentTypes = AccidentType::all();
        return view('sstsena::modulos.accident_types.index', compact('AccidentTypes'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sstsena::modulos.accident_types.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:accident_types,name',
            'description' => 'nullable|string|max:255',
        ]);

        // Store the accident type in the database
        $AccidentType = new AccidentType();
        $AccidentType->name = $request->input('name');
        $AccidentType->description = $request->input('description');
        $AccidentType->save();

        return redirect()->route('sstsena.admin.accident_types.index')->with('success', 'Accident type created successfully.');
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
        $AccidentType = AccidentType::findOrFail($id);
        return view('sstsena::modulos.accident_types.edit', compact('AccidentType'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
