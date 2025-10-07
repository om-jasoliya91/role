<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\EnrollmentModel;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class Student extends BaseController
{
    public function view()
    {
        $session = session();

        //  Check if logged in AND role is student (assume role `1` is student)
        if (!$session->get('isLoggedIn') || (int) $session->get('role') !== 1) {
            return redirect()->to('/login')->with('error', 'You must be logged in as a student.');
        }
        // echo '<pre>';
        // print_r(session()->get('role'));
        // echo '</pre>';
        // exit;
        return view('student/home');
    }

    public function profile()
    {
        $session = session();

        // Check login and role (role = 1 means student)
        if (!$session->get('isLoggedIn') || (int) $session->get('role') !== 1) {
            return redirect()->to(base_url('login'));
        }

        $userModel = new UserModel();
        $userId = $session->get('user_id');
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        return view('student/profile', [
            'title' => 'My Profile',
            'user' => $user
        ]);
    }

    // Show the update profile form
    public function updateView()
    {
        $session = session();

        if (!$session->get('isLoggedIn') || (int) $session->get('role') !== 1) {
            return redirect()->to(base_url('login'));
        }

        $userModel = new UserModel();
        $userId = $session->get('user_id');
        $user = $userModel->find($userId);
        // echo '<pre>';
        // print_r($user);
        // echo '</pre>';
        // exit;

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        return view('student/studentupdate', [
            'title' => 'Update Profile',
            'full_name' => $user['full_name'],
            'email' => $user['email'],
            'phone' => $user['phone'],
            'age' => $user['age'],
            'gender' => $user['gender'],
            'address' => $user['address'],
        ]);
    }

    // Handle the form submission to update profile
    public function updateProfile()
    {
        $session = session();

        if (!$session->get('isLoggedIn') || (int) $session->get('role') !== 1) {
            return redirect()->to(base_url('login'));
        }

        $userModel = new UserModel();
        $userId = $session->get('user_id');

        $rules = [
            'full_name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'phone' => 'required',
            'age' => 'required|integer|greater_than[0]|less_than[150]',
            'gender' => 'required|in_list[male,female,other]',
            'address' => 'required|min_length[5]',
            'profile_pic' => 'permit_empty|is_image[profile_pic]|max_size[profile_pic,2048]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'age' => $this->request->getPost('age'),
            'gender' => $this->request->getPost('gender'),
            'address' => $this->request->getPost('address'),
        ];

        $file = $this->request->getFile('profile_pic');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $newName);

            $user = $userModel->find($userId);

            if (!empty($user['profile_pic'])) {
                $oldImagePath = FCPATH . 'uploads/' . $user['profile_pic'];
                if (file_exists($oldImagePath)) {
                    if (!@unlink($oldImagePath)) {
                        log_message('error', 'Failed to delete old profile pic: ' . $oldImagePath);
                    }
                }
            }

            $data['profile_pic'] = $newName;
        }

        $userModel->update($userId, $data);

        return redirect()->to(base_url('student/profile'))->with('success', 'Profile updated successfully.');
    }

    public function dashboard()
    {
        $session = session();

        if (!$session->get('isLoggedIn') || (int) $session->get('role') !== 1) {
            return redirect()->to('/login')->with('error', 'You must be logged in as a student.');
        }

        $courseModel = new CourseModel();
        $courses = $courseModel->findAll();

        return view('student/course', ['courses' => $courses]);
    }

    public function course()
    {
        $session = session();

        if (!$session->get('isLoggedIn') || $session->get('role') != 1) {
            return redirect()->to('/login')->with('error', 'Please login as a student.');
        }

        $userId = $session->get('user_id');

        $courseModel = new CourseModel();
        $enrollModel = new EnrollmentModel();

        $courses = $courseModel->findAll();
        // echo "<pre>";
        // print_r($courses);
        // echo "</pre>";
        // exit;
        // Get course IDs the user is already enrolled in
        $enrolledCourses = $enrollModel
            ->select('c_id')
            ->where('u_id', $userId)
            ->findAll();

        $enrolledCourseIds = array_column($enrolledCourses, 'c_id');

        return view('student/course', [
            'courses' => $courses,
            'enrolledCourseIds' => $enrolledCourseIds
        ]);
    }

    public function enroll($c_id)
    {
        $session = session();

        if (!$session->get('isLoggedIn') || (int) $session->get('role') !== 1) {
            return redirect()->to('/login')->with('error', 'You must be logged in as a student.');
        }

        $userId = $session->get('user_id');  // this must be a valid user id in DB
        //    echo '<pre>';
        //     print_r(session()->get($session->get('user_id')));
        //     echo '</pre>';
        //     exit;
        // Validate course
        $courseModel = new CourseModel();
        $course = $courseModel->find($c_id);
        // echo '<pre>';
        // print_r(session()->get($course));
        // echo '</pre>';
        // exit;
        if (!$course || strtolower($course['status']) !== 'active') {
            return redirect()->back()->withInput()->with('error', 'Course not found or inactive.');
        }

        // Check if already enrolled
        $enrollModel = new EnrollmentModel();
        $existing = $enrollModel
            ->where('u_id', $userId)
            ->where('c_id', $c_id)
            ->first();

        if ($existing) {
            return redirect()->back()->with('info', 'You are already enrolled in this course.');
        }
        log_message('debug', 'Inserting enrollment for user_id: ' . $userId . ', course_id: ' . $c_id);

        // Insert enrollment
        $enrollModel->insert([
            'u_id' => $userId,
            'c_id' => $c_id,
            'course_name' => $course['course_name'],
            'course_code' => $course['course_code'],
            'duration' => $course['duration'],
            'price' => $course['price'],
            'e_date' => Time::now()->toDateTimeString()
        ]);

        return redirect()->to('/student/course')->with('success', 'Successfully enrolled in the course!');
    }

    public function enrollView()
    {
        $session = session();

        if (!$session->get('isLoggedIn') || (int) $session->get('role') !== 1) {
            return redirect()->to('/login')->with('error', 'Please login as a student to view this page.');
        }

        $userId = $session->get('user_id');
        log_message('debug', 'Logged in user ID: ' . $userId);

        $enrollModel = new \App\Models\EnrollmentModel();
        $enrollments = $enrollModel->where('u_id', $userId)->findAll();

        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($userId);

        return view('student/enroll', [
            'enrollments' => $enrollments,
            'user' => $user,
        ]);
    }

    public function export()
    {
        $session = session();

        if (!$session->get('isLoggedIn') || (int) $session->get('role') !== 1) {
            return redirect()->to('/login')->with('error', 'Please login as a student to view this page.');
        }

        $userId = $session->get('user_id');
        $enrollModel = new \App\Models\EnrollmentModel();
        $enrollments = $enrollModel->getEnrollmentsWithCourse($userId);

        if (empty($enrollments)) {
            return redirect()->back()->with('error', 'No enrollments found.');
        }

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="enrollments.csv"');

        $file = fopen('php://output', 'w');
        fputcsv($file, ['Course Name', 'Course Code', 'Duration', 'Price', 'Enrollment Date']);

        foreach ($enrollments as $enroll) {
            fputcsv($file, [
                $enroll['course_name'],
                $enroll['course_code'],
                $enroll['duration'],
                $enroll['price'],
                date('d M Y', strtotime($enroll['e_date']))
            ]);
        }

        fclose($file);
        exit;
    }
}
