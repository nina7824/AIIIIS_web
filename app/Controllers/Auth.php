<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\EnterpriseModel;
use App\Models\InvestorModel;
use CodeIgniter\Email\Email;

class Auth extends BaseController
{
    public function login()
    {
        // If already logged in, redirect to dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        $data = [
            'title' => 'Sign In — AIIIIS',
            'active_page' => 'login',
            'meta_description' => 'Sign in to your AIIIIS account to access industrial intelligence and investment opportunities.'
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

            // Get user roles
            $userRoleModel = new \App\Models\UserRoleModel();
            $roles = $userRoleModel->getRolesForUser($user['user_id']);

            // Load permissions for this user
            $permissionManager = new \App\Libraries\PermissionManager();
            $userPermissions = $permissionManager->getUserPermissions($user['user_id']);

            // Set session data
            $sessionData = [
                'user_id' => $user['user_id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
                'phone' => $user['phone'],
                'is_active' => $user['is_active'],
                'is_verified' => $user['is_verified'],
                'theme_preference' => $user['theme_preference'] ?? 'light',
                'isLoggedIn' => true,
                'roles' => $roles, // Store all roles
                'permissions' => $userPermissions // Store permissions in session
            ];

            session()->set($sessionData);

            // Update last login
            $userModel->updateLastLogin($user['user_id']);

            // ALL USERS GO TO THE SAME DASHBOARD
            return redirect()->to('/dashboard')
                ->with('success', 'Welcome back, ' . $user['name'] . '!');
        }

        return redirect()->back()
            ->with('error', 'Invalid email or password')
            ->withInput();
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'You have been logged out successfully.');
    }

    public function register()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        $data = [
            'title' => 'Create Account — AIIIIS',
            'active_page' => 'register',
            'meta_description' => 'Register as an enterprise or investor to access AI-powered matchmaking and industrial intelligence.'
        ];

        return view('auth/register', $data);
    }

    public function createAccount()
    {
        $userModel = new UserModel();
        
        // Get user type
        $userType = $this->request->getPost('user_type') ?? 'enterprise';
        
        // Validate based on user type
        $validationRules = $this->getValidationRules($userType);
        
        if (!$this->validate($validationRules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }
        
        // Check if email already exists
        $existingUser = $userModel->where('email', $this->request->getPost('email'))->first();
        if ($existingUser) {
            return redirect()->back()
                ->with('error', 'This email is already registered. Please login or use a different email.')
                ->withInput();
        }
        
        // Generate default password
        $defaultPassword = $this->generateDefaultPassword();
        
        // Prepare user data - NO VERIFICATION AND NO PASSWORD CHANGE REQUIRED
        $userData = [
            'name' => $this->request->getPost('name') ?? $this->request->getPost('enterprise_name'),
            'email' => $this->request->getPost('email'),
            'password' => $defaultPassword,
            'role' => $userType,
            'phone' => $this->request->getPost('phone') ?? $this->request->getPost('contact_info'),
            'is_active' => 1,
            'is_verified' => 1, // Auto-verified
            'verification_token' => null,
            'default_password' => null, // No need to store default password
            'must_change_password' => 0 // ← SET TO 0 (NO PASSWORD CHANGE REQUIRED)
        ];

        // Save user
        if ($userModel->save($userData)) {
            $userId = $userModel->insertID();
            
            // Save additional details based on user type
            if ($userType === 'enterprise') {
                $this->saveEnterpriseDetails($userId);
            } elseif ($userType === 'investor') {
                $this->saveInvestorDetails($userId);
            }
            
            // Optional: Send welcome email
            $this->sendWelcomeEmail($userData['email'], $userData['name'], $defaultPassword);
            
            // Redirect to register page with success modal
            return redirect()->to('/register')
                ->with('registration_success', true)
                ->with('user_email', $userData['email'])
                ->with('default_password', $defaultPassword)
                ->with('no_verification_needed', true)
                ->with('no_password_change_needed', true);
        }

        return redirect()->back()
            ->with('error', 'Failed to create account. Please try again.')
            ->withInput();
    }

    // REMOVED: verifyEmail() method
    // REMOVED: changePassword() method
    // REMOVED: updatePassword() method
    // REMOVED: resendVerification() method

    private function saveEnterpriseDetails($userId)
    {
        $enterpriseModel = new EnterpriseModel();
        
        $data = [
            'user_id' => $userId,
            'enterprise_name' => $this->request->getPost('enterprise_name'),
            'name' => $this->request->getPost('enterprise_name'),
            'sector' => $this->request->getPost('sector'),
            'location' => $this->request->getPost('location'),
            'contact_person' => $this->request->getPost('contact_person') ?? $this->request->getPost('contact_info'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone') ?? $this->request->getPost('contact_info'),
            'products_services' => $this->request->getPost('products_services'),
            'employees' => $this->request->getPost('employees'),
            'revenue' => $this->request->getPost('revenue'),
            'investment_requirements' => $this->request->getPost('investment_requirements'),
            'status' => 'pending',
            'is_verified' => 1 // Auto-verified
        ];
        
        // Optional fields
        if ($this->request->getPost('registration_number')) {
            $data['registration_number'] = $this->request->getPost('registration_number');
        }
        if ($this->request->getPost('sub_sector')) {
            $data['sub_sector'] = $this->request->getPost('sub_sector');
        }
        if ($this->request->getPost('latitude')) {
            $data['latitude'] = $this->request->getPost('latitude');
        }
        if ($this->request->getPost('longitude')) {
            $data['longitude'] = $this->request->getPost('longitude');
        }
        if ($this->request->getPost('website')) {
            $data['website'] = $this->request->getPost('website');
        }
        if ($this->request->getPost('growth_potential')) {
            $data['growth_potential'] = $this->request->getPost('growth_potential');
        }
        if ($this->request->getPost('technology_level')) {
            $data['technology_level'] = $this->request->getPost('technology_level');
        }
        if ($this->request->getPost('innovation_capacity')) {
            $data['innovation_capacity'] = $this->request->getPost('innovation_capacity');
        }
        if ($this->request->getPost('environmental_sustainability')) {
            $data['environmental_sustainability'] = $this->request->getPost('environmental_sustainability');
        }
        if ($this->request->getPost('social_inclusion')) {
            $data['social_inclusion'] = $this->request->getPost('social_inclusion');
        }
        if ($this->request->getPost('is_women_owned')) {
            $data['is_women_owned'] = $this->request->getPost('is_women_owned');
        }
        
        // Handle file upload for RDB certificate
        $file = $this->request->getFile('rdb_certificate');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadPath = WRITEPATH . 'uploads/rdb_certificates';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $fileName = $file->getRandomName();
            $file->move($uploadPath, $fileName);
            $data['rdb_certificate'] = $fileName;
        }
        
        $enterpriseModel->save($data);
    }

    private function saveInvestorDetails($userId)
    {
        $investorModel = new InvestorModel();
        
        $data = [
            'user_id' => $userId,
            'full_name' => $this->request->getPost('full_name'),
            'email' => $this->request->getPost('email'),
            'country' => $this->request->getPost('country'),
            'investment_sector' => $this->request->getPost('investment_sector'),
            'preferred_enterprise_type' => $this->request->getPost('preferred_enterprise_type'),
            'geographic_preferences' => $this->request->getPost('geographic_preferences'),
            'technology_interests' => $this->request->getPost('technology_interests'),
            'sustainability_preferences' => $this->request->getPost('sustainability_preferences'),
            'investment_stage' => $this->request->getPost('investment_stage'),
            'expected_returns' => $this->request->getPost('expected_returns'),
            'investment_criteria' => $this->request->getPost('investment_criteria'),
            'status' => 'pending'
        ];
        
        // Handle file upload for ID document
        $file = $this->request->getFile('id_document');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadPath = WRITEPATH . 'uploads/id_documents';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $fileName = $file->getRandomName();
            $file->move($uploadPath, $fileName);
            $data['id_document'] = $fileName;
        }
        
        $investorModel->save($data);
    }

    private function generateDefaultPassword()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%';
        $password = '';
        for ($i = 0; $i < 12; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $password;
    }

    private function sendWelcomeEmail($email, $name, $defaultPassword)
    {
        try {
            $emailService = \Config\Services::email();
            
            $subject = 'Welcome to AIIIIS - Your Account Details';
            
            $message = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                    .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                    .header { background: linear-gradient(135deg, #078ece 0%, #045a86 100%); color: white; padding: 30px 20px; text-align: center; border-radius: 8px 8px 0 0; }
                    .content { padding: 30px; background: #f9f9f9; border: 1px solid #e3e7ea; border-top: none; border-radius: 0 0 8px 8px; }
                    .password-box { background: #e8f4f8; padding: 20px; border-left: 4px solid #078ece; margin: 20px 0; border-radius: 4px; }
                    .password { font-size: 22px; font-weight: 700; color: #078ece; letter-spacing: 2px; font-family: monospace; }
                    .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; border-top: 1px solid #e3e7ea; margin-top: 20px; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h1 style='margin: 0;'>Welcome to AIIIIS!</h1>
                        <p style='margin: 5px 0 0; opacity: 0.9;'>Industrial Innovation & Investment Intelligence System</p>
                    </div>
                    <div class='content'>
                        <h2 style='color: #1a2332;'>Hello " . $name . ",</h2>
                        <p>Your account has been created successfully on the AIIIIS platform.</p>
                        
                        <div class='password-box'>
                            <p style='margin: 0 0 5px; font-weight: 600;'>Your Password:</p>
                            <p style='margin: 5px 0;'><span class='password'>" . $defaultPassword . "</span></p>
                            <p style='margin: 10px 0 0; font-size: 13px; color: #666;'>You can use this password to login to your account.</p>
                        </div>
                        
                        <p>You can now login to your account and start exploring.</p>
                        <p><a href='" . base_url('login') . "' style='display: inline-block; padding: 12px 30px; background: #078ece; color: white; text-decoration: none; border-radius: 6px;'>Login to Your Account</a></p>
                    </div>
                    <div class='footer'>
                        <p>&copy; 2026 AIIIIS - NIRDA</p>
                    </div>
                </div>
            </body>
            </html>
            ";
            
            $emailService->setTo($email);
            $emailService->setFrom('baberybeauty@gmail.com', 'AIIIIS Platform');
            $emailService->setSubject($subject);
            $emailService->setMessage($message);
            $emailService->setMailType('html');
            
            if ($emailService->send()) {
                log_message('info', 'Welcome email sent to: ' . $email);
                return true;
            } else {
                log_message('error', 'Failed to send welcome email to: ' . $email);
                return false;
            }
        } catch (\Exception $e) {
            log_message('error', 'Email error: ' . $e->getMessage());
            return false;
        }
    }

    private function getValidationRules($userType)
    {
        $rules = [
            'email' => 'required|valid_email|is_unique[users.email]',
            'terms' => 'required'
        ];
        
        if ($userType === 'enterprise') {
            $rules['enterprise_name'] = 'required|min_length[2]|max_length[200]';
            $rules['sector'] = 'required';
            $rules['location'] = 'required|min_length[2]';
            $rules['contact_info'] = 'required|min_length[5]';
            $rules['products_services'] = 'required|min_length[5]';
            $rules['employees'] = 'required|numeric|greater_than[0]';
            $rules['rdb_certificate'] = 'uploaded[rdb_certificate]|max_size[rdb_certificate,5120]|ext_in[rdb_certificate,pdf,jpg,jpeg,png]';
        } elseif ($userType === 'investor') {
            $rules['full_name'] = 'required|min_length[2]|max_length[200]';
            $rules['country'] = 'required|min_length[2]';
            $rules['investment_sector'] = 'required';
            $rules['preferred_enterprise_type'] = 'required';
            $rules['investment_stage'] = 'required';
            $rules['id_document'] = 'uploaded[id_document]|max_size[id_document,5120]|ext_in[id_document,pdf,jpg,jpeg,png]';
        }
        
        return $rules;
    }
}