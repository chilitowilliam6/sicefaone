<?php

namespace Modules\SSTSENA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Accident extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_time',
        'environment_id',
        'injury_type_id',
        'risk_type_id',
        'accident_type_id',
        'description',
        'ev'

    ];
    
   
}
