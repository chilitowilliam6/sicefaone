<?php

namespace Modules\SSTSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SSTSENA\Entities\RiskType;

class RiskTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $risktype = RiskType::all();
        return view('sstsena::modulos.risk_types.index', compact('risktype'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sstsena::modulos.risk_types.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:risk_types,name',
            'description' => 'nullable|string|max:255',
        ]);

        // Store the risk type in the database
        $riskType = new RiskType();
        $riskType->name = $request->input('name');
        $riskType->description = $request->input('description');
        $riskType->save();

        return redirect()->route('sstsena.admin.risk_types.index')->with('success', 'Risk type created successfully.');
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
        $riskType = RiskType::findOrFail($id);
        return view('sstsena::modulos.risk_types.edit', compact('riskType'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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
