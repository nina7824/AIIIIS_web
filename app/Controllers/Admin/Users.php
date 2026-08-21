<?php

namespace App\Controllers;

class User extends BaseController
{
    public function updateTheme()
    {
        // Check if user is logged in
        if (!$this->currentUser) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized'
            ])->setStatusCode(401);
        }

        // Get theme from POST (form data, not JSON)
        $theme = $this->request->getPost('theme');
        
        // If theme is not in POST, try raw input
        if (empty($theme)) {
            $rawInput = $this->request->getRawInput();
            $theme = $rawInput['theme'] ?? null;
        }
        
        if (!in_array($theme, ['light', 'dark'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid theme'
            ])->setStatusCode(400);
        }

        try {
            $userModel = new \App\Models\UserModel();
            $updated = $userModel->where('user_id', $this->currentUser['user_id'])
                ->set(['theme_preference' => $theme])
                ->update();

            if ($updated) {
                // Update session
                session()->set('theme_preference', $theme);
                
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Theme updated successfully',
                    'theme' => $theme,
                    'csrf_token' => csrf_hash()
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Failed to update theme'
                ])->setStatusCode(500);
            }
        } catch (\Exception $e) {
            log_message('error', 'UpdateTheme Error: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error updating theme: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}