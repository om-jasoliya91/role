<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Login extends Controller
{
    public function index()
    {
        helper('form');
        return view('login');
    }

    public function authenticate()
    {
        helper('form');
        $session = session();
        $model = new UserModel();

        $username_email = trim($this->request->getPost('username_email'));
        $password = trim($this->request->getPost('password'));

        $user = $model
            ->where('username', $username_email)
            ->orWhere('email', $username_email)
            ->first();

        if ($user && password_verify($password, $user['password_hash'])) {
            $session->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'isLoggedIn' => true,
            ]);

            return redirect()->to(
                $user['role'] == 1 ? 'student/home' : 'admin/dashboard'
            );
        } else {
            return redirect()->back()->with('error', 'Invalid username/email or password.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function forgotPasswordForm()
    {
        helper('form');
        return view('forgotPassword');
    }

    // Handle forgot password request
    public function sendResetLink()
    {
        $email = $this->request->getPost('email');
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email not found!');
        }

        $token = bin2hex(random_bytes(32));
        session()->set('reset_token_' . $user['id'], $token);

        $resetLink = base_url('reset-password/' . $user['id'] . '/' . $token);
        return redirect()->back()->with('success', 'Reset link: ' . $resetLink);
    }
}
