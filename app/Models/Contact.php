<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'organisation',
        'enquiry_type',
        'message',
        'is_responded',
        'responded_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_responded' => 'boolean',
            'responded_at' => 'datetime',
        ];
    }

    /**
     * Scope a query to only include unresponded contacts.
     */
    public function scopeUnresponded($query)
    {
        return $query->where('is_responded', false);
    }

    /**
     * Scope a query to only include responded contacts.
     */
    public function scopeResponded($query)
    {
        return $query->where('is_responded', true);
    }
}
