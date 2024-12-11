<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SigningOffice extends Model
{
    /** @use HasFactory<\Database\Factories\SigningOfficeFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'office_id';

    public function payments(): HasMany
    {
        return $this->hasMany(Payments::class);
    }

    public function clearances(): BelongsToMany
    {
        return $this->belongsToMany(Clearance::class);
    }

    public function requirements(): HasMany
    {
        return $this->hasMany(Requirement::class, 'office_id', 'office_id');
    }

    public function queues()
    {
        return $this->hasMany(Queue::class, 'signing_office_id');
    }
}
