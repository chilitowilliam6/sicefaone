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
    public function index()
    {
        $peopleInvolved = PeopleInvolved::all();
        $typePersons = TypePerson::all();
        $accident = Accident::all();
        return view('sstsena::modulos.people_involved.index', compact('peopleInvolved', 'typePersons', 'accident'));
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
  //        $table->enum('document_type', ['CC', 'TI', 'CE', 'PAS','OTRO']);
  //          $table->string('document_number');
  //          $table->string('name');
  //          $table->string('last_name');
  //          $table->date('birth_date');
  //          $table->string('gender');
  //          $table->foreignId('person_type_id')->constrained('person_types')->onDelete('cascade');
  //          $table->string('phone')->nullable();
  //          $table->string('address')->nullable();
  //          $table->foreignId('accident_id')->constrained('accidents')->onDelete('cascade');
        $request->validate([

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
