<?php

class appointmentController extends controller{

private $appointmentModel;

public function __construct(){
    $this->appointmentModel = $this->model('appointmentModel');

}

public function makeAppointment(){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $doctor_id = $_POST['doctor_id'];
        $doctor_first_name = $this->appointmentModel->getDoctorById($doctor_id)->firstName;
        $doctor_last_name = $this->appointmentModel->getDoctorById($doctor_id)->lastName;
        $data=[
            'doctor_id' => $doctor_id,
            'patient_id' => $_SESSION['user_id'],
            'doctor_name' => $doctor_first_name . ' ' . $doctor_last_name
        ];
       

        $this->view('patient/bookAppointment', $data);


    }


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
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $patientId = $this->appointmentModel->getPatientIdByUserId($_SESSION['user_id']);
            
            $data = [
                'doctor_id' => trim($_POST['doctor_id']),
                'patient_id' => $patientId->patient_id,
                'appointment_date' => trim($_POST['appointment_date']),
                'timeslot_id' => trim($_POST['timeslot_id']),
                'reason' => trim($_POST['reason']),
                'status' => 'pending'
            ];

            //var_dump($data);
            
            if($this->appointmentModel->createAppointment($data)) {
                #flash('appointment_message', 'Appointment booked successfully');
                #redirect('appointments/view');
                echo 'Appointment booked successfully';
            } else {
                #flash('appointment_message', 'Something went wrong', 'alert alert-danger');
                echo 'Something went wrong';
            }
        }
    }

    public function viewAppointmentsByDoctor() {

        $date = $_POST['date'];
        $doctorId = $this->appointmentModel->getDoctorIdByUserId($_SESSION['user_id']);

        $pending_appointments = $this->appointmentModel->getAppointmentsByDoctor($doctorId->doctor_id);
        
        
    }


}



















