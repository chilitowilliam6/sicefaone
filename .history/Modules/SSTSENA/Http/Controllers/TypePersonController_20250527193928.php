<?php

namespace Modules\SSTSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SSTSENA\Entities\TypePerson; // Assuming you have a PersonType model in the SSTSENA module

class TypePersonController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $personTypes = TypePerson::all();
        return view('sstsena::modulos.person_types.index', compact('personTypes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sstsena::modulos.person_types.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:person_types,name',
            'description' => 'nullable|string|max:255',
        ]);

        // Store the type person in the database
        $typePerson = new TypePerson();
        $typePerson->name = $request->input('name');
        $typePerson->description = $request->input('description');
        $typePerson->save();

         return redirect()->route('sstsena.admin.TypePerson.index')->with('success', 'Risk type created successfully.');
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
        $
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
