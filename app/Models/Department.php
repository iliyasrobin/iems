<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    /**
     * Get the equipment items for the department.
     */
    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }
}
