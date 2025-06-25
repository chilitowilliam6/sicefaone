<?php

namespace Modules\SSTSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\SSTSENA\Entities\event_responses;
use Modules\SSTSENA\Entities\Accident;
use Modules\SSTSENA\Entities\Incidents;
use Modules\SSTSENA\Entities\Emergency;
use Modules\SSTSENA\Entities\UnsafeAct;


class EventResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    // Accidents
    public function indexAccidents($accidentId)
    {
        $event = Accident::findOrFail($accidentId);
        $responses = $event->eventResponses()->with('createdBy')->get();
        return view('sstsena::modulos.event_responses.accidents.index', compact('event', 'responses'));
    }

    public function createAccidents($accidentId)
    {
        $event = Accident::findOrFail($accidentId);
        return view('sstsena::modulos.event_responses.accidents.create', compact('event'));
    }

    public function storeAccidents(Request $request, $accidentId)
    {
         if (!Auth::check()) {
        return redirect()->back()->with('error', 'Debes estar autenticado para responder.');
    }
        $event = Accident::findOrFail($accidentId);
        $request->validate([
            'response' => 'required|string',
        ]);

        $event->eventResponses()->create([
            'response' => $request->response,
            'respondido_por' => Auth::user()->id,
            'response_date' => now(),
            
        ]);

        return redirect()->route('sstsena.accidents.responses.index', $accidentId)
            ->with('success', 'Respuesta creada exitosamente.');
    }

    public function editAccidents($accidentId, $id)
    {
        $event = Accident::findOrFail($accidentId);
        $response = Event_Responses::findOrFail($id);
        return view('sstsena::modulos.event_responses.accidents.edit', compact('event', 'response'));
    }

    public function updateAccidents(Request $request, $accidentId, $id)
    {
        $event = Accident::findOrFail($accidentId);
        $response = Event_Responses::findOrFail($id);
        $request->validate([
            'response' => 'required|string',
        ]);

        $response->update([
            'response' => $request->response,
        ]);

        return redirect()->route('sstsena.accidents.responses.index', $accidentId)
            ->with('success', 'Respuesta actualizada exitosamente.');
    }

    public function destroyAccidents($accidentId, $id)
    {
        $event = Accident::findOrFail($accidentId);
        $response = Event_Responses::findOrFail($id);
        $response->delete();

        return redirect()->route('sstsena.accidents.responses.index', $accidentId)
            ->with('success', 'Respuesta eliminada exitosamente.');
    }

    // Incidents
    public function indexIncidents($incidentId)
    {
        $event = Incidents::findOrFail($incidentId);
        $responses = $event->eventResponses()->with('createdBy')->get();
        return view('sstsena::modulos.event_responses.incidents.index', compact('event', 'responses'));
    }

    public function createIncidents($incidentId)
    {
        $event = Incidents::findOrFail($incidentId);
        return view('sstsena::modulos.event_responses.incidents.create', compact('event'));
    }

    public function storeIncidents(Request $request, $incidentId)
    {
        $event = Incidents::findOrFail($incidentId);
        $request->validate([
            'response' => 'required|string',
            
        ]);

        $event->eventResponses()->create([
            'response' => $request->response,
            'created_by' => Auth::id(),
            
        ]);

        return redirect()->route('sstsena.incidents.responses.index', $incidentId)
            ->with('success', 'Respuesta creada exitosamente.');
    }

    public function editIncidents($incidentId, $id)
    {
        $event = Incidents::findOrFail($incidentId);
        $response = Event_Responses::findOrFail($id);
        return view('sstsena::modulos.event_responses.incidents.edit', compact('event', 'response'));
    }

    public function updateIncidents(Request $request, $incidentId, $id)
    {
        $event = Incidents::findOrFail($incidentId);
        $response = Event_Responses::findOrFail($id);
        $request->validate([
            'response' => 'required|string',
        ]);

        $response->update([
            'response' => $request->response,
        ]);

        return redirect()->route('sstsena.incidents.responses.index', $incidentId)
            ->with('success', 'Respuesta actualizada exitosamente.');
    }

    public function destroyIncidents($incidentId, $id)
    {
        $event = Incidents::findOrFail($incidentId);
        $response = Event_Responses::findOrFail($id);
        $response->delete();

        return redirect()->route('sstsena.incidents.responses.index', $incidentId)
            ->with('success', 'Respuesta eliminada exitosamente.');
    }

    // Emergencies
    public function indexEmergencies($emergencyId)
    {
        $event = Emergency::findOrFail($emergencyId);
        $responses = $event->eventResponses()->with('createdBy')->get();
        return view('sstsena::modulos.event_responses.emergencies.index', compact('event', 'responses'));
    }

    public function createEmergencies($emergencyId)
    {
        $event = Emergency::findOrFail($emergencyId);
        return view('sstsena::modulos.event_responses.emergencies.create', compact('event'));
    }

    public function storeEmergencies(Request $request, $emergencyId)
    {
        $event = Emergency::findOrFail($emergencyId);
        $request->validate([
            'response' => 'required|string',
        ]);

        $event->eventResponses()->create([
            'response' => $request->response,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('sstsena.emergencies.responses.index', $emergencyId)
            ->with('success', 'Respuesta creada exitosamente.');
    }

    public function editEmergencies($emergencyId, $id)
    {
        $event = Emergency::findOrFail($emergencyId);
        $response = Event_Responses::findOrFail($id);
        return view('sstsena::modulos.event_responses.emergencies.edit', compact('event', 'response'));
    }

    public function updateEmergencies(Request $request, $emergencyId, $id)
    {
        $event = Emergency::findOrFail($emergencyId);
        $response = Event_Responses::findOrFail($id);
        $request->validate([
            'response' => 'required|string',
        ]);

        $response->update([
            'response' => $request->response,
        ]);

        return redirect()->route('sstsena.emergencies.responses.index', $emergencyId)
            ->with('success', 'Respuesta actualizada exitosamente.');
    }

    public function destroyEmergencies($emergencyId, $id)
    {
        $event = Emergency::findOrFail($emergencyId);
        $response = Event_Responses::findOrFail($id);
        $response->delete();

        return redirect()->route('sstsena.emergencies.responses.index', $emergencyId)
            ->with('success', 'Respuesta eliminada exitosamente.');
    }

    // Unsafe Acts
    public function indexUnsafeActs($unsafeActId)
    {
        $event = UnsafeAct::findOrFail($unsafeActId);
        $responses = $event->eventResponses()->with('createdBy')->get();
        return view('sstsena::modulos.event_responses.unsafe_acts.index', compact('event', 'responses'));
    }

    public function createUnsafeActs($unsafeActId)
    {
        $event = UnsafeAct::findOrFail($unsafeActId);
        return view('sstsena::modulos.event_responses.unsafe_acts.create', compact('event'));
    }

    public function storeUnsafeActs(Request $request, $unsafeActId)
    {
        $event = UnsafeAct::findOrFail($unsafeActId);
        $request->validate([
            'response' => 'required|string',
        ]);

        $event->eventResponses()->create([
            'response' => $request->response,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('sstsena.unsafe_acts.responses.index', $unsafeActId)
            ->with('success', 'Respuesta creada exitosamente.');
    }

    public function editUnsafeActs($unsafeActId, $id)
    {
        $event = UnsafeAct::findOrFail($unsafeActId);
        $response = Event_Responses::findOrFail($id);
        return view('sstsena::modulos.event_responses.unsafe_acts.edit', compact('event', 'response'));
    }

    public function updateUnsafeActs(Request $request, $unsafeActId, $id)
    {
        $event = UnsafeAct::findOrFail($unsafeActId);
        $response = Event_Responses::findOrFail($id);
        $request->validate([
            'response' => 'required|string',
        ]);

        $response->update([
            'response' => $request->response,
        ]);

        return redirect()->route('sstsena.unsafe_acts.responses.index', $unsafeActId)
            ->with('success', 'Respuesta actualizada exitosamente.');
    }

    public function destroyUnsafeActs($unsafeActId, $id)
    {
        $event = UnsafeAct::findOrFail($unsafeActId);
        $response = Event_Responses::findOrFail($id);
        $response->delete();

        return redirect()->route('sstsena.unsafe_acts.responses.index', $unsafeActId)
            ->with('success', 'Respuesta eliminada exitosamente.');
    }
}
