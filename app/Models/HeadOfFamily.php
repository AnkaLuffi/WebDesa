<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeadOfFamily extends Model
{
    use SoftDeletes, UUID;

    protected $fillable = [
        'user_id',
        'profile_picture',
        'identify_number',
        'gender',
        'date_of_birth',
        'occupation',
        'marital_status',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function familyMembers()
    {
        return $this->hasMany(FamilyMembers::class);
    }

    public function socialAssitanceRecepients()
    {
        return $this->hasMany(SocialAssistanceRecipient::class);
    }

    public function evemtParticipants()
    {
        return $this->hasMany(EventParticipant::class);
    }
}
