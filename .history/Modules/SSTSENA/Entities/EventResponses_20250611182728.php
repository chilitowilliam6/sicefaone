<?php

namespace Modules\SSTSENA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class event_responses extends Model
{
    use HasFactory;
    
   protected $fillable = ['content'];

    public function responseable()
    {
        return $this->morphTo();
    }
}
