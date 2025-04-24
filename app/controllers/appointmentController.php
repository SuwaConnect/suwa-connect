<?php

class appointmentController extends controller{

private $appointmentModel;

public function __construct(){
    $this->appointmentModel = $this->model('appointmentModel');

}

    
   

    public function book() {
        // Get doctor details
        $doctorId = $_POST['doctor_id']; 
        $doctor = $this->appointmentModel->getDoctorById($doctorId);       
        $data = [
            'doctor_id' => $doctorId,
            'doctor_name' => $doctor->firstName,
            'selected_date' => '',
            'selected_time' => '',
            'reason' => '',
            'timeslots' => []
        ];
        
        $this->view('patient/bookAppointment', $data);
    }
    
    // AJAX endpoint for getting available timeslots
    // public function getAvailableSlots() {
    //     if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $doctorId = $_POST['doctor_id'];
    //         $date = $_POST['date'];
            
    //         $availableSlots = $this->appointmentModel->getAvailableTimeSlots($doctorId, $date);
            
    //         header('Content-Type: application/json');
    //         echo json_encode($availableSlots);
    //         exit;
    //     }
    // }
    
    // Create appointment
    public function create() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            try{
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                $patientId = $this->appointmentModel->getPatientIdByUserId($_SESSION['user_id']);
                
                $data = [
                    'doctor_id' => trim($_POST['doctor_id']),
                    'patient_id' => $patientId->patient_id,
                    'appointment_date' => trim($_POST['appointment_date']),
                    'session_id' => trim($_POST['session_id']),
                    'reason' => trim($_POST['reason'])
                    // 'status' => 'pending'
                ];

                
                
                if($this->appointmentModel->createAppointment($data)) {
                        echo 'Appointment booked successfully';
                } else {
                        echo 'Something went wrong';
                }
            } catch (Exception $e) {
                echo $e->getMessage();
        }
        }
    }

   

   



    public function getDoctorSessionByDate(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            try{
                $date = $_POST['date'];
                $doctorId = $_POST['doctor_id'];
                $dayOfWeek = date('l', strtotime($date));
                
                $sessions = $this->appointmentModel->getSessionsForTheSelecteddate($doctorId, $date, $dayOfWeek);
                
                // Set header to indicate JSON content
                header('Content-Type: application/json');
                
                // Echo the JSON-encoded sessions and exit
                echo json_encode($sessions);
                exit;
    
            } catch(Exception $e){
                // Set header for error responses
                header('Content-Type: application/json');
                
                // Return error as JSON
                echo json_encode(['error' => $e->getMessage()]);
                exit;
            }
        }
    }




    public function getAppointmentsByDate() {
        try {
            // Get the doctor ID from the logged-in user
            $doctorId = $this->appointmentModel->getDoctorIdByUserId($_SESSION['user_id'])->doctor_id;
            
            // Get the date from POST request
            $date = $_POST['date'];
            
            // Convert date to day of week (Monday, Tuesday, etc.)
            $dayOfWeek = date('l', strtotime($date));
    
            // Get sessions for this doctor on this day of week
            $doctorSessions = $this->appointmentModel->getSessionsByDoctorAndDay($doctorId, $dayOfWeek);
            
            // Initialize array to hold sessions and their appointments
            $sessions = [];
            
            // For each session, get the appointments
            foreach ($doctorSessions as $session) {
                $sessionId = $session->session_id;
                
                // Get appointments for this session on the specified date
                $appointments = $this->appointmentModel->getAppointmentsForSession($sessionId, $date);
                
                // Add session info and its appointments to the result
                $sessions[$sessionId] = [
                    'session_info' => $session,
                    'appointments' => $appointments,
                    'current_count' => count($appointments),
                    'max_patients' => $session->max_patients
                ];
            }
            
            // Check if we have any sessions for this day
            if (empty($sessions)) {
                $data = [
                    'date' => $date,
                    'message' => 'No sessions scheduled for ' . $dayOfWeek
                ];
            } else {
                $data = [
                    'date' => $date,
                    'day_of_week' => $dayOfWeek,
                    'sessions' => $sessions
                ];
            }
            
            // Load the view with the data
            $this->view('doctor/appointments', $data);
            
        } catch (Exception $e) {
            // Handle error
            $data = [
                'date' => $_POST['date'] ?? date('Y-m-d'),
                'message' => 'Error: ' . $e->getMessage()
            ];
            
            $this->view('doctor/appointments', $data);
        }
    }
    
    public function markAppointmentAsCompleted() {
        // Check if request is AJAX
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            return;
        }
        
        try {
            $appointmentId = $_POST['appointment_id'] ?? null;
            
            if (!$appointmentId) {
                echo json_encode(['success' => false, 'message' => 'Appointment ID is required']);
                return;
            }
            
            $result = $this->appointmentModel->markAppointmentAsCompleted($appointmentId);
            
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Appointment marked as completed']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update appointment status']);
            }
            
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function manageSessions() {
        //Get the doctor ID from the logged-in user
        $doctorId = $this->appointmentModel->getDoctorIdByUserId($_SESSION['user_id'])->doctor_id;
        
        // Get all appointments for this doctor
        $sessions = $this->appointmentModel->getAllSessionsForDoctor($doctorId);
        
        //Load the view with the appointments data
        $data = [
            'sessions' => $sessions
        ];
        //var_dump($data);
        $this->view('doctor/session-management', $data);
    }

    public function addSession() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                $doctorId = $this->appointmentModel->getDoctorIdByUserId($_SESSION['user_id'])->doctor_id;
                //var_dump($doctorId);
                $data = [
                    'doctor_id' => $doctorId,
                    'session_date' => $_POST['weekdays'],
                    'start_time' => $_POST['startTime'],
                    'end_time' => $_POST['endTime'],
                    'max_patients' => $_POST['maxPatients']
                ];
                
                
                // Check for existing sessions at this time
                $overlappingSessions = $this->appointmentModel->checkOverlappingSessions(
                    $doctorId,
                    $data['session_date'],
                    $data['start_time'],
                    $data['end_time']
                );
                
                if ($overlappingSessions) {
                    echo 'Error: You already have a session scheduled during this time slot.';
                    return;
                }
                
                // If no overlapping sessions, proceed with adding
                if ($this->appointmentModel->addSession($data)) {
                    echo 'Session added successfully';
                } else {
                    echo 'Failed to add session';
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        //echo 'Session added successfully';
    }

    public function deleteSession($sessionId) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                // Delete the session
                if ($this->appointmentModel->deleteSession($sessionId)) {
                    //echo 'Session deleted successfully';
                    header('Location: ' . URLROOT . 'appointmentController/manageSessions');
                } else {
                    echo 'Failed to delete session';
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }
}


