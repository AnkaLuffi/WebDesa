<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilyMember extends Model
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
        'relation'
    ];

    public function scopeSearch($query, $search)
    {
        return $query->whereHas('user', function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        })->orWhere('phone_number', 'like', "%$search%")
            ->orWhere('identify_number', 'like', "%$search%");
    }

    public function headOfFamily()
    {
        return $this->belongsTo(HeadOfFamily::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
