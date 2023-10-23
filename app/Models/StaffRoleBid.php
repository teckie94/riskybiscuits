<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\HasOne;

class StaffRoleBid extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'staff_role_id',
        'user_id',
        'status'
    ];

    //One to One Relationships
    public function user(): HasOne {
        return $this->hasOne(User::class);
    }

    //One To Many (Inverse) / Belongs To Relationship
    public function staffRole(): BelongsTo {
        return $this->belongsTo(StaffRole::class);
    }
    public function workSlot(): BelongsTo {
        return $this->belongsTo(workSlot::class);
    }
}