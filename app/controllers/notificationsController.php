<?php
class NotificationsController extends Controller {
    private $notificationModel;
    
    public function __construct() {
        // Check if user is logged in
        // if (!isLoggedIn()) {
        //     redirect('users/login');
        // }
        
        $this->notificationModel = $this->model('notificationModel');
    }
    
    public function index() {
        $notifications = $this->notificationModel->getAllByUser($_SESSION['user_id']);
        
        $data = [
            'notifications' => $notifications
        ];

        if($_SESSION['role'] == 'doctor'){
            $this->view('doctor/notifications', $data);
        } else if($_SESSION['role'] == 'patient'){
            $this->view('patient/notifications', $data);
        }else if($_SESSION['role']=='pharmacy'){
            $this->view('pharmacy/pharmacynotifications', $data);
        }else if($_SESSION['role']=='admin'){
            $this->view('admin/notifications', $data);
        }
        
        
    }
    
    public function getUnread() {
        // For AJAX requests to get unread notifications
        if (!isset($_SESSION['user_id'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Not authenticated'
            ]);
            return;
        }
        
        $notifications = $this->notificationModel->getUnreadByUser($_SESSION['user_id']);
        $count = $this->notificationModel->countUnread($_SESSION['user_id']);
        
        echo json_encode([
            'success' => true,
            'count' => $count,
            'notifications' => $notifications
        ]);
    }
    
    public function markAsRead($id = null) {
        // For AJAX requests to mark notifications as read
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($id) {
                $result = $this->notificationModel->markAsRead($id);
            } else {
                $result = $this->notificationModel->markAllAsRead($_SESSION['user_id']);
            }
            
            echo json_encode([
                'success' => $result
            ]);
        } else {
            redirect('notifications');
        }
    }
    
    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = $this->notificationModel->delete($id);
            
            echo json_encode([
                'success' => $result
            ]);
        } else {
            redirect('notifications');
        }
    }
}