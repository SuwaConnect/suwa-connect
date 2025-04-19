<?php
class notificationModel {
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }
    
    // Create a new notification
    // public function create($data) {
    //     $this->db->query('INSERT INTO notifications (user_id, type, message, related_id) VALUES (:user_id, :type, :message, :related_id)');
    //     $this->db->bind(':user_id', $data['user_id']);
    //     $this->db->bind(':type', $data['type']);
    //     $this->db->bind(':message', $data['message']);
    //     $this->db->bind(':related_id', $data['related_id'] ?? null);
        
    //     return $this->db->execute();
    // }
    
    // Get all unread notifications for a user
    // public function getUnreadByUser($userId) {
    //     $this->db->query('SELECT * FROM notifications WHERE user_id = :user_id AND is_read = 0 ORDER BY created_at DESC');
    //     $this->db->bind(':user_id', $userId);
        
    //     return $this->db->resultSet();
    // }
    
    // Get all notifications for a user
    public function getAllByUser($userId, $limit = 20, $offset = 0) {
        $this->db->query('SELECT * FROM notifications WHERE user_id = :user_id ORDER BY created_at DESC LIMIT :limit OFFSET :offset');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        
        return $this->db->resultSet();
    }
    
    // Mark notification as read
    // public function markAsRead($id) {
    //     $this->db->query('UPDATE notifications SET is_read = 1 WHERE id = :id');
    //     $this->db->bind(':id', $id);
        
    //     return $this->db->execute();
    // }
    
    // Mark all notifications as read for a user
    // public function markAllAsRead($userId) {
    //     $this->db->query('UPDATE notifications SET is_read = 1 WHERE user_id = :user_id');
    //     $this->db->bind(':user_id', $userId);
        
    //     return $this->db->execute();
    // }
    
    // Delete a notification
    // public function delete($id) {
    //     $this->db->query('DELETE FROM notifications WHERE id = :id');
    //     $this->db->bind(':id', $id);
        
    //     return $this->db->execute();
    // }
    
    // Count unread notifications
    // public function countUnread($userId) {
    //     $this->db->query('SELECT COUNT(*) as count FROM notifications WHERE user_id = :user_id AND is_read = 0');
    //     $this->db->bind(':user_id', $userId);
        
    //     $row = $this->db->single();
    //     return $row->count;
    // }
}