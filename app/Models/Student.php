<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Traits\HasRoles;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;
    use HasRoles;

    protected $guarded = [];
    protected $primaryKey = 'student_id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guard_name = 'web';

    protected static function boot(): void
    {
        parent::boot();

        static::created(function ($student) {
            User::create([
                'username' => $student->student_id,
                'password' => bcrypt('1234'),
            ]);
        });
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'username', 'student_id');
    }

    public function clearance(): HasOne
    {
        return $this->hasOne(Clearance::class, 'student_id', 'student_id');
    }

    public function rolesWithoutTeam(): MorphToMany
    {
        return $this->morphToMany(
          config('permission.models.role'),
          'model',
          config('permission.table_names.model_has_roles'),
          config('permission.column_names.model_morph_key'),
          app(PermissionRegistrar::class)->pivotRole
        );
    }

    public function team(): BelongsToMany
    {
        return $this->belongsToMany(SigningOffice::class, config('permission.table_names.model_has_roles'), 'model_id', 'office_id');
    }

    public function currentTeam(): BelongsTo
    {
        return $this->belongsTo(SigningOffice::class, 'current_team_id', 'office_id');
    }

    public function belongsToTeam(SigningOffice $signingOffice): bool
    {
        return $this->teams->contains(fn ($t) => $t->id === $signingOffice->office_id);
    }
}
