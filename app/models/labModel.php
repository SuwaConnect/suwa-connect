class labModel {
    private $db;

    public function __construct() {
        $this->db = new Database();  // Assuming Database class is already defined
    }

    public function addPendingLab($data) {
        // SQL query to insert into pending_labs table
        $sql = "INSERT INTO pending_labs (name, contact_person, email, contact_number, lab_reg_number, lab_certificate, password, terms_accepted) 
                VALUES (:name, :contact_person, :email, :contact_number, :lab_reg_number, :lab_certificate, :password, :terms_accepted)";

        // Prepare the statement
        $stmt = $this->db->prepare($sql);

        // Bind the parameters
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':contact_person', $data['contact_person']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':contact_number', $data['contact_number']);
        $stmt->bindParam(':lab_reg_number', $data['lab_reg_number']);
        $stmt->bindParam(':lab_certificate', $data['lab_certificate']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':terms_accepted', $data['terms_accepted'], PDO::PARAM_INT);

        // Execute and return the result (true or false)
        return $stmt->execute();
    }
}
