<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatbotModel extends Model
{
    protected $table = 'chatbot_knowledge';
    protected $primaryKey = 'knowledge_id';
    protected $allowedFields = [
        'service_id', 'question', 'answer', 'keywords', 
        'category', 'confidence_score', 'usage_count', 
        'is_approved', 'created_by'
    ];
    protected $useTimestamps = true;

    public function findAnswer($question, $serviceId)
    {
        // Clean the question
        $cleanQuestion = strtolower(trim(preg_replace('/[^\w\s]/', '', $question)));
        
        // First try exact match
        $result = $this->where('service_id', $serviceId)
                       ->where('is_approved', 1)
                       ->like('question', $question)
                       ->orderBy('usage_count', 'DESC')
                       ->orderBy('confidence_score', 'DESC')
                       ->first();
        
        if ($result) {
            $this->update($result['knowledge_id'], ['usage_count' => $result['usage_count'] + 1]);
            return $result;
        }
        
        // Try keyword matching
        $keywords = explode(' ', $cleanQuestion);
        $this->where('service_id', $serviceId);
        $this->where('is_approved', 1);
        $this->groupStart();
        foreach ($keywords as $keyword) {
            if (strlen($keyword) > 2) {
                $this->orLike('keywords', $keyword);
            }
        }
        $this->groupEnd();
        $result = $this->orderBy('usage_count', 'DESC')
                       ->orderBy('confidence_score', 'DESC')
                       ->first();
        
        if ($result) {
            $this->update($result['knowledge_id'], ['usage_count' => $result['usage_count'] + 1]);
        }
        
        return $result;
    }
}