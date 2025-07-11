<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventParticipant extends Model
{
    use SoftDeletes, UUID;

    protected $fillable= [
        'event_id',
        'head_of_family',
        'quantity',
        'total_price',
        'payment_status'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
