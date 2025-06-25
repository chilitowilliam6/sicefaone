<?php

namespace Modules\SSTSENA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Modules\SICA\Entities\Environment;
use Modules\SSTSENA\Entities\InjuryType;
use Modules\SSTSENA\Entities\RiskType;
use Modules\SSTSENA\Entities\EmergencyType;

class Emergency extends Model
{
    use HasFactory;

    // Emergency.php (modelo)
protected $fillable = [
    'date_time',
    'environment_id',
    'risk_type_id',
    'emergency_types_id',
    'description',
    'severity',
    'evidence',
    'created_by',
];

    // Define el nombre de la tabla si difiere del predeterminado
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
    public function emergencyType()
    {
        return $this->belongsTo(EmergencyType::class, 'emergency_types_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
     public function responses()
{
    return $this->morphMany(event_responses::class, 'responseable');
}
}
