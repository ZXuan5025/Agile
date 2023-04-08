<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    public $timestamps = false;
    protected $table = 'enrollments';
    protected $fillable = [
        'id',
        'sID',
        'cID',
    ];
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sID');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'cID');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payments::class, 'eID');
    }

    public function getCourseDetailsByCourseId($enrollment_id)
    {
        // if using get(), is returning an array.
        return $this->with('course')->where('id', $enrollment_id)->get();
    }

    public function getStudentUnpaidEnrolmentByStudentId($id)
    {
        return $this->where('sID', $id)->where('is_paid', 0)->get();
    }

    public function updateIdPaid($id)
    {
        return $this->where('id', $id)->update(['is_paid' => 1]);
    }

    public function getPaidEnrollmentByStudentId($id)
    {
        return $this->where('sID', $id)->where('is_paid', 1)->get();
    }

}
