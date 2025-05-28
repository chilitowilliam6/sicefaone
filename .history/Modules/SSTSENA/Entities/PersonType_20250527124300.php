<?php

namespace Modules\SSTSENA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonType extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected $table = 'person_types';
}
