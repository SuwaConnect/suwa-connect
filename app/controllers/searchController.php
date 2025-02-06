<?php



class searchController extends Controller
{
    protected $searchModel;

    public function __construct()
    {
        $this->searchModel = $this->model('searchModel');
    }

   

    public function searchPatient() {
        // Debug: Log the incoming request
        error_log('Search method called with POST data: ' . print_r($_POST, true));
    
        if (isset($_POST['search']) && !empty($_POST['search'])) {
            $searchTerm = trim($_POST['search']);
            $patients = $this->searchModel->searchPatient($searchTerm);
            
            if (isset($_POST['ajax'])) {
                header('Content-Type: application/json');
                
                // Debug: Log what we're about to send back
                error_log('Returning patients data: ' . print_r($patients, true));
                
                // Make sure $patients is an array, even if empty
                if (!is_array($patients)) {
                    $patients = [];
                }
                
                echo json_encode($patients);
                exit;
            }
        }
        
        // If we get here with ajax, return empty array
        if (isset($_POST['ajax'])) {
            header('Content-Type: application/json');
            echo json_encode([]);
            exit;
        }
        
        $patients = isset($searchTerm) ? $patients : [];
        $this->view('doctor/searchPatient', $patients);
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

            
    
