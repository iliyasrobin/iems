<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'equipments';
    
    
    protected $fillable = [
        'name',
        'category',
        'serial_number',
        'department_id',
        'assigned_to',
        'purchase_date',
        'purchase_price',
        'chalan_number',
        'chalan_image',
        'description',
        'manufacturer',
        'model',
        'status',
        'warranty_expiry',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'purchase_price' => 'decimal:2',
        'warranty_expiry' => 'date',
    ];

    /**
     * Get the department that owns the equipment.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
