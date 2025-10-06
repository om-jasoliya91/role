<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\EnrollmentModel;
use App\Models\UserModel;

class ChartController extends BaseController
{
    public function index()
    {
        return view('charts/index');
    }

    public function getChartData()
    {
        $db = \Config\Database::connect();

        // Users registered per month
        $userData = $db->query("
            SELECT DATE_FORMAT(created_at, '%Y-%m') AS month, COUNT(*) as total
            FROM users
            GROUP BY month
        ")->getResult();

        // Enrollments per course
        $enrollmentData = $db->query('
            SELECT c.course_name, COUNT(e.id) AS total_enrollments
            FROM enrollment e
            JOIN courses c ON c.id = e.c_id
            GROUP BY e.c_id;')->getResult();

        // Gender distribution
        $genderData = $db->query('
            SELECT gender, COUNT(*) as total
            FROM users
            GROUP BY gender
        ')->getResult();

        return $this->response->setJSON([
            'usersPerMonth' => $userData,
            'enrollmentsPerCourse' => $enrollmentData,
            'genderDistribution' => $genderData,
        ]);
    }
}
