<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes, HasFactory;

    public function purchases() {
        return $this->hasMany(Purchase::class);
    }

    protected $hidden = [
        'deleted_at',
        'updated_at',
    ];
}
