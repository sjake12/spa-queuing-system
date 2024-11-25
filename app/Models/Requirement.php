<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Requirement extends Model
{
    /** @use HasFactory<\Database\Factories\RequirementFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'requirement_id';

    public function signingOffice(): BelongsTo
    {
        return $this->belongsTo(SigningOffice::class, 'office_id', 'office_id');
    }
}
