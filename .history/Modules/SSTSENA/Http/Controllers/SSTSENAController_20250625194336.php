<?php

namespace Modules\SSTSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
 use Modules\SSTSENA\Entities\Accident;
use Modules\SSTSENA\Entities\Incidents;
use Modules\SSTSENA\Entities\Emergency;
use Modules\SSTSENA\Entities\UnsafeAct;
use Carbon\Carbon;

class SSTSENAController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('sstsena::index');
        
    }
     public function pruebas()
    {
        return view('sstsena::pruebas');
        
    }


public function welcome()
{
    // Obtiene los datos
    $accidents = Accident::with('eventResponses')->get();
    $incidents = Incidents::with('eventResponses')->get();
    $emergencies = Emergency::with('eventResponses')->get();
    $unsafeActs = UnsafeAct::with('eventResponses')->get();

    // Calcula el total de reportes
    $totalReports = $accidents->count() + $incidents->count() + $emergencies->count() + $unsafeActs->count();

    // Retorna la vista con los datos
    return view('sstsena::welcome', compact('totalReports'));
}
    public function admin()
    {
        return view('sstsena::modulos.admin.dashboard');
    }

    public function funcionario()
    {
        return view('sstsena::modulos.funcionario.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sstsena::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
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
