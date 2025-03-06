<?php

class appointmentController extends controller{

private $appointmentModel;

public function __construct(){
    $this->appointmentModel = $this->model('appointmentModel');

}

// public function makeAppointment(){

//     if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
//         $doctor_id = $_POST['doctor_id'];
//         $doctor_first_name = $this->appointmentModel->getDoctorById($doctor_id)->firstName;
//         $doctor_last_name = $this->appointmentModel->getDoctorById($doctor_id)->lastName;
//         $data=[
//             'doctor_id' => $doctor_id,
//             'patient_id' => $_SESSION['user_id'],
//             'doctor_name' => $doctor_first_name . ' ' . $doctor_last_name
//         ];
       

//         $this->view('patient/bookAppointment', $data);
//     }


// }



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
    public function getAvailableSlots() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $doctorId = $_POST['doctor_id'];
            $date = $_POST['date'];
            
            $availableSlots = $this->appointmentModel->getAvailableTimeSlots($doctorId, $date);
            
            header('Content-Type: application/json');
            echo json_encode($availableSlots);
            exit;
        }
    }
    
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

   

    public function viewAppointmentsByDoctor() {
        // If no date is selected, use today's date
        $date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');
        
     
        try {
            $doctorId = $this->appointmentModel->getDoctorIdByUserId($_SESSION['user_id']);
            
            if (!$doctorId) {
                throw new Exception('Doctor not found');
            }
    
            $pending_appointments = $this->appointmentModel->getPendingAppointments($doctorId->doctor_id, $date);
            $approved_appointments = $this->appointmentModel->getApprovedAppointments($doctorId->doctor_id, $date);
            $all_appointments = $this->appointmentModel->getAllAppointments($doctorId->doctor_id);
    
            $data = [
                'pending_appointments' => $pending_appointments,
                'approved_appointments' => $approved_appointments,
                'all_appointments' => $all_appointments,
                'selected_date' => $date
            ];
    
            $this->view('doctor/appointments', $data);
        } catch (Exception $e) {
            // Handle the error appropriately
            $data = [
                'error' => $e->getMessage()
            ];
            $this->view('doctor/appointments', $data);
        }
    }



    public function confirmAppointment() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get appointment ID from form
            $appointment_id = $_POST['appointment_id'];
            $date = $_POST['date'];
            
            try {
                // Update appointment status
                if($this->appointmentModel->updateAppointmentStatus($appointment_id, 'confirmed')) {
                    // Set flash message for success
                    //flash('appointment_message', 'Appointment confirmed successfully');
                    echo 'Appointment confirmed successfully';
                } else {
                    //flash('appointment_message', 'Failed to confirm appointment', 'alert alert-danger');
                    echo 'Failed to confirm appointment';
                }
            } catch (Exception $e) {
                //flash('appointment_message', 'Error confirming appointment: ' . $e->getMessage(), 'alert alert-danger');
            }
            
            // Redirect back to appointments page with the same date
            redirect('appointmentController/viewAppointmentsByDoctor?date=' . urlencode($date));
        } else {
            redirect('pages/error');
        }
    }



    public function cancelAppointment() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $appointment_id = $_POST['appointment_id'];
            $date = $_POST['date'];
            
            try {
                if($this->appointmentModel->updateAppointmentStatus($appointment_id, 'cancelled')) {
                    //flash('appointment_message', 'Appointment cancelled successfully');
                } else {
                    //flash('appointment_message', 'Failed to cancel appointment', 'alert alert-danger');
                }
            } catch (Exception $e) {
                //flash('appointment_message', 'Error cancelling appointment: ' . $e->getMessage(), 'alert alert-danger');
            }
            
            redirect('appointmentController/viewAppointmentsByDoctor?date=' . urlencode($date));
        } else {
            redirect('pages/error');
        }
    }



    public function markAppointmentAsCompleted() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $appointment_id = $_POST['appointment_id'];
            $date = $_POST['date'];
            
            try {
                if($this->appointmentModel->markAppointmentAsCompleted($appointment_id)) {
                    //flash('appointment_message', 'Appointment marked as completed');
                } else {
                    //flash('appointment_message', 'Failed to mark appointment as completed', 'alert alert-danger');
                }
            } catch (Exception $e) {
                //flash('appointment_message', 'Error marking appointment as completed: ' . $e->getMessage(), 'alert alert-danger');
            }
            
            redirect('appointmentController/viewAppointmentsByDoctor?date=' . urlencode($date));
        } else {
            redirect('pages/error');
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







}














