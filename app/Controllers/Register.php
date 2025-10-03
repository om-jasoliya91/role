<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Register extends Controller
{
    public function __construct()
    {
        helper(['form', 'url']);
    }

    /**
     * Show Add Student form (admin)
     */
    public function stdAdd()
    {
        $data = [
            'action' => base_url('admin/stdAddPost'),  // POST URL for admin student add
            'buttonText' => 'Add Student',
            'title' => 'Add Student (Admin)',
            'layout' => 'layouts/admin',  // Admin layout file
        ];

        return view('register', $data);
    }

    /**
     * Show Register form for public users
     */
    public function register()
    {
        $data = [
            'action' => base_url('registerPost'),  // POST URL for public registration
            'buttonText' => 'Register',
            'title' => 'Register',
            'layout' => null,  // No layout, standalone view
        ];

        return view('register', $data);
    }

    /**
     * Handle POST request: Admin adding student
     */
    public function stdAddPost()
    {
        return $this->saveUser('admin/stdView', 'Student added successfully.');
    }

    /**
     * Handle POST request: Public registration
     */
    public function registerPost()
    {
        return $this->saveUser('login', 'Registration successful. Please login.');
    }

    /**
     * Common method for saving user data (both admin add and public registration)
     *
     * @param string $redirectUrl URL segment to redirect after successful save
     * @param string $successMessage Message to show on successful save
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    private function saveUser(string $redirectUrl, string $successMessage)
    {
        $model = new UserModel();

        // Validation rules
        $rules = [
            'username' => 'required|min_length[3]|max_length[20]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'full_name' => 'required',
            'phone' => 'required',  
            'age' => 'required|integer',
            'gender' => 'required',
            'address' => 'required',
            'profile_pic' => 'uploaded[profile_pic]|is_image[profile_pic]|max_size[profile_pic,2048]',
        ];

        if (!$this->validate($rules)) {
            // Redirect back with errors and input data
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Validation failed.')
                ->with('errors', $this->validator->getErrors());
        }

        // Handle file upload
        $img = $this->request->getFile('profile_pic');
        $imgName = null;

        if ($img && $img->isValid() && !$img->hasMoved()) {
            $imgName = $img->getRandomName();
            $img->move(FCPATH . 'uploads', $imgName);
        }

        // Hash password securely
        $hashedPassword = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        // Prepare data array for saving to DB
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password_hash' => $hashedPassword,
            'full_name' => $this->request->getPost('full_name'),
            'phone' => $this->request->getPost('phone'),
            'age' => $this->request->getPost('age'),
            'gender' => $this->request->getPost('gender'),
            'address' => $this->request->getPost('address'),
            'profile_pic' => $imgName,
        ];

        // Save the user record (insert or update)
        $model->save($data);

        // Redirect with success message
        return redirect()->to(base_url($redirectUrl))->with('success', $successMessage);
    }
}
