<?php

// Create connection
$conn = mysqli_connect('localhost','root','','techdrivelab');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $carModel = $_POST['carModel'];
    $serviceType = $_POST['serviceType'];
    $date = $_POST['date'];
    $message = $_POST['message'];

    // Check if the phone number already exists
    $checkPhoneQuery = "SELECT * FROM booking WHERE phone = ?";
    $checkStmt = $conn->prepare($checkPhoneQuery);
    $checkStmt->bind_param("s", $phone);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        // Phone number already exists
        echo "<script>alert('This phone number is already registered. Please use a different one.');</script>";
    } else {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO booking (fullname, email, phone, carModel, serviceType, date, message) VALUES (?, ?, ?, ?, ?, ?, ?)");

        // Bind parameters: all are strings
        $stmt->bind_param("sssssss", $name, $email, $phone, $carModel, $serviceType, $date, $message);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('Booking successfully created!');</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close the statement
    $checkStmt->close();
    $stmt->close();
}

// Close the connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Now</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Trebuchet MS', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('WhatsApp Image 2024-09-14 at 3.18.35 PM.jpeg') no-repeat center center/cover;
        }

        .video-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        #bgVideo {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        form {
            width: 400px;
            background: rgba(0, 0, 0, 0.5); /* Increased transparency */
            padding: 30px;
            border-radius: 12px;
            color: white;
            text-align: center;
        }

        h1 {
            margin-bottom: 30px;
            font-size: 32px;
        }

        .input-box {
            margin-bottom: 20px;
        }

        .input-box input, .input-box select, .input-box textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #fff;
            border-radius: 8px;
            background: transparent;
            color: white;
            font-size: 16px;
        }

        .input-box select {
            height: 50px;
        }

        .input-box textarea {
            resize: none;
        }

        .btn {
            width: 100%;
            background: white;
            color: black;
            border: none;
            padding: 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn:hover {
            background: #ddd;
        }
    </style>
</head>
<body>
    <div class="video-container">
        <video autoplay muted loop id="bgVideo">
            <source src="bg videos/feedback bg.mp4" type="video/mp4">
        </video>
    </div>

    <form action="" method="post">
        <h1>Book Now</h1>
        <div class="input-box">
            <input type="text" id="name" name="name" placeholder="Enter your full name" required>
        </div>
        <div class="input-box">
            <input type="email" id="email" name="email" placeholder="Enter your email address" required>
        </div>
        <div class="input-box">
            <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
        </div>
        <div class="input-box">
            <input type="text" id="carModel" name="carModel" placeholder="Enter your car model" required>
        </div>
        <div class="input-box">
            <select id="serviceType" name="serviceType" required>
                <option value="">Select Service Type</option>
                <option value="Full Automation">Full Automation</option>
                <option value="Partial Automation">Partial Automation</option>
                <option value="Smart Accessories">Smart Accessories Installation</option>
            </select>
        </div>
        <div class="input-box">
            <input type="date" id="date" name="date" required>
        </div>
        <div class="input-box">
            <textarea id="message" name="message" rows="4" placeholder="Additional Comments"></textarea>
        </div>
        <div class="input-box">
            <button type="submit" class="btn">Book Now</button>
        </div>
    </form>
</body>
</html>
