<?php

namespace Modules\SSTSENA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class per extends Model
{
    use HasFactory;

    protected $table = 'person_types';
    protected $fillable = ['name', 'description'];
}
