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
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'user_id'   => $user['id'],
                'user_name' => $user['name'],
                'email'     => $user['email'],
                'isLoggedIn'=> true
            ]);
            return redirect()->to('home');
        }

        return redirect()->back()->with('error', 'Invalid Email or Password');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    // ========================= Forgot Password Flow =========================

    public function forgotPasswordForm()
    {
        return view('forgotPassword');
    }

    public function sendResetLink()
    {
        $email = $this->request->getPost('email');
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email not found!');
        }

        $token = bin2hex(random_bytes(16));
        session()->set('reset_token_' . $user['id'], $token);

        $resetLink = base_url("reset-password/{$user['id']}/{$token}");

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

    public function resetPassword($id, $token)
    {
        $savedToken = session()->get('reset_token_' . $id);
        if (!$savedToken || $savedToken !== $token) {
            return redirect()->to('/login')->with('error', 'Invalid or expired reset link.');
        }

        return view('reset_password', ['id' => $id, 'token' => $token]);
    }

    public function updatePassword($id, $token)
    {
        $savedToken = session()->get('reset_token_' . $id);
        if (!$savedToken || $savedToken !== $token) {
            return redirect()->to('/login')->with('error', 'Invalid or expired reset link.');
        }

        $rules = [
            'password' => 'required|min_length[6]',
            'confirm_password' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $newPassword = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $userModel = new UserModel();
        $userModel->update($id, ['password' => $newPassword]);

        session()->remove('reset_token_' . $id);

        return redirect()->to('/login')->with('success', 'Password updated successfully! You can now log in.');
    }
}
