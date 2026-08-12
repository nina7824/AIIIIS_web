<?php

namespace App\Controllers;

use App\Models\ChatbotModel;

class ChatbotController extends BaseController
{
    private $chatbotModel;

    public function __construct()
    {
        $this->chatbotModel = new ChatbotModel();
    }

    public function process()
    {
        // Get POST data
        $serviceId = $this->request->getPost('service_id');
        $message = $this->request->getPost('message');

        // Validate
        if (!$message || !$serviceId) {
            return $this->response->setJSON([
                'success' => false, 
                'error' => 'Missing required fields'
            ]);
        }

        // Search for answer in knowledge base
        $answer = $this->chatbotModel->findAnswer($message, $serviceId);

        if ($answer) {
            // Found answer - return it
            return $this->response->setJSON([
                'success' => true,
                'reply' => $answer['answer'],
                'source' => 'knowledge_base'
            ]);
        } else {
            // No answer found - return default message
            return $this->response->setJSON([
                'success' => false,
                'reply' => "I'm sorry, I don't have an answer for that question yet. Please contact us via WhatsApp or Email for more assistance.",
                'source' => 'not_found'
            ]);
        }
    }
}