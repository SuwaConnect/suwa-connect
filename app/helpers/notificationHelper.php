<?php
// class notificationHelper {
//     private static $instance = null;
//     private $notificationModel;
    
//     private function __construct() {
//         $this->notificationModel = new notificationModel();
//     }
    
//     public static function getInstance() {
//         if (self::$instance == null) {
//             self::$instance = new notificationHelper();
//         }
//         return self::$instance;
//     }
    
//     // Send a notification to a specific user
//     public function sendToUser($userId, $type, $message, $relatedId = null) {
//         return $this->notificationModel->create([
//             'user_id' => $userId,
//             'type' => $type,
//             'message' => $message,
//             'related_id' => $relatedId
//         ]);
//     }
    
//     // Send appointment reminder notification
//     public function appointmentReminder($userId, $appointmentId, $doctorName, $date, $time) {
//         $message = "Reminder: You have an appointment with Dr. {$doctorName} on {$date} at {$time}.";
//         return $this->sendToUser($userId, 'appointment_reminder', $message, $appointmentId);
//     }
    
//     // Send test results notification
//     public function testResults($userId, $testId, $testName) {
//         $message = "Your {$testName} results are now available. Click to view.";
//         return $this->sendToUser($userId, 'test_results', $message, $testId);
//     }
    
//     // Send prescription renewal notification
//     public function prescriptionRenewal($userId, $prescriptionId, $medicationName) {
//         $message = "Your prescription for {$medicationName} is due for renewal.";
//         return $this->sendToUser($userId, 'prescription_renewal', $message, $prescriptionId);
//     }
    
//     // Send system update notification
//     public function systemUpdate($userId, $title, $details) {
//         $message = "System Update: {$title}. {$details}";
//         return $this->sendToUser($userId, 'system_update', $message);
//     }

//     public function profileAccessRequest($patientUserId ,$doctorName) {
//         $message = "You have a new request for profile access from Dr. {$doctorName}.";
//         return $this->sendToUser($patientUserId, 'profile_access_request', $message);
//     }
