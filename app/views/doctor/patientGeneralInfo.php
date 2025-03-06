<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient General Information</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #34495e;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        input[type="tel"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        .row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .col {
            flex: 1;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            margin-top: 20px;
        }

        button:hover {
            background-color: #2980b9;
        }

        .nav-links {
            text-align: center;
            margin-top: 20px;
        }

        .nav-links a {
            color: #3498db;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Patient General Information</h1>
        <form>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="bloodType">Blood Type</label>
                        <select id="bloodType" required>
                            <option value="">Select Blood Type</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="allergies">Allergies</label>
                <textarea id="allergies" placeholder="List any allergies..."></textarea>
            </div>

            <div class="form-group">
                <label for="chronicConditions">Chronic Conditions</label>
                <textarea id="chronicConditions" placeholder="List any chronic conditions..."></textarea>
            </div>

            <div class="form-group">
                <label for="surgeryHistory">Surgery History</label>
                <textarea id="surgeryHistory" placeholder="List previous surgeries with dates..."></textarea>
            </div>

            <div class="form-group">
                <label for="familyHistory">Family Medical History</label>
                <textarea id="familyHistory" placeholder="Relevant family medical history..."></textarea>
            </div>

            <button type="submit">Save Information</button>
        </form>

        <div class="nav-links">
            <a href="visit-record.html">Go to Visit Record</a>
        </div>
    </div>
</body>
</html>