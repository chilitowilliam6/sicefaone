<?php

namespace Modules\SSTSENA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Environment;
use App\Models\User;

class UnsafeAct extends Model
{
    use HasFactory;

    protected $fillable = ['date_time',
    'environment_id',
    'risk_type_id',
    'unsafe_act_type_id',
    'description',
    'severity',
    'evidence',
    'user_id',];

    protected static function newFactory()
    {
        return \Modules\SSTSENA\Database\factories\UnsafeActFactory::new();
    }

    public function environment()
    {
        return $this->belongsTo(Environment::class);
    }
    public function unsafeActType()
    {
        return $this->belongsTo(UnsafeActType::class);
    }
    public function riskType()
    {
        return $this->belongsTo(RiskType::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
     public function responses()
{
    return $this->morphMany(event_responses::class, 'responseable');
}
}
