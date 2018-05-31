<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $dates = [
        'date',
        'created_at',
        'updated_at'
    ];

    public function typeO()
    {
        return $this->hasOne(ExpenseType::class, 'id', 'type');
    }
}
