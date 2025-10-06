<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Exceptions\StudentNotFoundException;
use App\Models\CourseModel;
use App\Models\EnrollmentModel;
use App\Models\UserModel;
use Exception;

class Admin extends BaseController
{
    public function stdHome()
    {
        return view('admin/dashboard');
    }

    public function stdView()
    {
        // Ensure admin is logged in
        $session = session();
        if (!$session->get('isLoggedIn') || (int) $session->get('role') !== 0) {
            return redirect()->to(base_url('login'))->with('error', 'Unauthorized access');
        }

        $userModel = new UserModel();

        // Get search term from query string
        $search = $this->request->getGet('search');

        // Base query for students (role = 1)
        $query = $userModel->where('role', 1);

        if (!empty($search)) {
            $query = $query
                ->groupStart()
                ->like('full_name', $search)
                ->orLike('email', $search)
                ->orLike('phone', $search)
                ->groupEnd();
        }

        // Paginate results (5 per page)
        $students = $query->paginate(5);
        $pager = $userModel->pager;

        return view('admin/stdView', [
            'title' => 'Student List',
            'students' => $students,
            'pager' => $pager,
            'search' => $search
        ]);
    }

    public function edit($id)
    {
        $session = session();
        if (!$session->get('isLoggedIn') || (int) $session->get('role') !== 0) {
            return redirect()->to(base_url('login'))->with('error', 'Unauthorized access');
        }

        $userModel = new UserModel();
        $student = $userModel->find($id);

        if (!$student || $student['role'] != 1) {
            return redirect()->to(base_url('admin/stdView'))->with('error', 'Student not found');
        }

        return view('admin/edit', [
            'title' => 'Edit Student',
            'student' => $student
        ]);
    }

    public function update($id)
    {
        $session = session();
        if (!$session->get('isLoggedIn') || (int) $session->get('role') !== 0) {
            return redirect()->to(base_url('login'))->with('error', 'Unauthorized access');
        }

        $userModel = new UserModel();
        $student = $userModel->find($id);

        if (!$student || $student['role'] != 1) {
            return redirect()->to(base_url('admin/stdView'))->with('error', 'Student not found');
        }

        // Validation rules
        $rules = [
            'username' => 'required|min_length[3]|max_length[50]',
            'email' => 'required|valid_email',
            'full_name' => 'required|min_length[3]',
            'phone' => 'required',
            'age' => 'required|integer',
            'gender' => 'required|in_list[male,female,other]',
            'address' => 'required',
            'profile_pic' => 'max_size[profile_pic,2048]|is_image[profile_pic]|mime_in[profile_pic,image/jpg,image/jpeg,image/png,image/gif]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'full_name' => $this->request->getPost('full_name'),
            'phone' => $this->request->getPost('phone'),
            'age' => $this->request->getPost('age'),
            'gender' => $this->request->getPost('gender'),
            'address' => $this->request->getPost('address'),
        ];

        // Handle profile pic upload if exists
        $file = $this->request->getFile('profile_pic');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Delete old image if exists
            if (!empty($student['profile_pic']) && file_exists(FCPATH . 'uploads/' . $student['profile_pic'])) {
                unlink(FCPATH . 'uploads/' . $student['profile_pic']);
            }

            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $newName);
            $data['profile_pic'] = $newName;
        }

        $userModel->update($id, $data);

        return redirect()->to(base_url('admin/stdView'))->with('success', 'Student updated successfully.');
    }

    public function delete($id)
    {
        $userModel = new UserModel();

        $user = $userModel->find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $profilePic = $user['profile_pic'];
        $uploadPath = WRITEPATH . 'uploads/profile_pics/';

        if ($userModel->delete($id)) {
            if ($profilePic && file_exists($uploadPath . $profilePic)) {
                unlink($uploadPath . $profilePic);
            }
            return redirect()->to('admin/stdView')->with('success', 'User deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Unable to delete user.');
        }
    }

    public function courseView()
    {
        // Optional: Admin login/session check here
        return view('admin/courseAdd');
    }

    public function courseStore()
    {
        $session = session();
        if (!$session->get('isLoggedIn') || (int) $session->get('role') !== 0) {
            return redirect()->to(base_url('login'))->with('error', 'Unauthorized access');
        }
        $courseModel = new CourseModel();

        $validation = \Config\Services::validation();
        $rules = [
            'course_name' => 'required|min_length[3]',
            'course_code' => 'required|is_unique[courses.course_code]',
            'duration' => 'required',
            'price' => 'required|decimal',
            'status' => 'required|in_list[active,inactive]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'course_name' => $this->request->getPost('course_name'),
            'course_code' => $this->request->getPost('course_code'),
            'duration' => $this->request->getPost('duration'),
            'price' => $this->request->getPost('price'),
            'status' => $this->request->getPost('status'),
        ];

        $courseModel->save($data);

        return redirect()->to(base_url('admin/courseView'))->with('success', 'Course added successfully.');
    }

    public function courseList()
    {
        $session = session();

        // Optional: check if user is logged in (adjust as per your app)
        if (!$session->get('isLoggedIn') || (int) $session->get('role') !== 0) {
            return redirect()->to(base_url('login'))->with('error', 'Unauthorized access');
        }

        $courseModel = new CourseModel();

        // Get current page number from query string (default 1)
        $page = $this->request->getVar('page_courses') ?? 1;

        // Paginate 5 courses per page, group name 'courses'
        $courses = $courseModel->paginate(5);
        $pager = $courseModel->pager;

        return view('admin/courseView', [
            'courses' => $courses,
            'pager' => $pager,
            'page' => $page,
        ]);
    }

    public function adminEnrollView()
    {
        $session = session();

        if (!$session->get('isLoggedIn') || (int) $session->get('role') !== 0) {
            return redirect()->to('/login')->with('error', 'Please login as admin to view this page.');
        }

        $enrollModel = new \App\Models\EnrollmentModel();

        $builder = $enrollModel->builder();
        $builder
            ->select('enrollment.u_id, users.username, courses.course_name, courses.duration, courses.price')
            ->join('users', 'enrollment.u_id = users.id')
            ->join('courses', 'enrollment.c_id = courses.id')
            ->orderBy('users.username', 'ASC')
            ->orderBy('courses.course_name', 'ASC');

        $enrollments = $builder->get()->getResultArray();

        // Group by user directly here (simple)
        $groupedEnrollments = [];
        foreach ($enrollments as $enroll) {
            $userId = $enroll['u_id'];

            if (!isset($groupedEnrollments[$userId])) {
                $groupedEnrollments[$userId] = [
                    'user' => ['id' => $userId, 'name' => $enroll['username']],
                    'courses' => [],
                ];
            }

            $groupedEnrollments[$userId]['courses'][] = [
                'course_name' => $enroll['course_name'],
                'duration' => $enroll['duration'],
                'price' => $enroll['price'],
            ];
        }

        return view('admin/enrollView', ['groupedEnrollments' => $groupedEnrollments]);
    }

    public function dashboardView()
    {
        $userModel = new UserModel();
        $courseModel = new CourseModel();
        $enrollModel = new EnrollmentModel();

        $totalUsers = $userModel->where('role', 1)->countAllResults();
        $totalCourses = $courseModel->countAllResults();
        $totalEnroll = $enrollModel->countAllResults();

        return view('admin/dashboard', compact('totalUsers', 'totalCourses', 'totalEnroll'));
    }

    public function showStudent($id)
    {
        $studentModel = new UserModel();

        try {
            $student = $studentModel->find($id);

            if (!$student || $student['role'] != 1) {
                throw new StudentNotFoundException('Student not found.');
            }
            return view('admin/student_detail', [
                'title' => 'Student Details',
                'student' => $student
            ]);
        } catch (StudentNotFoundException $e) {
            return redirect()->to(base_url('admin/stdView'))->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->to(base_url('admin/stdView'))->with('error', 'An unexpected error occurred.');
        }
    }
}
