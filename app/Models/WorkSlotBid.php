<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class WorkSlotBid extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'cafe_id',
        'work_slot_id',
        'user_id',
        'status',
        'remarks',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}