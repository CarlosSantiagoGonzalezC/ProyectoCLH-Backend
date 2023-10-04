<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use SoftDeletes, HasFactory;

    public function orders(){
        return $this->belongsTo(Order::class);
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
