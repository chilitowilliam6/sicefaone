<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class PeopleInvolved extends Model
{
    use HasFactory;

    protected $table = 'people_involveds';

    protected $fillable = [
        'document_type',
        'document_number',
        'name',
        'last_name',
        'birth_date',
        'gender',
        'person_type_id',
        'phone',
        'address',
        'accident_id',
    ];
    