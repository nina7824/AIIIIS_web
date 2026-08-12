<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
    protected $table = 'chat_messages';
    protected $primaryKey = 'message_id';
    protected $allowedFields = [
        'session_id',
        'user_id',
        'service_id',
        'sender_type',
        'message',
        'is_read'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getMessagesBySession($sessionId)
    {
        return $this->where('session_id', $sessionId)
                    ->orderBy('created_at', 'ASC')
                    ->findAll();
    }

    public function getUnreadMessages($serviceId = null)
    {
        $this->where('is_read', 0);
        $this->where('sender_type', 'user');
        if ($serviceId) {
            $this->where('service_id', $serviceId);
        }
        return $this->orderBy('created_at', 'ASC')->findAll();
    }

    public function markAsRead($messageId)
    {
        return $this->update($messageId, ['is_read' => 1]);
    }

    public function markAllAsRead($sessionId)
    {
        return $this->where('session_id', $sessionId)
                    ->where('sender_type', 'user')
                    ->set(['is_read' => 1])
                    ->update();
    }
}