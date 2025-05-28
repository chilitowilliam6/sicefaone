<?php

namespace Modules\SSTSENA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class person_types extends Model
{
    use HasFactory;

    
    protected $fillable = ['name', 'description'];
}
