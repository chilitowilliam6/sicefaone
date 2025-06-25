<?php

namespace Modules\SSTSENA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Environment;
use Modules\SSTSENA\Entities\RiskType;
use Modules\SSTSENA\Entities\IncidentType;
use App\Models\User;

class Incidents extends Model
{
    protected $fillable = [
        'date_time',
        'environment_id',
        'risk_type_id',
        'incident_type_id',
        'description',
        'severity',
        'evidence',
        'created_by',
    ];

    public function environment()
    {
        return $this->belongsTo(\Modules\SICA\Entities\Environment::class);
    }

    public function riskType()
    {
        return $this->belongsTo(RiskType::class);
    }

    public function incidentType()
    {
        return $this->belongsTo(IncidentType::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by'); 
    }

     public function eventResponses()
{
    return $this->morphMany(event_responses::class, 'responseable');
}
}
