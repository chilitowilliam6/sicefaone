<?php

namespace Modules\SSTSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EventResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
     public function index($eventType, $eventId)
    {
        $event = $this->getEventModel($eventType, $eventId);
        if (!$event) {
            abort(404, 'Event not found');
        }
        $responses = $event->eventResponses()->with('createdBy')->get();
        return view('sstsena::event_responses.index', compact('event', 'responses', 'eventType'));
    }

    public function create($eventType, $eventId)
    {
        $event = $this->getEventModel($eventType, $eventId);
        if (!$event) {
            abort(404, 'Event not found');
        }
        return view('sstsena::event_responses.create', compact('event', 'eventType'));
    }

    public function store(Request $request, $eventType, $eventId)
    {
        $event = $this->getEventModel($eventType, $eventId);
        if (!$event) {
            abort(404, 'Event not found');
        }

        $request->validate([
            'response' => 'required|string',
        ]);

        $event->eventResponses()->create([
            'response' => $request->response,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('sstsena.event_responses.index', [$eventType, $eventId])
            ->with('success', 'Response created successfully.');
    }

    public function edit($eventType, $eventId, $id)
    {
        $event = $this->getEventModel($eventType, $eventId);
        if (!$event) {
            abort(404, 'Event not found');
        }
        $response = EventResponse::findOrFail($id);
        return view('sstsena::event_responses.edit', compact('event', 'response', 'eventType'));
    }

    public function update(Request $request, $eventType, $eventId, $id)
    {
        $event = $this->getEventModel($eventType, $eventId);
        if (!$event) {
            abort(404, 'Event not found');
        }
        $response = EventResponse::findOrFail($id);

        $request->validate([
            'response' => 'required|string',
        ]);

        $response->update([
            'response' => $request->response,
        ]);

        return redirect()->route('sstsena.event_responses.index', [$eventType, $eventId])
            ->with('success', 'Response updated successfully.');
    }

    public function destroy($eventType, $eventId, $id)
    {
        $event = $this->getEventModel($eventType, $eventId);
        if (!$event) {
            abort(404, 'Event not found');
        }
        $response = Event_Response::findOrFail($id);
        $response->delete();

        return redirect()->route('sstsena.event_responses.index', [$eventType, $eventId])
            ->with('success', 'Response deleted successfully.');
    }

    private function getEventModel($eventType, $eventId)
    {
        $modelMap = [
            'accidents' => \Modules\Sstsena\Entities\Accident::class,
            'incidents' => \Modules\Sstsena\Entities\Incidents::class,
            'emergencies' => \Modules\Sstsena\Entities\Emergency::class,
            'unsafe_acts' => \Modules\Sstsena\Entities\UnsafeAct::class,
        ];

        if (!array_key_exists($eventType, $modelMap)) {
            return null;
        }

        return $modelMap[$eventType]::find($eventId);
    }
}
