<?php
// app/Controllers/User.php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function updateTheme()
    {
        try {
            // Check if request is AJAX
            if (!$this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Invalid request'
                ])->setStatusCode(400);
            }

            // Get raw input
            $rawInput = $this->request->getBody();
            
            // Debug: Log raw input
            log_message('debug', 'Raw input for theme update: ' . $rawInput);
            
            // Check if input is empty
            if (empty($rawInput)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'No data received'
                ])->setStatusCode(400);
            }
            
            // Decode JSON manually
            $data = json_decode($rawInput, true);
            
            // Check for JSON errors
            if (json_last_error() !== JSON_ERROR_NONE) {
                log_message('error', 'JSON decode error: ' . json_last_error_msg());
                log_message('error', 'Raw input: ' . $rawInput);
                
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Invalid JSON data: ' . json_last_error_msg()
                ])->setStatusCode(400);
            }
            
            // Get theme and user ID
            $theme = $data['theme'] ?? 'light';
            $userId = $data['user_id'] ?? session()->get('user_id');
            
            // If user_id not in request, try session
            if (!$userId) {
                $userId = session()->get('user_id');
            }
            
            if (!$userId) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'User not authenticated'
                ])->setStatusCode(401);
            }
            
            // Validate theme
            $validThemes = ['light', 'dark', 'system'];
            if (!in_array($theme, $validThemes)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Invalid theme. Allowed: light, dark, system'
                ])->setStatusCode(400);
            }
            
            // Update user theme preference
            $userModel = new UserModel();
            $updated = $userModel->update($userId, ['theme_preference' => $theme]);
            
            if ($updated) {
                // Update session
                session()->set('theme_preference', $theme);
                
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Theme updated successfully',
                    'theme' => $theme
                ]);
            }
            
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to update theme'
            ])->setStatusCode(500);
            
        } catch (\Exception $e) {
            log_message('error', 'updateTheme exception: ' . $e->getMessage());
            log_message('error', 'Exception trace: ' . $e->getTraceAsString());
            
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}