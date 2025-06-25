<?php

namespace Modules\SSTSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SSTSENA\Entities\Accident;
use Modules\SSTSENA\Entities\TypePerson; // Assuming you have a TypePerson model in the SSTSENA module
use Modules\SSTSENA\Entities\PeopleInvolved; // Assuming you have a PeopleInvolved model in the SSTSENA module

class PeopleInvolvedController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        // Consulta base con relaciones
        $query = PeopleInvolved::with(['personType', 'accident']);
    
        // Si hay un filtro de documento
        if ($request->filled('search_document')) {
            $query->where('document_number', 'like', '%' . $request->search_document . '%');
        }
    
        // Ejecutar la consulta
        $peopleInvolved = $query->get();
    
        // Cargar datos auxiliares
        $typePersons = TypePerson::all();
        $accident = Accident::all();
    
        return view('sstsena::modulos.people_involveds.index', compact('peopleInvolved', 'typePersons', 'accident'));
    }
    

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $typePersons = TypePerson::all();
        $accident = Accident::all();
        return view('sstsena::modulos.people_involveds.create', compact('typePersons', 'accident'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
 
        $request->validate([
            'document_type' => 'required|string|max:10',
            'document_number' => 'required|string|max:20',
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:10',
            'person_type_id' => 'required|exists:person_types,id',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'accident_id' => 'required|exists:accidents,id',
        ]);
        // Store the person involved in the database
        $peopleInvolved = new PeopleInvolved();
        $peopleInvolved->document_type = $request->input('document_type');
        $peopleInvolved->document_number = $request->input('document_number');
        $peopleInvolved->name = $request->input('name');
        $peopleInvolved->last_name = $request->input('last_name');
        $peopleInvolved->birth_date = $request->input('birth_date');
        $peopleInvolved->gender = $request->input('gender');
        $peopleInvolved->person_type_id = $request->input('person_type_id');
        $peopleInvolved->phone = $request->input('phone');
        $peopleInvolved->address = $request->input('address');
        $peopleInvolved->accident_id = $request->input('accident_id');
        $peopleInvolved->save();
        return redirect()->route('sstsena.funcionario.people_involved.index')->with('success', 'Person involved created successfully.');    
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
        // Find the person involved by ID
        $peopleInvolved = PeopleInvolved::findOrFail($id);
        $typePersons = TypePerson::all();
        $accident = Accident::all();
        return view('sstsena::modulos.people_involveds.edit', compact('peopleInvolved', 'typePersons', 'accident'));
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
        $peopleInvolved = PeopleInvolved::findOrFail($id);
        $peopleInvolved->delete();
        return redirect()->route('sstsena.funcionario.people_involved.index')->with('success', 'Person involved deleted successfully.');
    }
}
