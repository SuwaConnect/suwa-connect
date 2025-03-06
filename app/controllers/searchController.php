<?php



class searchController extends Controller
{
    protected $searchModel;
    private $permissionModel;

    public function __construct()
    {
        $this->searchModel = $this->model('searchModel');
        $this->permissionModel = $this->model('requestPermission');

    }

  
    public function searchPatientAjax() {
        try{
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $searchTerm = trim($_POST['search']);
            $doctorId = $this->permissionModel->getDoctorIdByUserId($_SESSION['user_id']);
            
            // Get patients matching search term
            $patients = $this->searchModel->searchPatient($searchTerm);
            
            // Get request status for each patient
            foreach ($patients as &$patient) {
                $requestStatus = $this->permissionModel->getRequestStatus($doctorId, $patient->patient_id);
                $patient->request_status = $requestStatus;
            }
            
            header('Content-Type: application/json');
            echo json_encode($patients);
        }
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }




    public function searchDoctor() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $searchTerm = trim($_POST['search']);
            
            if (empty($searchTerm)) {
                // If search is empty, redirect back
                redirect('pages/index');
            } else {
                // Get doctors based on search
                $doctors = $this->searchModel->searchDoctor($searchTerm);
                
                $data = [
                    'doctors' => $doctors,
                    'search' => $searchTerm
                ];
                
                // Load view with search results
                $this->view('patient/searchDoctor', $data);
            }
        } else {
            redirect('pages/index');
        }
    }

}

            
    
