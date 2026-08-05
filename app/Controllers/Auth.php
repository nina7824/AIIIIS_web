<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        // If already logged in, redirect to dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin/dashboard');
        }

        $data = [
            'title' => 'Sign In — AIIIIS'
        ];

        return view('auth/login', $data);
    }

   public function authenticate()
{
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');
    $remember = $this->request->getPost('remember');

    $userModel = new UserModel();
    $user = $userModel->where('email', $email)->first();

    if ($user && password_verify($password, $user['password'])) {
        // Check if user is active
        if (!$user['is_active']) {
            return redirect()->back()
                ->with('error', 'Your account is deactivated. Please contact support.')
                ->withInput();
        }

        // Set session data
        $sessionData = [
            'user_id' => $user['user_id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'phone' => $user['phone'],
            'isLoggedIn' => true
        ];

        session()->set($sessionData);

        // Update last login
        $userModel->update($user['user_id'], ['last_login' => date('Y-m-d H:i:s')]);

        // Redirect based on role
        $roleRedirects = [
            'administrator' => '/dashboard',
            'nirda_expert' => '/dashboard',
            'enterprise' => '/dashboard',
            'investor' => '/dashboard',
            'government' => '/dashboard',
            'analyst' => '/dashboard'
        ];

        return redirect()->to($roleRedirects[$user['role']] ?? '/dashboard')
            ->with('success', 'Welcome back, ' . $user['name'] . '!');
    }

    return redirect()->back()
        ->with('error', 'Invalid email or password')
        ->withInput();
}

    public function logout()
    {
        // Clear session
        session()->destroy();

        return redirect()->to('/login')->with('success', 'You have been logged out successfully.');
    }

    public function register()
    {
        // If already logged in, redirect to dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        $data = [
            'title' => 'Create Account — AIIIIS'
        ];

        return view('auth/register', $data);
    }

    public function createAccount()
    {
        $userModel = new UserModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role') ?? 'enterprise',
            'is_active' => 1
        ];

        // Validate
        if ($userModel->save($data)) {
            return redirect()->to('/login')->with('success', 'Account created successfully! Please login.');
        }

        return redirect()->back()
            ->with('errors', $userModel->errors())
            ->withInput();
    }
}