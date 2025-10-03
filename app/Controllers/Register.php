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
     * Show register form
     */
    public function index()
    {
        $data = [
            'action'     => base_url('registerPost'),
            'buttonText' => 'Register',
            'title'      => 'Register',
            'layout'     => null,
        ];

        return view('register', $data);
    }

    /**
     * Handle register form submit
     */
    public function registerPost()
    {
        $model = new UserModel();

        // Validation rules
        $rules = [
            'username'    => 'required|min_length[3]|max_length[20]',
            'email'       => 'required|valid_email|is_unique[users.email]',
            'password'    => 'required|min_length[6]',
            'full_name'   => 'required',
            'phone'       => 'required',
            'age'         => 'required|integer',
            'gender'      => 'required',
            'address'     => 'required',
            'profile_pic' => 'uploaded[profile_pic]|is_image[profile_pic]|max_size[profile_pic,2048]',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // File upload
        $img = $this->request->getFile('profile_pic');
        $imgName = null;
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $imgName = $img->getRandomName();
            $img->move(FCPATH . 'uploads', $imgName);
        }

        // Hash password
        $hashedPassword = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        // Prepare data
        $data = [
            'username'     => $this->request->getPost('username'),
            'email'        => $this->request->getPost('email'),
            'password_hash'=> $hashedPassword,
            'full_name'    => $this->request->getPost('full_name'),
            'phone'        => $this->request->getPost('phone'),
            'age'          => $this->request->getPost('age'),
            'gender'       => $this->request->getPost('gender'),
            'address'      => $this->request->getPost('address'),
            'profile_pic'  => $imgName,
        ];

        // Save
        $model->save($data);

        return redirect()->to(base_url('login'))->with('success', 'Registration successful. Please login.');
    }
}
