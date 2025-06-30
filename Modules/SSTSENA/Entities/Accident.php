<?php

namespace Modules\SSTSENA\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Environment;

class Accident extends Model
{
    use HasFactory;
    protected $casts = [
        'date_time' => 'datetime',
    ];
    protected $fillable = [
        'date_time',
        'environment_id',
        'risk_type_id',
        'accident_type_id',
        'description',
        'evidence',
        'severity',
        'created_by'
    ];

    public function environment()
    {
        return $this->belongsTo(Environment::class);
    }

    public function injuryType()
    {
        return $this->belongsTo(InjuryType::class);
    }

    public function riskType()
    {
        return $this->belongsTo(RiskType::class);
    }

    public function accidentType()
    {
        return $this->belongsTo(AccidentType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function eventResponses()
    {
        return $this->morphMany(event_responses::class, 'responseable');
    }
    public function peopleInvolved()
    {
        return $this->hasMany(PeopleInvolved::class, 'accident_id', 'id');
    }

    public function accidentPersons()
    {
        return $this->hasMany(AccidentPerson::class, 'accident_id', 'id');
    }
}
