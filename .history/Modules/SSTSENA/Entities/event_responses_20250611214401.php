<?php

namespace Modules\SSTSENA\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class event_responses extends Model
{
    use HasFactory;

    protected $fillable = [
        'response',
        'actions_taken',
        'status',
        'severity',
        'response_date',
        'respondido_por'
    ];

    protected $casts = [
        'response_date' => 'datetime',
    ];

    public function responseable()
    {
        return $this->morphTo();
    }
    public function createdBy()
{
    return $this->belongsTo(User::class, 'respondido_por');
}

}
