<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class PeopleInvolved extends Model
{
    use HasFactory;

    protected $table = 'people_involveds';

    protected $fillable = [
        'person_type_id',
        'name',
        'document_number',
        'phone',
        'email',
        'address',
        'created_by'
    ];
   public function P()
    {
        return $this->belongsTo(Environment::class);
    }
