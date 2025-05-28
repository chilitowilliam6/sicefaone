<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PersonType;


class PeopleInvolved extends Model
{
    use HasFactory;

    protected $table = 'people_involveds';

    