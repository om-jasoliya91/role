<?php
namespace App\Models;

use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table = 'enrollment';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'u_id', 'c_id', 'course_name', 'course_code', 'duration', 'price', 'e_date'
    ];

    public function getEnrollmentsWithCourse($userId)
    {
        return $this
            ->select('enrollment.*, courses.course_name, courses.course_code, courses.duration, courses.price')
            ->join('courses', 'courses.id = enrollment.c_id')
            ->where('enrollment.u_id', $userId)
            ->findAll();
    }
}
