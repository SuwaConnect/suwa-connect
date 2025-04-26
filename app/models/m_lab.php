
<?php

class m_lab {
    private $db;

    public function __construct() {
        $this->db = new Database(); // Assuming Database class is already defined
    }

    public function getPendingLabs() {
        $this->db->query("SELECT * FROM pending_labs WHERE status = 'pending'");
        return $this->db->resultSet(); // Returns an array of objects
    }

    public function markPendingLabAsApproved($lab_id){
        $this->db->query('UPDATE pending_labs SET status = "approved" WHERE id = :lab_id');
        $this->db->bind(':lab_id', $lab_id);
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getLabByIdFromPendingLabs($lab_id){
        $this->db->query('SELECT * FROM Pending_labs WHERE id = :lab_id ');
        $this->db->bind(':lab_id',$lab_id);
        return $this->db->single();
    }

    public function insertApprovedLab($data){
        $this->db->query('INSERT INTO registered_labs(user_id,name, contact_person,  contact_number, lab_reg_number, lab_certificate) 
               VALUES (:user_id,:name, :contact_person,  :contact_number, :lab_reg_number, :lab_certificate)');
        $this->db->bind(':user_id',$data['user_id']);
        $this->db->bind(':name', $data['lab_name']);
        $this->db->bind(':contact_person', $data['contact_person']);
        $this->db->bind(':contact_number', $data['contact_no']);
        $this->db->bind(':lab_reg_number', $data['lab_reg_no']);
        $this->db->bind(':lab_certificate', $data['lab_license_copy']);
        $this->db->execute(); 

    }

    public function getlabByUserid($user_id) {
        $this->db->query('SELECT * FROM registered_labs WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }
    

    public function addPendingLab($data) {
        try{
        

        $this->db->query("INSERT INTO pending_labs (name, contact_person, email, contact_number, lab_reg_number, lab_certificate, password, terms_accepted) 
                 VALUES (:name, :contact_person, :email, :contact_number, :lab_reg_number, :lab_certificate, :password, :terms_accepted)");
       
       
        $this->db->bind(':name', $data['lab_name']);
        $this->db->bind(':contact_person', $data['contact_person']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':contact_number', $data['contact_no']);
        $this->db->bind(':lab_reg_number', $data['lab_reg_no']);
        $this->db->bind(':lab_certificate', $data['medical_license_copy']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':terms_accepted', $data['terms_accepted']);

        
        return $this->db->execute();}
        catch (Exception $e) {
           
            echo "Error: " . $e->getMessage();
            return false; 
        }
    }

    public function verifyCredentials($email, $password) {
        $query = "SELECT lab_id, name, email, password FROM registered_labs WHERE email = :email"; 
    
        $this->db->query($query);
        $this->db->bind(':email', $email);
    
        $user = $this->db->single();
    
        if ($user && $password === $user->password) {
            return $user;
        } else {
            return false;
        }
    }
    
    public function getTotalTests($lab_id) {
        $this->db->query("SELECT COUNT(*) AS count FROM tests
                          WHERE lab_id = :lab_id");
        $this->db->bind(':lab_id', $lab_id);
        return $this->db->single()->count;
    }

    public function getTotalTestsToday($lab_id) {
        $this->db->query("SELECT COUNT(*) AS count FROM tests
                          WHERE lab_id = :lab_id AND test_date = CURDATE()");
        $this->db->bind(':lab_id', $lab_id);
        return $this->db->single()->count;
    }

    // 2. Tests in progress (status = 'in_progress')
    public function getTestsInProgress() {
        $this->db->query("SELECT COUNT(*) AS count FROM tests
                          WHERE status = 'in_progress'");
        return $this->db->single()->count;
    }

    // 3. Completed tests (status = 'completed')
    public function getCompletedTests() {
        $this->db->query("SELECT COUNT(*) AS count FROM tests
                          WHERE status = 'completed'");
        return $this->db->single()->count;
    }

    // 4. Average turnaround time for completed tests
    public function getAverageTurnaroundTime() {
        $this->db->query("SELECT AVG(TIMESTAMPDIFF(MINUTE, start_time, end_time)) AS avg_time 
                          FROM tests
                          WHERE status = 'completed' AND end_time IS NOT NULL");
        $result = $this->db->single();
        return $result->avg_time ? round($result->avg_time, 2) : 'N/A';
    }

    // 5. Upcoming appointments (fixed with join)
    public function getUpcomingAppointments($lab_id) {
        $this->db->query("SELECT p.first_name AS patient_name, l.appointment_time AS time, l.appointment_date AS date
                          FROM lab_appointments l
                          JOIN patients p ON l.patient_id = p.patient_id
                          WHERE l.lab_id = :lab_id AND l.appointment_time >= NOW() AND l.appointment_date >= CURDATE()
                          ORDER BY l.appointment_time ASC
                          LIMIT 5");
        $this->db->bind(':lab_id', $lab_id);
        return $this->db->resultSet();
    }

    

    public function generateLabNotificationsData($lab_id) {
        // Test requests - using 'user_id' from 'tests' table
        $this->db->query("SELECT t.test_name, t.test_date, p.first_name 
                          FROM tests t 
                          JOIN patients p ON t.patient_id = p.patient_id  -- 'user_id' links tests to users
                          WHERE t.lab_id = :lab_id");
        $this->db->bind(':lab_id', $lab_id);
        $testRequests = $this->db->resultSet();
    
        // Appointments - using 'patient_id' from 'lab_appointments' table
        $this->db->query("SELECT a.appointment_date, p.first_name 
                          FROM lab_appointments a 
                          JOIN patients p ON a.patient_id = p.patient_id  -- 'patient_id' links appointments to users
                          WHERE a.lab_id = :lab_id");
        $this->db->bind(':lab_id', $lab_id);
        $appointments = $this->db->resultSet();
    
        $notifications = [];
    
        // Loop through test requests and generate notification messages
        foreach ($testRequests as $test) {
            if (!empty($test->test_date)) {
                $testDate = date('F d, Y', strtotime($test->test_date));
                $notifications[] = "{$test->first_name} requested a {$test->test_name} test on $testDate";
            }
        }
    
        // Loop through appointments and generate notification messages
        foreach ($appointments as $appt) {
            if (!empty($appt->appointment_date)) {
                $appointmentDate = date('F d, Y', strtotime($appt->appointment_date));
                $notifications[] = "{$appt->first_name} booked an appointment for $appointmentDate";
            }
        }
    
        return $notifications;
    }

    public function getTotalAppointmentsRequests($lab_id) {
        $this->db->query("SELECT COUNT(*) AS count FROM lab_appointments_requests
                          WHERE lab_id = :lab_id AND status = 'pending'");
        $this->db->bind(':lab_id', $lab_id);
        return $this->db->single()->count;
    }

    public function getTotalAppointments($lab_id) {
        $this->db->query("SELECT COUNT(*) AS count FROM lab_appointments
                          WHERE lab_id = :lab_id AND status = 'in_progress'");
        $this->db->bind(':lab_id', $lab_id);
        return $this->db->single()->count;
    }
    
    public function getUpcomingAppointmentsCount($lab_id) {
        $this->db->query("SELECT COUNT(*) AS count FROM lab_appointments
                          WHERE lab_id = :lab_id AND status = 'in_progress' AND appointment_date > CURDATE()");
        $this->db->bind(':lab_id', $lab_id);
        return $this->db->single()->count;
    }
    
    public function getCancelledAppointmentsCount($lab_id) {
        $this->db->query("SELECT COUNT(*) AS count FROM lab_appointments_requests
                          WHERE lab_id = :lab_id AND status = 'cancelled'");
        $this->db->bind(':lab_id', $lab_id);
        return $this->db->single()->count;
    }

    public function getTotalTestsCount($lab_id) {
        $this->db->query("SELECT COUNT(*) AS count FROM tests WHERE lab_id = :lab_id");
        $this->db->bind(':lab_id', $lab_id);
        return $this->db->single()->count;
    }
    
    public function getPendingTestsCount($lab_id) {
        $this->db->query("SELECT COUNT(*) AS count FROM tests 
                          WHERE lab_id = :lab_id AND status = 'in_progress'");
        $this->db->bind(':lab_id', $lab_id);
        return $this->db->single()->count;
    }
    
    public function getCompletedTestsCount($lab_id) {
        $this->db->query("SELECT COUNT(*) AS count FROM tests 
                          WHERE lab_id = :lab_id AND status = 'Completed'");
        $this->db->bind(':lab_id', $lab_id);
        return $this->db->single()->count;
    }
    
    public function getCancelledTestsCount($lab_id) {
        $this->db->query("SELECT COUNT(*) AS count FROM tests 
                          WHERE lab_id = :lab_id AND status = 'Cancelled'");
        $this->db->bind(':lab_id', $lab_id);
        return $this->db->single()->count;
    }

    public function getLabAppointmentRequests($lab_id) {
        $this->db->query("SELECT 
                              lab_appointments_requests.request_id, 
                              patients.first_name AS patient_name, 
                              lab_appointments_requests.appointment_date AS RDate, 
                              lab_appointments_requests.appointment_time AS RTime, 
                              lab_appointments_requests.test_name AS test_type
                          FROM lab_appointments_requests
                          JOIN patients ON lab_appointments_requests.patient_id = patients.patient_id
                          WHERE lab_appointments_requests.lab_id = :lab_id 
                          AND lab_appointments_requests.status = 'pending'");
        
        $this->db->bind(':lab_id', $lab_id);
        return $this->db->resultSet(); // Returns an array of objects
    } 
    
    public function getAppointmentRequestById($request_id) {
        $this->db->query("SELECT * FROM lab_appointments_requests WHERE request_id = :request_id");
        $this->db->bind(':request_id', $request_id);
        return $this->db->single();
    }

    public function insertLabAppointment($data) {
        echo "Function called!";
        $this->db->query("INSERT INTO lab_appointments (patient_id, lab_id, appointment_date, appointment_time, status) 
                          VALUES (:patient_id, :lab_id, :appointment_date, :appointment_time, :status)");
        $this->db->bind(':patient_id', $data['patient_id']);
        $this->db->bind(':lab_id', $data['lab_id']);
        $this->db->bind(':appointment_date', $data['appointment_date']);
        $this->db->bind(':appointment_time', $data['appointment_time']);
        $this->db->bind(':status', $data['status']);
        
        $result = $this->db->execute();
    
        if ($result) {
            echo "Insert successful!";
        } else {
            echo "Insert failed!";
        }
    }
    
    
    public function getLastInsertedId() {
        return $this->db->lastInsertId();
    }
    
    public function insertTest($data) {
        $this->db->query("INSERT INTO tests (patient_id, lab_id, test_name, test_date, status, is_completed, start_time, end_time, appointment_id)
                          VALUES (:user_id, :lab_id, :test_name, :test_date, :status, :is_completed, :start_time, :end_time, :appointment_id)");
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':lab_id', $data['lab_id']);
        $this->db->bind(':test_name', $data['test_name']);
        $this->db->bind(':test_date', $data['test_date']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':is_completed', $data['is_completed']);
        $this->db->bind(':start_time', $data['start_time']);
        $this->db->bind(':end_time', $data['end_time']);
        $this->db->bind(':appointment_id', $data['appointment_id']);
        $this->db->execute();
    }
    
    public function deleteAppointmentRequest($request_id) {
        $this->db->query("DELETE FROM lab_appointments_requests WHERE request_id = :request_id");
        $this->db->bind(':request_id', $request_id);
        $this->db->execute();
    }
    
    public function cancelAppointmentRequest($request_id) {
        $this->db->query("UPDATE lab_appointments_requests SET status = 'cancelled' WHERE request_id = :request_id");
        $this->db->bind(':request_id', $request_id);
        return $this->db->execute();
    }

    public function getTotalAppointmentsToday($lab_id) {
        $this->db->query("SELECT COUNT(*) AS count FROM lab_appointments
                          WHERE lab_id = :lab_id AND appointment_date = CURDATE() ");
        $this->db->bind(':lab_id', $lab_id);
        return $this->db->single()->count;
    }

    public function getMissedAppointmentsCount($lab_id) {
        $this->db->query("SELECT COUNT(*) AS count FROM lab_appointments
                          WHERE lab_id = :lab_id AND status = 'in_progress' AND appointment_date < CURDATE()");
        $this->db->bind(':lab_id', $lab_id);
        return $this->db->single()->count;
    }

    public function getCancelledAppointments($lab_id) {
        $this->db->query("SELECT COUNT(*) AS count FROM lab_appointments
                          WHERE lab_id = :lab_id AND status = 'cancelled'");
        $this->db->bind(':lab_id', $lab_id);
        return $this->db->single()->count;
    }

    public function getAppointments($lab_id, $status = 'all', $appointment_date = null, $patient_name = '', $test_type = '') {
        $query = "SELECT 
                    lab_appointments.appointment_id, 
                    lab_appointments.patient_id, 
                    lab_appointments.appointment_date, 
                    lab_appointments.appointment_time, 
                    lab_appointments.status, 
                    patients.first_name AS patient_name, 
                    tests.test_name AS test_type
                  FROM lab_appointments
                  JOIN patients ON lab_appointments.patient_id = patients.patient_id
                  JOIN tests ON lab_appointments.appointment_id = tests.appointment_id
                  WHERE lab_appointments.lab_id = :lab_id";
    
        // Filter by status, if provided
        if ($status !== 'all') {
            $query .= " AND lab_appointments.status = :status";
        }
    
        // Filter by appointment date, if provided
        if ($appointment_date) {
            $query .= " AND lab_appointments.appointment_date = :appointment_date";
        }
    
        // Filter by patient name, if provided
        if ($patient_name) {
            $query .= " AND patients.first_name LIKE :patient_name";
        }
    
        // Filter by test type, if provided
        if ($test_type) {
            $query .= " AND tests.test_name LIKE :test_type";
        }
    
        // Prepare the query and bind parameters
        $this->db->query($query);
        $this->db->bind(':lab_id', $lab_id);
    
        if ($status !== 'all') {
            $this->db->bind(':status', $status);
        }
    
        if ($appointment_date) {
            $this->db->bind(':appointment_date', $appointment_date);
        }
    
        if ($patient_name) {
            $this->db->bind(':patient_name', "%" . $patient_name . "%");
        }
    
        if ($test_type) {
            $this->db->bind(':test_type', "%" . $test_type . "%");
        }
    
        return $this->db->resultSet();  // Get results from the database
    }
    
    
   // Function to get total revenue for today
public function getTotalRevenueToday($lab_id) {
    $this->db->query("SELECT SUM(payment_amount) AS total_revenue
                      FROM lab_payments
                      WHERE DATE(payment_date) = CURDATE() AND lab_id = :lab_id");
    $this->db->bind(':lab_id', $lab_id);
    return $this->db->single()->total_revenue;
}

// Function to get pending payments for a specific lab
public function getPendingPayments($lab_id) {
    $this->db->query("SELECT SUM(total_amount - paid_amount) AS pending_payments
                      FROM lab_invoices
                      WHERE status IN ('Unpaid', 'Partially Paid') AND lab_id = :lab_id");
    $this->db->bind(':lab_id', $lab_id);
    return $this->db->single()->pending_payments;
}

// Function to get total number of invoices
public function getTotalInvoices() {
    $this->db->query("SELECT COUNT(*) AS total_invoices
                      FROM lab_invoices");
    return $this->db->single()->total_invoices;
}

// Function to get total refunds/discounts for a specific lab
public function getRefundsDiscounts($lab_id) {
    $this->db->query("SELECT SUM(refund_amount) AS total_refunds
                      FROM lab_refunds
                      WHERE lab_id = :lab_id");
    $this->db->bind(':lab_id', $lab_id);
    return $this->db->single()->total_refunds;
}


public function getLabInvoices($lab_id) {
    $this->db->query("SELECT 
                          lab_invoices.invoice_id, 
                          patients.first_name AS patient_name, 
                          lab_invoices.created_at AS invoice_date, 
                          lab_invoices.total_amount, 
                          lab_invoices.status
                      FROM lab_invoices
                      JOIN patients ON lab_invoices.patient_id = patients.patient_id
                      WHERE lab_invoices.lab_id = :lab_id");

    $this->db->bind(':lab_id', $lab_id);
    return $this->db->resultSet(); // Returns an array of objects
}


public function getInvoiceById($invoice_id) {
    $this->db->query("
        SELECT 
            lab_invoices.invoice_id, 
            patients.first_name AS patient_name, 
            lab_invoices.created_at AS invoice_date, 
            lab_invoices.total_amount, 
            lab_invoices.status
        FROM lab_invoices
        JOIN patients ON lab_invoices.patient_id = patients.patient_id
        WHERE lab_invoices.invoice_id = :invoice_id
    ");
    $this->db->bind(':invoice_id', $invoice_id);
    return $this->db->single(); // returns a single object
}

public function insertPayment($data) {
    // Add missing column 'payment_status'
    $this->db->query("INSERT INTO lab_payments 
                      (invoice_id, payment_method, payment_amount, payment_date, lab_id, payment_status) 
                      VALUES (:invoice_id, :payment_method, :payment_amount, :payment_date, :lab_id, :payment_status)");

    // Bind the data to the query
    $this->db->bind(':invoice_id', $data['invoice_id']);
    $this->db->bind(':payment_method', $data['payment_method']);
    $this->db->bind(':payment_amount', $data['payment_amount']);
    $this->db->bind(':payment_date', $data['payment_date']);
    $this->db->bind(':lab_id', $data['lab_id']); // Lab ID
    $this->db->bind(':payment_status', $data['payment_status']); // Add the payment status, e.g., 'Completed' or 'Pending'

    // Execute the query to insert the payment
    return $this->db->execute();
}


public function updateInvoiceStatus($data) {
    $this->db->query("UPDATE lab_invoices 
                      SET status = :status, paid_amount = :paid_amount 
                      WHERE invoice_id = :invoice_id");
    $this->db->bind(':status', $data['status']);
    $this->db->bind(':paid_amount', $data['paid_amount']);
    $this->db->bind(':invoice_id', $data['invoice_id']);
    return $this->db->execute();  // Executes the query to update the invoice status
}

public function createInvoice($data) {
    // Prepare the SQL query to insert the invoice
    $sql = "INSERT INTO lab_invoices (appointment_id, patient_id, lab_id, total_amount, paid_amount, status, services, discount, created_at, updated_at) 
            VALUES (:appointment_id, :patient_id, :lab_id, :total_amount, :paid_amount, :status, :services, :discount, :created_at, :updated_at)";

    // Execute the query with the data passed
    $this->db->query($sql);
    
    // Bind the data to the query placeholders
    $this->db->bind(':appointment_id', $data['appointment_id']);
    $this->db->bind(':patient_id', $data['patient_id']);
    $this->db->bind(':lab_id', $data['lab_id']);
    $this->db->bind(':total_amount', $data['total_amount']);
    $this->db->bind(':paid_amount', $data['paid_amount']);
    $this->db->bind(':status', $data['status']);
    $this->db->bind(':services', $data['services']);
    $this->db->bind(':discount', $data['discount']);
    $this->db->bind(':created_at', date('Y-m-d H:i:s'));
    $this->db->bind(':updated_at', date('Y-m-d H:i:s'));

    // Execute and check if the insertion was successful
    if ($this->db->execute()) {
        return true;
    }
    return false;
}

public function getAllTestsForLab($lab_id) {
    // Prepare the query to fetch all tests for the given lab_id
    $this->db->query("SELECT t.*, p.*
FROM tests t
JOIN patients p ON t.patient_id = p.patient_id
WHERE t.lab_id = :lab_id;

    ");
    
    // Bind the lab_id parameter to prevent SQL injection
    $this->db->bind(':lab_id', $lab_id);

    // Execute the query and fetch the result set
    $result = $this->db->resultSet();

    // Check if any tests are found
    if (empty($result)) {
        // You can log the result or handle the case where no tests are found
        return []; // Return an empty array if no results are found
    }

    return $result;  // Return the result set (an array of tests)
}


public function searchLabs($searchTerm){
    $this->db->query("SELECT * FROM registered_labs WHERE name LIKE :searchTerm OR contact_person LIKE :searchTerm");
    $this->db->bind(':searchTerm', '%' . $searchTerm . '%');
    return $this->db->resultSet(); // Returns an array of objects
}

public function getAllLabs(){
    $this->db->query("SELECT * FROM registered_labs");
    return $this->db->resultSet(); // Returns an array of objects
}

public function getLabByLabId($lab_id) {
    $this->db->query("SELECT * FROM registered_labs WHERE lab_id = :lab_id");
    $this->db->bind(':lab_id', $lab_id);
    return $this->db->single(); // Returns a single object

}



    
}