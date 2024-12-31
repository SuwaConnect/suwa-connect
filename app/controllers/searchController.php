<?php



class searchController extends Controller
{
    protected $searchModel;

    public function __construct()
    {
        $this->searchModel = $this->model('searchModel');
    }

   

    public function search() {
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

}


    
