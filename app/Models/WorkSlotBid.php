<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class WorkSlotBid extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'work_slot_id',
        'user_id',
        'status',
    ];
    //One To Many (inverse) / Belongs To Relationship

    //Each Work Slot Bid belongs to One User
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Each Work Slot Bid is for one Work Slot
    public function workSlot(): BelongsTo
    {
        return $this->belongsTo(WorkSlotBid::class);
    }
}