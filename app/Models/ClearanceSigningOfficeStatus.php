<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClearanceSigningOfficeStatus extends Model
{
    protected $guarded = [];

    public function clearance(): BelongsTo
    {
        return $this->belongsTo(Clearance::class, 'clearance_id', 'clearance_id');
    }

    public function signingOffice(): BelongsTo
    {
        return $this->belongsTo(SigningOffice::class, 'signing_office_id', 'office_id');
    }
}
