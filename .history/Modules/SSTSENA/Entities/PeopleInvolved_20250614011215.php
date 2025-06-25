<?php

namespace App\Models;
namespace Modules\SSTSENA\Entities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class PeopleInvolved extends Model
{
    use HasFactory;

    protected $table = 'people_involveds';

    protected $fillable = [
        'person_type_id',
        'name',
        'document_number',
        'phone',
        'email',
        'address',
        'created_by'
    ];
    public function personType()
    {
        return $this->belongsTo(PersonType::class, 'person_type_id');
    }
    public function accident()
    {
        return $this->belongsTo(Accident::class, 'accident_id');
    }
    public funtion acc
}