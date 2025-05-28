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


class AccidentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $Accidents = Accident::with(['environment', 'injuryType', 'riskType', 'accidentType'])->get();
        $environmets = Environment::all();
        $injuryTypes = InjuryType::all();
        $riskTypes = RiskType::all();
        $accidentTypes = AccidentType::all();
        return view('sstsena::modulos.accidents.index', compact('Accidents', 'environments', 'injuryTypes', 'riskTypes', 'accidentTypes'));
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
        return view('sstsena::modulos.accidents.create', compact('environmets', 'injuryTypes', 'riskTypes', 'accidentTypes') );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

     
    public function store(Request $request)
    {
        $validate = $request->validate ([
            'date_time' => 'required|date',
            'environment_id' => 'required|exists:environments,id',
            'injury_type_id' => 'required|exists:injury_types,id',
            'risk_type_id' => 'required|exists:risk_types,id',
            'accident_type_id' => 'required|exists:accident_types,id',
            'description' => 'required|string|max:255',
            'evidence' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'severity' => 'required|in:low,medium,high',

        ]);
        Accidente
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
        return view('sstsena::edit');
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
