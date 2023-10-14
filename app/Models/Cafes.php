<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Cafes extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'student_number',
        'batch_number',
        'email',
        'mobile_number',
    ];


    /* public function invoices()
    {
        return $this->hasMany(Invoice::class);
    } */

    public function invoices() {
        return $this->hasMany('App\Models\Invoices', 'invoice_id')->withTrashed();;
    }

}
