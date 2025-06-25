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
    // Inicializa las consultas con carga de relaciones
    $accidentsQuery = Accident::with('eventResponses');
    $incidentsQuery = Incidents::with('eventResponses');
    $emergenciesQuery = Emergency::with('eventResponses');
    $unsafeActsQuery = UnsafeAct::with('eventResponses');

    // Aplica el filtro de fecha para accidentes si está presente
    if (request()->has('date_time_accidents') && !empty(request()->input('date_time_accidents'))) {
        try {
            $dateTimeAccidents = Carbon::parse(request()->input('date_time_accidents'))->toDateString();
            $accidentsQuery->whereDate('date_time', $dateTimeAccidents);
        } catch (\Exception $e) {
            // Opcional: Manejar fecha inválida
            // Por ejemplo, registrar el error o redirigir con un mensaje
        }
    }

    // Aplica el filtro de fecha para incidentes si está presente
    if (request()->has('date_time_incidents') && !empty(request()->input('date_time_incidents'))) {
        try {
            $dateTimeIncidents = Carbon::parse(request()->input('date_time_incidents'))->toDateString();
            $incidentsQuery->whereDate('date_time', $dateTimeIncidents);
        } catch (\Exception $e) {
            // Opcional: Manejar fecha inválida
        }
    }

    // Aplica el filtro de fecha para emergencias si está presente
    if (request()->has('date_time_emergencies') && !empty(request()->input('date_time_emergencies'))) {
        try {
            $dateTimeEmergencies = Carbon::parse(request()->input('date_time_emergencies'))->toDateString();
            $emergenciesQuery->whereDate('date_time', $dateTimeEmergencies);
        } catch (\Exception $e) {
            // Opcional: Manejar fecha inválida
        }
    }

    // Aplica el filtro de fecha para actos inseguros si está presente
    if (request()->has('date_time_unsafe_acts') && !empty(request()->input('date_time_unsafe_acts'))) {
        try {
            $dateTimeUnsafeActs = Carbon::parse(request()->input('date_time_unsafe_acts'))->toDateString();
            $unsafeActsQuery->whereDate('date_time', $dateTimeUnsafeActs);
        } catch (\Exception $e) {
            // Opcional: Manejar fecha inválida
        }
    }

    // Obtiene los datos filtrados
    $accidents = $accidentsQuery->get();
    $incidents = $incidentsQuery->get();
    $emergencies = $emergenciesQuery->get();
    $unsafeActs = $unsafeActsQuery->get();

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
