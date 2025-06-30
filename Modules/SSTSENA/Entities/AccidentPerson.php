<?php

namespace Modules\SSTSENA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccidentPerson extends Model
{
    use HasFactory;

    protected $fillable = ['person_id', 'accident_id', 'injury_type_id', 'observation'];

    protected static function newFactory()
    {
        return \Modules\SSTSENA\Database\factories\AccidentPersonFactory::new();
    }

    public function person()
    {
        return $this->belongsTo(\Modules\SICA\Entities\Person::class);
    }
    public function accident()
    {
        return $this->belongsTo(Accident::class);
    }
    public function injuryType()
    {
        return $this->belongsTo(\Modules\SSTSENA\Entities\InjuryType::class);
    }
    public function eventResponses()
    {
        return $this->morphMany(event_responses::class, 'responseable');
    }
}
