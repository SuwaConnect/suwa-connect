<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Health Record Form</title>
    <style>
        /* General Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            padding: 20px;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        
        h2 {
            color: #2563eb;
            text-align: center;
            margin-bottom: 25px;
            font-size: 28px;
        }
        
        /* Form Layout */
        .grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
        }
        
        @media (min-width: 768px) {
            .grid {
                grid-template-columns: 1fr 1fr;
            }
            
            .col-span-2 {
                grid-column: span 2;
            }
        }
        
        /* Section Styles */
        .section {
            margin-bottom: 24px;
        }
        
        .section-header {
            display: flex;
            align-items: center;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 12px;
        }
        
        .section-header svg {
            margin-right: 8px;
        }
        
        /* Input Styles */
        .input-group {
            display: flex;
            margin-bottom: 8px;
        }
        
        .input-group input[type="text"],
        .input-group input[type="tel"],
        select {
            flex-grow: 1;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 4px 0 0 4px;
            font-size: 16px;
            outline: none;
        }
        
        select, 
        input[type="text"].full-width,
        input[type="tel"].full-width {
            width: 100%;
            border-radius: 4px;
        }
        
        .input-group input[type="text"]:focus,
        .input-group input[type="tel"]:focus,
        select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.3);
        }
        
        /* Button Styles */
        .btn {
            padding: 10px 16px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            font-weight: 500;
        }
        
        .btn-remove {
            background-color: #ef4444;
            color: white;
            border-radius: 0 4px 4px 0;
        }
        
        .btn-remove:hover {
            background-color: #dc2626;
        }
        
        .btn-add {
            background-color: #3b82f6;
            color: white;
            margin-top: 8px;
        }
        
        .btn-add:hover {
            background-color: #2563eb;
        }
        
        .btn-submit {
            background-color: #2563eb;
            color: white;
            padding: 12px 24px;
            font-size: 18px;
            display: flex;
            align-items: center;
            margin: 40px auto 0;
        }
        
        .btn-submit:hover {
            background-color: #1d4ed8;
        }
        
        .btn-submit svg {
            margin-right: 8px;
        }
        
        /* Checkbox Styles */
        .checkbox-group {
            margin-bottom: 8px;
        }
        
        .checkbox-group label {
            margin-left: 8px;
        }
        
        /* Emergency Contact */
        .emergency-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
        }
        
        @media (min-width: 768px) {
            .emergency-grid {
                grid-template-columns: 1fr 1fr 1fr;
            }
        }
        
        .emergency-group label {
            display: flex;
            align-items: center;
            margin-bottom: 6px;
        }
        
        .emergency-group label svg {
            margin-right: 6px;
        }
        
        /* Success Message */
        .success-message {
            background-color: #dcfce7;
            border: 1px solid #86efac;
            color: #166534;
            padding: 12px 16px;
            border-radius: 4px;
            margin-bottom: 16px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Patient Health Record</h2>
        
        <div id="successMessage" class="success-message">
            Your health information has been successfully updated!
        </div>
        
        <form id="healthRecordForm">
            <div class="grid">
                <!-- Chronic Conditions -->
                <div class="col-span-2 section">
                    <div class="section-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19.5 12.572l-7.5 7.428-7.5-7.428m0 0a5 5 0 1 1 7.5-6.566 5 5 0 1 1 7.5 6.566"></path>
                        </svg>
                        <span>Chronic Conditions</span>
                    </div>
                    <div id="chronicConditionsContainer">
                        <div class="input-group">
                            <input type="text" name="chronicConditions[]" placeholder="e.g., diabetes, hypertension">
                            <button type="button" class="btn btn-remove" onclick="removeInput(this)">Remove</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-add" onclick="addInput('chronicConditionsContainer', 'chronicConditions[]', 'Chronic Condition')">
                        Add Chronic Condition
                    </button>
                </div>
                
                <!-- Past Surgeries -->
                <div class="section">
                    <div class="section-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2a2 2 0 0 0-2 2v18l4-4 4 4V4a2 2 0 0 0-2-2h-4z"></path>
                        </svg>
                        <span>Past Surgeries</span>
                    </div>
                    <div id="pastSurgeriesContainer">
                        <div class="input-group">
                            <input type="text" name="pastSurgeries[]" placeholder="e.g., appendectomy 2020">
                            <button type="button" class="btn btn-remove" onclick="removeInput(this)">Remove</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-add" onclick="addInput('pastSurgeriesContainer', 'pastSurgeries[]', 'Past Surgery')">
                        Add Past Surgery
                    </button>
                </div>
                
                <!-- Previous Hospitalizations -->
                <div class="section">
                    <div class="section-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="4" width="20" height="16" rx="2" ry="2"></rect>
                            <path d="M8 2v4"></path>
                            <path d="M16 2v4"></path>
                            <path d="M12 10v6"></path>
                            <path d="M9 13h6"></path>
                        </svg>
                        <span>Previous Hospitalizations</span>
                    </div>
                    <div id="hospitalizationsContainer">
                        <div class="input-group">
                            <input type="text" name="hospitalizations[]" placeholder="e.g., pneumonia Feb 2023">
                            <button type="button" class="btn btn-remove" onclick="removeInput(this)">Remove</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-add" onclick="addInput('hospitalizationsContainer', 'hospitalizations[]', 'Hospitalization')">
                        Add Hospitalization
                    </button>
                </div>
                
                <!-- Allergies -->
                <div class="col-span-2 section">
                    <div class="section-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#eab308" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path>
                            <line x1="12" y1="9" x2="12" y2="13"></line>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                        <span>Allergies</span>
                    </div>
                    <div id="allergiesContainer">
                        <div class="input-group">
                            <input type="text" name="allergies[]" placeholder="e.g., penicillin, peanuts">
                            <button type="button" class="btn btn-remove" onclick="removeInput(this)">Remove</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-add" onclick="addInput('allergiesContainer', 'allergies[]', 'Allergy')">
                        Add Allergy
                    </button>
                </div>
                
                <!-- Family Medical History -->
                <div class="col-span-2 section">
                    <div class="section-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#8b5cf6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span>Family Medical History</span>
                    </div>
                    <div id="familyHistoryContainer">
                        <div class="input-group">
                            <input type="text" name="familyHistory[]" placeholder="e.g., heart disease (father)">
                            <button type="button" class="btn btn-remove" onclick="removeInput(this)">Remove</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-add" onclick="addInput('familyHistoryContainer', 'familyHistory[]', 'Family History Item')">
                        Add Family History Item
                    </button>
                </div>
                
                <!-- Smoking Status -->
                <div class="section">
                    <div class="section-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6b7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 12H2v4h16"></path>
                            <path d="M22 12v4"></path>
                            <path d="M7 12v4"></path>
                            <path d="M18 8c0-2.5-2-2.5-2-5"></path>
                            <path d="M22 8c0-2.5-2-2.5-2-5"></path>
                        </svg>
                        <span>Smoking Status</span>
                    </div>
                    <select name="smokingStatus">
                        <option value="">-- Select --</option>
                        <option value="non-smoker">Non-smoker</option>
                        <option value="former-smoker">Former Smoker</option>
                        <option value="occasional">Occasional Smoker</option>
                        <option value="regular">Regular Smoker</option>
                    </select>
                </div>
                
                <!-- Alcohol Consumption -->
                <div class="section">
                    <div class="section-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M8 22h8"></path>
                            <path d="M7 10h10"></path>
                            <path d="M12 15v7"></path>
                            <path d="M12 15a5 5 0 0 0 5-5c0-2-.5-4-2-8H9c-1.5 4-2 6-2 8a5 5 0 0 0 5 5Z"></path>
                        </svg>
                        <span>Alcohol Consumption</span>
                    </div>
                    <select name="alcoholConsumption">
                        <option value="">-- Select --</option>
                        <option value="none">None</option>
                        <option value="occasional">Occasional</option>
                        <option value="moderate">Moderate</option>
                        <option value="regular">Regular</option>
                    </select>
                </div>
                
                <!-- Physical Activity Level -->
                <div class="section">
                    <div class="section-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                        </svg>
                        <span>Physical Activity Level</span>
                    </div>
                    <select name="physicalActivityLevel">
                        <option value="">-- Select --</option>
                        <option value="sedentary">Sedentary</option>
                        <option value="light">Light</option>
                        <option value="moderate">Moderate</option>
                        <option value="active">Active</option>
                        <option value="very-active">Very Active</option>
                    </select>
                </div>
                
                <!-- Dietary Preferences -->
                <div class="section">
                    <div class="section-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#92400e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 8h1a4 4 0 1 1 0 8h-1"></path>
                            <path d="M3 8h14v9a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4Z"></path>
                            <line x1="6" y1="2" x2="6" y2="4"></line>
                            <line x1="10" y1="2" x2="10" y2="4"></line>
                            <line x1="14" y1="2" x2="14" y2="4"></line>
                        </svg>
                        <span>Dietary Preferences</span>
                    </div>
                    <div id="dietaryPreferences">
                        <div class="checkbox-group">
                            <input type="checkbox" id="diet-regular" name="dietaryPreferences[]" value="Regular">
                            <label for="diet-regular">Regular</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" id="diet-vegetarian" name="dietaryPreferences[]" value="Vegetarian">
                            <label for="diet-vegetarian">Vegetarian</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" id="diet-vegan" name="dietaryPreferences[]" value="Vegan">
                            <label for="diet-vegan">Vegan</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" id="diet-keto" name="dietaryPreferences[]" value="Keto">
                            <label for="diet-keto">Keto</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" id="diet-paleo" name="dietaryPreferences[]" value="Paleo">
                            <label for="diet-paleo">Paleo</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" id="diet-gluten-free" name="dietaryPreferences[]" value="Gluten-Free">
                            <label for="diet-gluten-free">Gluten-Free</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" id="diet-dairy-free" name="dietaryPreferences[]" value="Dairy-Free">
                            <label for="diet-dairy-free">Dairy-Free</label>
                        </div>
                    </div>
                </div>
                
                <!-- Sleep Habits -->
                <div class="section">
                    <div class="section-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4f46e5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
                        </svg>
                        <span>Sleep Habits</span>
                    </div>
                    <select name="sleepHabits">
                        <option value="">-- Select --</option>
                        <option value="less-than-6">Less than 6 hours</option>
                        <option value="6-8">6-8 hours</option>
                        <option value="more-than-8">More than 8 hours</option>
                        <option value="irregular">Irregular pattern</option>
                    </select>
                </div>
                
                <!-- Emergency Contact -->
                <div class="col-span-2 section">
                    <div class="section-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <span>Emergency Contact</span>
                    </div>
                    <div class="emergency-grid">
                        <div class="emergency-group">
                            <label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                Name
                            </label>
                            <input type="text" name="emergencyContactName" class="full-width">
                        </div>
                        <div class="emergency-group">
                            <label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                Relationship
                            </label>
                            <input type="text" name="emergencyContactRelationship" class="full-width">
                        </div>
                        <div class="emergency-group">
                            <label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                Phone
                            </label>
                            <input type="tel" name="emergencyContactPhone" class="full-width">
                        </div>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                    <polyline points="7 3 7 8 15 8"></polyline>
                </svg>
                Save Health Information
            </button>
        </form>
    </div>

    <script>
        // Function to add a new input field
        function addInput(containerId, inputName, placeholder) {
            const container = document.getElementById(containerId);
            const newInputGroup = document.createElement('div');
            newInputGroup.className = 'input-group';
            
            newInputGroup.innerHTML = `
                <input type="text" name="${inputName}" placeholder="Enter ${placeholder}">
                <button type="button" class="btn btn-remove" onclick="removeInput(this)">Remove</button>
            `;
            
            container.appendChild(newInputGroup);
        }
        
        // Function to remove an input field
        function removeInput(button) {
            const inputGroup = button.parentElement;
            const container = inputGroup.parentElement;
            
            // Don't remove if it's the last input
            if (container.getElementsByClassName('input-group').length > 1) {
                container.removeChild(inputGroup);
            } else {
                // Clear the value if it's the last input
                inputGroup.querySelector('input').value = '';
            }
        }
        
        // Form submission handler
        document.getElementById('healthRecordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Collect form data
            const formData = new FormData(this);
            const data = {};
            
            // Group multiple values for array inputs
            for (const [key, value] of formData.entries()) {
                // Check if the key ends with [] for array inputs
                if (key.endsWith('[]')) {
                    const cleanKey = key.slice(0, -2);
                    if (!data[cleanKey]) {
                        data[cleanKey] = [];
                    }
                    if (value.trim() !== '') {
                        data[cleanKey].push(value);
                    }
                } else {
                    data[key] = value;
                }
            }
            
            // Handle checkboxes separately since they only appear in FormData when checked
            data.dietaryPreferences = [];
            document.querySelectorAll('input[name="dietaryPreferences[]"]:checked').forEach(checkbox => {
                data.dietaryPreferences.push(checkbox.value);
            });
            
            // Store emergency contact as an object
            data.emergencyContact = {
                name: data.emergencyContactName || '',
                relationship: data.emergencyContactRelationship || '',
                phone: data.emergencyContactPhone || ''
            };
            
            // Remove individual emergency contact fields
            delete data.emergencyContactName;
            delete data.emergencyContactRelationship;
            delete data.emergencyContactPhone;
            
            console.log('Form submitted:', data);
            
            // Show success message
            const successMessage = document.getElementById('successMessage');
            successMessage.style.display = 'block';
            
            // Hide success message after 3 seconds
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 3000);
        });
    </script>
</body>
</html>