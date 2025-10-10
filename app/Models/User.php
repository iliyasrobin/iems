<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    
    /**
     * Get all gate passes created by this user
     */
    public function gatePasses()
    {
        return $this->hasMany(GatePass::class);
    }
    
    /**
     * Get all gate passes approved/declined by this user (as admin)
     */
    public function approvedGatePasses()
    {
        return $this->hasMany(GatePass::class, 'approved_by');
    }
    
    /**
     * Get all requisitions created by this user
     */
    public function requisitions()
    {
        return $this->hasMany(Requisition::class);
    }
    
    /**
     * Get all requisitions approved/declined by this user (as admin)
     */
    public function approvedRequisitions()
    {
        return $this->hasMany(Requisition::class, 'approved_by');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }
}
