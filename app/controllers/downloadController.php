<?php
// app/controllers/DownloadController.php

class DownloadController extends Controller {
    
    public function index() {
        // Check both GET and POST for the file parameter
        $file_path = $_GET['file'] ?? $_POST['file'] ?? '';
        $file_name = $_GET['name'] ?? $_POST['name'] ?? basename($file_path);

        // Debug information
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        if (empty($file_path)) {
            die('Error: No file specified');
        }

        // Echo debugging info - remove in production
        echo "Attempting to download: " . htmlspecialchars($file_path) . "<br>";
        echo "Download as: " . htmlspecialchars($file_name) . "<br>";
        echo "File exists: " . (file_exists($file_path) ? 'Yes' : 'No') . "<br>";
        
       
        // Verify the file exists
        if (!file_exists($file_path)) {
            die('File not found: ' . htmlspecialchars($file_path));
        }

        // Set headers for download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $file_name . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));

        // Clear output buffer
        if (ob_get_length()) {
            ob_end_clean();
        }
        flush();

        // Read file and output it
        readfile($file_path);
        exit;
    }
}