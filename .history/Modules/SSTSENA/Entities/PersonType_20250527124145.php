<?php

namespace Modules\SSTSENA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonType extends Model
{
  
   use HasFactory;

    protected $table = 'person_types'; // 👈 nombre correcto de la tabla

    protected $fillable = ['name', 'description'];
    
}
