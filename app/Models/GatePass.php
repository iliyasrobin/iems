<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GatePass extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'item_name',
        'description',
        'purpose',
        'expected_return_date',
        'status',
        'remarks',
        'approved_by',
        'action_date',
    ];
    
    protected $casts = [
        'expected_return_date' => 'datetime',
        'action_date' => 'datetime',
    ];
    
    /**
     * Get the user who created this gate pass
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the admin who approved/declined this gate pass
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    
    /**
     * Scope for pending gate passes
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    
    /**
     * Scope for approved gate passes
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
    
    /**
     * Scope for declined gate passes
     */
    public function scopeDeclined($query)
    {
        return $query->where('status', 'declined');
    }
}
