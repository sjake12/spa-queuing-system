<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $fillable = ['student_id', 'signing_office_id', 'status'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    public function signingOffice()
    {
        return $this->belongsTo(SigningOffice::class, 'signing_office_id', 'office_id');
    }
}
