<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Chatbot extends Controller
{
    public function process()
    {
        // Get POST data
         = ->request->getPost('message') ?? '';
         = ->request->getPost('service_id') ?? 'general';
        
        // If no message, return error
        if (empty()) {
            return ->response->setJSON([
                'success' => false,
                'reply' => 'Please enter a question.',
                'source' => 'error'
            ]);
        }
        
        // Call Flask API
        try {
             = curl_init('http://localhost:5000/api/chat');
            curl_setopt(, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(, CURLOPT_POST, true);
            curl_setopt(, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt(, CURLOPT_POSTFIELDS, json_encode([
                'message' => ,
                'service_id' => ,
                'session_id' => session_id()
            ]));
            curl_setopt(, CURLOPT_TIMEOUT, 10);
            
             = curl_exec();
             = curl_getinfo(, CURLINFO_HTTP_CODE);
            curl_close();
            
            if ( === 200 && ) {
                System.Collections.Hashtable = json_decode(, true);
                 = System.Collections.Hashtable['reply'] ?? null;
                
                if () {
                    return ->response->setJSON([
                        'success' => true,
                        'reply' => ,
                        'source' => System.Collections.Hashtable['source'] ?? 'flask_api'
                    ]);
                }
            }
        } catch (\Exception ) {
            // Log error but continue to fallback
        }
        
        // Fallback
        return ->response->setJSON([
            'success' => false,
            'reply' => "I don't have enough information to answer that question. Please contact our support team via WhatsApp or Email for assistance.",
            'source' => 'fallback'
        ]);
    }
    
    public function status()
    {
        // Check Flask API status
        try {
             = curl_init('http://localhost:5000/api/health');
            curl_setopt(, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(, CURLOPT_TIMEOUT, 3);
             = curl_exec();
             = curl_getinfo(, CURLINFO_HTTP_CODE);
            curl_close();
            
             =  === 200;
        } catch (\Exception ) {
             = false;
        }
        
        return ->response->setJSON([
            'flask_api' =>  ? 'connected' : 'disconnected',
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }
}
