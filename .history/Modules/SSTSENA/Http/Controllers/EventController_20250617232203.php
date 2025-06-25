<?php

namespace Modules\SSTSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SSTSENA\Entities\Accident;
use Modules\SSTSENA\Entities\Emergency;
use Modules\SSTSENA\Entities\Incidents;
use Modules\SSTSENA\Entities\UnsafeAct;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
 public function index()
{
    // Inicializa la consulta para accidentes con carga de relaciones
    $accidentsQuery = Accident::with('eventResponses');
    // Inicializa la consulta para incidentes con carga de relaciones
    $incidentsQuery = Incidents::with('eventResponses');

    // Aplica el filtro de fecha para accidentes si está presente
    if (request()->has('date_time') && !empty(request()->input('date_time'))) {
        $dateTime = request()->input('date_time');
        $accidentsQuery->whereDate('date_time', $dateTime);
    }

    // Aplica el filtro de fecha para incidentes si está presente
    if (request()->has('fecha_hora') && !empty(request()->input('fecha_hora'))) {
        $fechaHora = request()->input('fecha_hora');
        $incidentsQuery->whereDate('fecha_hora', $fechaHora);
    }

    // Obtiene los accidentes e incidentes filtrados
    $accidents = $accidentsQuery->get();
    $incidents = $incidentsQuery->get();
    $emergencies = Emergency::with('eventResponses')->get();
    $unsafeActs = UnsafeAct::with('eventResponses')->get();

    // Retorna la vista con los datos compactados
    return view('sstsena::modulos.event_responses.events.index', compact('accidents', 'incidents', 'emergencies', 'unsafeActs'));
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
