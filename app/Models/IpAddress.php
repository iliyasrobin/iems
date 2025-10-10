<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IpAddress extends Model
{
    protected $fillable = [
        'ip_address',
        'subnet_mask',
        'gateway',
        'dns',
        'department_id',
        'location',
        'device_name',
        'mac_address',
        'status',
        'description',
        'assigned_to',
        'assigned_date',
    ];
    
    protected $casts = [
        'assigned_date' => 'date',
    ];
    
    /**
     * Get the department that this IP address belongs to.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
