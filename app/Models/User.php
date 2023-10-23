<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile_number',
        'role_id',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    //One To One Relationship
    //Staff can bid for only one staff roles
    public function staffRoleBid(): HasOne {
        return $this->hasOne(StaffRoleBid::class);
    }

    //One To Many (Inverse) / Belongs To Relationship
    //Staff belongs to only one staff role
    // public function staffRole(): BelongsTo {
    //     return $this->belongsTo(StaffRole::class);
    // }

    //One to Many Relationship
    //Owner can create multiple work slots
    public function workSlot(): HasMany {
        return $this->hasMany(WorkSlot::class);
    }
    //Owner can create multiple staff roles
    public function staffRoles(): HasMany {
        return $this->hasMany(WorkSlot::class);
    }

    //Staff can bid for multiple work slots
    public function workSlotBid(): HasMany {
        return $this->hasMany(WorkSlotBid::class);
    }


    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }


}
