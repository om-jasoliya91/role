<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function homeView()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }
        return view('home');
    }

    public function authenticate()
    {
        $session = session();
        $model = new UserModel();

        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password_hash'])) {
            $session->set([
                'user_id' => $user['id'],
                'user_name' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role'],  // ✅ role stored in session
                'isLoggedIn' => true
            ]);

            // ✅ Redirect based on role
            if ($user['role'] === '0') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/student/home');
            }
        }

        return redirect()->back()->with('error', 'Invalid Email or Password');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

   // Show forgot password form
public function forgotPasswordForm()
{
    return view('forgotPassword');
}

// Handle sending reset link
public function sendResetLink()
{
    $email = $this->request->getPost('email');
    $userModel = new UserModel();
    $user = $userModel->where('email', $email)->first();

    if (!$user) {
        return redirect()->back()->with('error', 'Email not found!');
    }

    // ✅ Instead of token, just send reset page with user id
    $resetLink = base_url("reset-password/{$user['id']}");

    // Send email
    $emailService = \Config\Services::email();
    $emailService->setTo($email);
    $emailService->setFrom('your_email@example.com', 'My App');
    $emailService->setSubject('Password Reset Request');
    $emailService->setMessage("Click this link to reset your password: <a href='{$resetLink}'>Reset Password</a>");

    if ($emailService->send()) {
        return redirect()->back()->with('success', 'Password reset link sent to your email!');
    } else {
        return redirect()->back()->with('error', 'Failed to send email.');
    }
}

// Show reset form (no token)
public function resetPassword($id)
{
    return view('reset_password', ['id' => $id]);
}

// Update password (no token check)
public function updatePassword($id)
{
    $rules = [
        'password'         => 'required|min_length[6]',
        'confirm_password' => 'matches[password]'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->with('errors', $this->validator->getErrors());
    }

    $newPassword = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

    $userModel = new UserModel();
    $userModel->update($id, ['password_hash' => $newPassword]);

    return redirect()->to('/login')->with('success', 'Password updated successfully! You can now log in.');
}
}