<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialAssistanceRecipient extends Model
{
    use SoftDeletes, UUID;

    protected $fillable= [
        'social_assitance_id',
        'head_of_family',
        'amount',
        'reason',
        'bank',
        'account_number',
        'proof',
        'status'
    ];

    public function SocialAssistance()
    {
        return $this->belongsTo(SocialAssistance::class);
    }

    public function headOfFamily()
    {
        return $this->belongsTo(HeadOfFamily::class);
    }
}
