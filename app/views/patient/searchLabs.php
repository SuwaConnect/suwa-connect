<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Search | Health Record Management System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1976d2;
            --secondary-color: #f5f5f5;
            --text-color: #333;
            --border-color: #ddd;
            --shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        /* * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        } */
        

        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    list-style: none;
    text-decoration: none;
    font-family: 'Poppins', sans-serif;
    
}

body{
    display: flex;
    /* height: 100vh; */
    overflow-x: hidden;
    overflow-y: auto;
}

.main-content {
    background-color: #e6f2ff;
    color:#2e2e2e;
    padding: 20px;
    margin-left: 250px; /* To make space for the sidebar */
    padding: 20px;
    width: calc(100% - 250px); /* Take the remaining width */
    overflow-y: auto; /* Enable scrolling if content overflows vertically */
    flex-grow: 1;
    transition: margin-left 0.3s ease, width 0.3s ease; /* Smooth transition for content resize */
    justify-items: center;
}

.sideBar.collapsed + .main-content{

    margin-left:80px;
    width: calc(100% - 80px);
    overflow-y: auto;
}

        body {
            background-color: #f8f9fa;
            color: var(--text-color);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background-color: white;
            padding: 15px 0;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-color);
        }
        
        .search-section {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
        }
        
        h2 {
            margin-bottom: 15px;
        }
        
        .search-form {
            position: relative;
            margin-bottom: 20px;
        }
        
        .search-input-container {
            display: flex;
            position: relative;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border: 1px solid var(--border-color);
        }
        
        .search-input {
            flex: 1;
            padding: 12px 15px;
            border: none;
            font-size: 16px;
            outline: none;
        }
        
        .search-button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        
        .search-button:hover {
            background-color: #1565c0;
        }
        
        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .filter-select {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            background-color: white;
        }
        
        .results-info {
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: 500;
        }
        
        .pharmacy-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .pharmacy-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .pharmacy-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .pharmacy-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-bottom: 1px solid var(--border-color);
        }
        
        .pharmacy-details {
            padding: 15px;
        }
        
        .pharmacy-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--primary-color);
        }
        
        .pharmacy-address {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }
        
        .pharmacy-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }
        
        .operating-hours, .phone-number {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .badge {
            display: inline-block;
            padding: 4px 8px;
            background-color: #e8f5e9;
            color: #2e7d32;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            margin-right: 5px;
            margin-bottom: 5px;
        }
        
        .view-details {
            display: block;
            text-align: center;
            padding: 10px;
            background-color: var(--secondary-color);
            color: var(--primary-color);
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        
        .view-details:hover {
            background-color: #e0e0e0;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            gap: 5px;
        }
        
        .page-link {
            display: inline-block;
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            text-decoration: none;
            color: var(--text-color);
            background-color: white;
            transition: background-color 0.3s;
        }
        
        .page-link:hover, .page-link.active {
            background-color: var(--primary-color);
            color: white;
        }
        
        /* Responsive design */
        @media (max-width: 768px) {
            .filters {
                flex-direction: column;
            }
            
            .pharmacy-list {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }
        
        @media (max-width: 576px) {
            .pharmacy-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php include "navbar-patient.php";?>
    <div class="main-content">
        <div class="container">
            <div class="search-section">
                <h2>Find a Laboratory which suits well for your need...</h2>
                <div class="search-form">
                    <div class="search-input-container">
                        <input type="text" id="pharmacySearchInput" class="search-input" name="searchQuery" placeholder="Search by pharmacy name, location, or services..." required>
                        <button type="button" id="pharmacySearchButton" class="search-button">Search</button>
                    </div>
                </div>
            </div>
            
            <div class="results-section">
    <div class="results-info">
        
    </div>

    <div class="pharmacy-list">
        <?php if (!empty($data)): ?>
            <?php foreach ($data as $lab): ?>
                <div class="lab-card">
                    <img src="" alt="<?php echo $lab->name; ?>" class="pharmacy-image">
                    <div class="pharmacy-details">
                        <h3 class="pharmacy-name"><?php echo $lab->name; ?></h3>
                        <p class="pharmacy-address"><?php echo $lab->name; ?></p>
                        <div class="pharmacy-info">
                            <span class="operating-hours">Open: <?php echo $lab->name; ?></span>
                            <span class="phone-number"><?php echo $lab->name; ?></span>
                        </div>
                        <a href="<?php echo URLROOT; ?>patientController/makeLabAppointment/<?php echo $lab->lab_id; ?>" class="view-details">Select lab</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

        </div>
    </div>
    <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>
    <script>

        

        document.addEventListener('DOMContentLoaded', function() {
            // Get the necessary elements
            const searchInput = document.querySelector('#pharmacySearchInput');
            const searchButton = document.querySelector('#pharmacySearchButton');
            const resultsSection = document.querySelector('.results-section');
            const pharmacyList = document.querySelector('.pharmacy-list');
            const resultsInfo = document.querySelector('.results-info');

            // Add event listener for the search button
            searchButton.addEventListener('click', performSearch);
            
            // Add event listener for pressing Enter in the search input
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });

            function performSearch() {
                const searchQuery = searchInput.value.trim();
                if (searchQuery === '') return;
                
                // Show loading state
                pharmacyList.innerHTML = '<div class="loading">Searching pharmacies...</div>';
                
                // Send AJAX request
                fetch(`<?php echo URLROOT;?>patientController/searchLabs`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ searchQuery: searchQuery })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    updateResults(data.labs);
                })
                .catch(error => {
                    console.error('Error searching pharmacies:', error);
                    pharmacyList.innerHTML = '<div class="no-results"><p>An error occurred while searching. Please try again.</p></div>';
                });
            }
            
            // Function to update the results on the page
            function updateResults(labs) {
                // Update the results info
                resultsInfo.textContent = `${labs.length} laboratories found according to your search`;
                
                // Clear previous results
                pharmacyList.innerHTML = '';
                
                if (labs.length === 0) {
                    // No results
                    //pharmacyList.innerHTML = '<div class="no-results"><p>No pharmacies found matching your search criteria.</p></div>';
                    return;
                }
                
                // Loop through pharmacies and create cards
                labs.forEach(lab => {
                    const labCard = document.createElement('div');
                    labCard.className = 'pharmacy-card';
                    
                    // Create services badges if services exist
                    // let servicesBadges = '';
                    // if (pharmacy.services) {
                    //     const servicesArray = pharmacy.services.split(',');
                    //     servicesArray.forEach(service => {
                    //         servicesBadges += `<span class="badge">${service.trim()}</span>`;
                    //     });
                    // }
                    
                    // Set the image source - use placeholder if no image
                    const imageUrl = lab.image_url && lab.image_url.trim() !== '' 
                        ? lab.image_url 
                        : '/api/placeholder/400/320';
                    
                    // Build the HTML for the pharmacy card
                    labCard.innerHTML = `
                        <img src="${imageUrl}" alt="${lab.name}" class="pharmacy-image">
                        <div class="pharmacy-details">
                            <h3 class="pharmacy-name">${lab.name}</h3>
                            <p class="pharmacy-address"></p>
                            <div class="pharmacy-info">
                                <span class="operating-hours">Open: </span>
                                <span class="phone-number"></span>
                            </div>
                            
                            <a href="<?php echo URLROOT;?>patientController/makeLabAppointment/${lab.lab_id}" class="view-details">Select lab</a>
                        </div>
                    `;
                    
                    // Add the card to the pharmacy list
                    pharmacyList.appendChild(labCard);
                });
            }
        });
    </script>
</body>
</html>