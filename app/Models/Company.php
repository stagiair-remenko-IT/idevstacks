<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'notes',
        'website',
    ];

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
