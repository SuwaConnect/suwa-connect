<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>homepage</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?php echo URLROOT;?>public/css/doctor/viewHealthRecord.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  
</head>
<body>

<?php include 'navbar-patient.php'; ?>

  <div class="main-content">
    <div class="header">
      <div class="patient-info">
        <div class="patient-avatar">

        <img id="profilePreview" class="profile-image" src="<?php if(isset($data['doctor']->profile_picture_name)){
                            echo URLROOT.'public/uploads/profile_pictures/doctor/'.$data['doctor']->profile_picture_name;
                        }  else {
                            echo URLROOT.'public/images/doctor/images/profile.png';
                        }?>" alt="Doctor profile">
        </div>
        <div class="patient-details">
          <p>consulted by: </p>
          <h1><?php echo 'Dr'.$data['doctor']->firstName.' '.$data['doctor']->lastName ?></h1>
          <p>
                <?php echo $data['doctor']->specialization ;?> 
            </p>
          <p>consulted on : | <?php echo $data['healthRecord']->created_at?></p>
          <!-- <p>Blood Type: O+</p> -->
        </div>
      </div>
      <div class="record-actions">
        <!-- <button class="action-btn primary-btn">Edit Record</button>
        <button class="action-btn secondary-btn">Print Record</button>
        <button class="action-btn danger-btn">Share Record</button> -->
      </div>
    </div>
    
    <div class="tabs">
      <div class="tab active" data-tab="vitals">Vital Signs</div>
      <div class="tab" data-tab="visits">Visits</div>
      <div class="tab" data-tab="reports">Reports</div>
      <div class="tab" data-tab="prescriptions">Prescriptions</div>
    </div>
    
    <!-- Vital Signs Tab -->
    <div class="tab-content active" id="vitals">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20.42 4.58a5.4 5.4 0 0 0-7.65 0l-.77.78-.77-.78a5.4 5.4 0 0 0-7.65 0C1.46 6.7 1.33 10.28 4 13l8 8 8-8c2.67-2.72 2.54-6.3.42-8.42z"></path>
            </svg>
            Vital Signs
          </div>
          <!-- <button class="action-btn secondary-btn">Add Vitals</button> -->
        </div>
        
        <div class="vital-signs">
          <div class="vital-card">
            <div class="vital-title">Blood Pressure</div>
            <div class="vital-value"><?php echo ($data['vitalSigns']->systolic . " / " . $data['vitalSigns']->diastolic); ?>
            <span class="vital-unit">mmHg</span></div>
            <div class="vital-date">Apr 5, 2025 - 10:30 AM</div>
            <!-- <div class="vital-trend trend-neutral">&#8212;</div> -->
          </div>
          
          <div class="vital-card">
            <div class="vital-title">Heart Rate</div>
            <div class="vital-value">72 <span class="vital-unit">bpm</span></div>
            <div class="vital-date">Apr 5, 2025 - 10:30 AM</div>
            <!-- <div class="vital-trend trend-down">&#9660; 5</div> -->
          </div>
          
          <div class="vital-card">
            <div class="vital-title">Temperature</div>
            <div class="vital-value"><?php echo $data['vitalSigns']->temperature ?> <span class="vital-unit">°F</span></div>
            <div class="vital-date">Apr 5, 2025 - 10:30 AM</div>
            <!-- <div class="vital-trend trend-neutral">&#8212;</div> -->
          </div>
          
          <!-- <div class="vital-card">
            <div class="vital-title">Oxygen Saturation</div>
            <div class="vital-value">98 <span class="vital-unit">%</span></div>
            <div class="vital-date">Apr 5, 2025 - 10:30 AM</div>
            <div class="vital-trend trend-up">&#9650; 2</div>
          </div> -->
          
          <div class="vital-card">
            <div class="vital-title">Blood Sugar (Fasting)</div>
            <div class="vital-value"><?php echo $data['vitalSigns']->blood_sugar ?> <span class="vital-unit">mg/dL</span></div>
            <div class="vital-date">Apr 5, 2025 - 07:30 AM</div>
            <!-- <div class="vital-trend trend-down">&#9660; 12</div> -->
          </div>
          
          <div class="vital-card">
            <div class="vital-title">Cholesterol (Total)</div>
            <div class="vital-value"><?php echo $data['vitalSigns']->cholesterol ?> <span class="vital-unit">mg/dL</span></div>
            <div class="vital-date">Mar 22, 2025 - 09:45 AM</div>
            <!-- <div class="vital-trend trend-down">&#9660; 15</div> -->
          </div>
          
          <div class="vital-card">
            <div class="vital-title">Weight</div>
            <div class="vital-value"><?php echo $data['vitalSigns']->weight ?> <span class="vital-unit">lbs</span></div>
            <div class="vital-date">Apr 5, 2025 - 10:30 AM</div>
            <!-- <div class="vital-trend trend-down">&#9660; 3</div> -->
          </div>
          
          <div class="vital-card">
            <div class="vital-title">BMI</div>
            <div class="vital-value">24.8 <span class="vital-unit"></span></div>
            <div class="vital-date">Apr 5, 2025 - 10:30 AM</div>
            <!-- <div class="vital-trend trend-down">&#9660; 0.4</div> -->
          </div>
        </div>
      </div>
    </div>
    
    <!-- Visits Tab -->
     <div class="tab-content" id="visits">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
              <line x1="16" y1="2" x2="16" y2="6"></line>
              <line x1="8" y1="2" x2="8" y2="6"></line>
              <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            Recent Visits
          </div>
          <!-- <button class="action-btn secondary-btn">Add Visit</button> -->
        </div>
        
        <div class="visit-list">
    
          <?php
            $timestamp = $data['healthRecord']->created_at; // assuming the timestamp is stored in 'created_at'
            $date = new DateTime($timestamp);

            $month = strtoupper($date->format('M')); 
            $day = $date->format('d');               
            $year = $date->format('Y');              
            ?>
          
           <div class="visit-item">
            <div class="visit-date">
              <div class="visit-month"><?php echo $month;?></div>
              <div class="visit-day"><?php echo $day;?></div>
              <div class="visit-year"><?php echo $year;?></div>
            </div>
            <div class="visit-info">
              <div class="visit-doctor"><?php echo $data['healthRecord']->doctor_name?></div>
              <div class="visit-complaint"><?php echo $data['healthRecord']->chief_complaint?></div>
              <div class="visit-diagnosis"><?php echo $data['healthRecord']->diagnosis?></div>
              <div class="notes">
                <p><?php echo $data['healthRecord']->additional_notes?></p>
              </div>
            </div>
            <div class="visit-actions">
              <!-- <button class="action-btn secondary-btn">Edit</button> -->
            </div>
          </div> 


        </div>
      </div>
    </div> 
    
   

    <div class="tab-content" id="reports">
  <div class="card">
    <div class="card-header">
      <div class="card-title">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
          <polyline points="14 2 14 8 20 8"></polyline>
          <line x1="16" y1="13" x2="8" y2="13"></line>
          <line x1="16" y1="17" x2="8" y2="17"></line>
          <polyline points="10 9 9 9 8 9"></polyline>
        </svg>
        Medical Reports
      </div>
      <button class="action-btn secondary-btn">Upload Report</button>
    </div>
    
    <div class="reports-grid">
      <?php 
      // Check if reports exist
      if (!empty($data['reports'])) {
        // Loop through each report in the reports array
        foreach ($data['reports'] as $report) {
          // Convert server path to web path
          $server_path = $report->file_path;
          
          // Extract the path after 'uploads'
          $parts = explode('uploads', $server_path);
          $relative_path = isset($parts[1]) ? ltrim($parts[1], '/\\') : basename($server_path);
          
          // Determine the file extension
          $file_extension = pathinfo($server_path, PATHINFO_EXTENSION);
          $is_image = in_array(strtolower($file_extension), ['jpg', 'jpeg', 'png', 'gif']);
          $is_pdf = strtolower($file_extension) == 'pdf';
          
          // Get the filename for download
          $filename = pathinfo($server_path, PATHINFO_BASENAME);
          ?>
          <div class="report-card">
            <div class="report-image">
              <?php if ($is_image): ?>
                <img src="<?php echo URLROOT . '/public/uploads/' . $relative_path; ?>" alt="<?php echo htmlspecialchars($report->title ?? 'Medical Report'); ?>" />
              <?php elseif ($is_pdf): ?>
                <div class="report-icon pdf">
                  <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                  </svg>
                </div>
              <?php else: ?>
                <div class="report-icon">
                  <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                  </svg>
                </div>
              <?php endif; ?>
            </div>
            <div class="report-details">
              <div class="report-type"><?php echo htmlspecialchars($report->type ?? 'Report'); ?></div>
              <div class="report-title"><?php echo htmlspecialchars($report->title ?? 'Medical Report'); ?></div>
              <div class="report-date"><?php echo htmlspecialchars($report->date ?? date('M d, Y')); ?></div>
              
              <div class="report-actions">
                <a href="<?php echo URLROOT . '/public/uploads/' . $relative_path; ?>" class="action-btn view-btn" target="_blank">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                  </svg>
                  View
                </a>
                
                <a href="<?php echo URLROOT; ?>downloadController?file=<?php echo urlencode($report->file_path); ?>&name=<?php echo urlencode(($report->title ?? 'Report') . '.' . $file_extension); ?>" class="action-btn download-btn">
  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
    <polyline points="7 10 12 15 17 10"></polyline>
    <line x1="12" y1="15" x2="12" y2="3"></line>
  </svg>
  Download
</a>
              </div>
            </div>
          </div>
          <?php
        }
      } else {
        // Display a message if no reports are found
        echo '<div class="no-reports">No medical reports available.</div>';
      }
      ?>
    </div>
  </div>
</div>
    
    <!-- Prescriptions Tab -->
    <div class="tab-content" id="prescriptions">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path>
              <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path>
            </svg>
            Prescriptions
          </div>
          <
          <a href="<?php echo URLROOT .'patientcontroller/sendPrescriptionToPharmacy/'.$data['healthRecord']->record_id?>" class="action-btn secondary-btn">Send Prescription</a>
        </div>
        
        <div class="prescription-list">
          <div class="prescription-card">
            <div class="prescription-header">
              <div class="prescription-title">
                <span class="badge badge-success">Active</span>
              </div>
              <div class="prescription-date">
                <!-- <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                  <line x1="16" y1="2" x2="16" y2="6"></line>
                  <line x1="8" y1="2" x2="8" y2="6"></line>
                  <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg> -->
                Apr 5, 2025
              </div>
            </div>
            <div class="prescription-details">
              <div class="prescription-doctor"><?php echo $data['healthRecord']->doctor_name?></div>
              
              <div class="medicine-list">
              <div class="medicine-list">
  <?php if (!empty($data['prescription'])): ?>
    <?php foreach ($data['prescription'] as $medicine): ?>
      <div class="medicine-item">
        <div class="medicine-info">
          <div class="medicine-name"><?php echo htmlspecialchars($medicine->medicine_name); ?></div>
          <div class="medicine-dosage"><?php echo htmlspecialchars($medicine->medicine_dosage); ?></div>
        </div>
        <div>
          <div class="medicine-schedule"></div>
          <div class="medicine-duration">Refills: </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>No prescriptions found.</p>
  <?php endif; ?>
</div>

                </div>

              <div class="notes">
                <p></p>
              </div>
            </div>
          </div>
          

        </div>
      </div>
    </div>

    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>

    
    <script>
      // Tab switching functionality
      const tabs = document.querySelectorAll('.tab');
      const tabContents = document.querySelectorAll('.tab-content');
      
      tabs.forEach(tab => {
        tab.addEventListener('click', () => {
          const tabId = tab.getAttribute('data-tab');
          
          // Update active tab
          tabs.forEach(t => t.classList.remove('active'));
          tab.classList.add('active');
          
          // Update tab content
          tabContents.forEach(content => {
            content.classList.remove('active');
            if (content.id === tabId) {
              content.classList.add('active');
            }
          });
        });
      });
      
      // Simulate data loading with simple animations
      document.addEventListener('DOMContentLoaded', () => {
        // Add fade-in effect to elements
        const fadeElements = document.querySelectorAll('.card, .visit-item, .report-card, .prescription-card');
        
        fadeElements.forEach((element, index) => {
          element.style.opacity = '0';
          element.style.transform = 'translateY(10px)';
          element.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
          
          setTimeout(() => {
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
          }, 100 + (index * 50));
        });
      });
      
      //View Report Modal Functionality
      
      
      // Sample data for vital signs chart (could be expanded in a real application)
      // const vitalData = {
      //   bloodPressure: [
      //     { date: '2025-01-10', value: '130/85' },
      //     { date: '2025-02-14', value: '128/82' },
      //     { date: '2025-03-22', value: '125/80' },
      //     { date: '2025-04-05', value: '120/80' }
      //   ],
      //   heartRate: [
      //     { date: '2025-01-10', value: 78 },
      //     { date: '2025-02-14', value: 75 },
      //     { date: '2025-03-22', value: 77 },
      //     { date: '2025-04-05', value: 72 }
      //   ],
      //   weight: [
      //     { date: '2025-01-10', value: 180 },
      //     { date: '2025-02-14', value: 178 },
      //     { date: '2025-03-22', value: 175 },
      //     { date: '2025-04-05', value: 172 }
      //   ]
      // };
      
      // Add vitals card click functionality
      const vitalCards = document.querySelectorAll('.vital-card');
      
      vitalCards.forEach(card => {
        card.addEventListener('click', function() {
          const vitalTitle = this.querySelector('.vital-title').textContent;
          // In a real application, this would open a detailed chart view
          console.log('Viewing history for:', vitalTitle);
          alert(`Viewing ${vitalTitle} history over time`);
        });
      });
      
      // Add search functionality
      function setupSearchFunctionality() {
        // This would be implemented in a real application
        console.log('Search functionality initialized');
      }
      
      // Add filter functionality
      function setupFilterFunctionality() {
        // This would be implemented in a real application
        console.log('Filter functionality initialized');
      }
      
      // Initialize the demo functionality
      setupSearchFunctionality();
      setupFilterFunctionality();
    </script>
  </div>
</body>
</html>