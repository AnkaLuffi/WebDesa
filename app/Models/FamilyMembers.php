<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilyMembers extends Model
{
    use SoftDeletes, UUID;

    protected $fillable = [
        'head_of_family',
        'profile_picture',
        'identify_number',
        'gender',
        'date_of_birth',
        'occupation',
        'marital_status', 
    ];

    public function headOfFamily()
    {
        return $this->belongsTo(HeadOfFamily::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
