<?php
session_start();

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'techdrivelab');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Decode incoming JSON request
    $data = json_decode(file_get_contents("php://input"), true);
    
    // Extract form inputs and sanitize
    $username = htmlspecialchars(trim($data['username'] ?? ''));
    $email = htmlspecialchars(trim($data['email'] ?? ''));
    $feedback = htmlspecialchars(trim($data['feedback'] ?? ''));

    // Validate inputs
    if (empty($username) || empty($email) || empty($feedback)) {
        $response['status'] = "error";
        $response['message'] = "Please fill in all fields.";
    } elseif (!preg_match("/^[a-zA-Z0-9_]{8,}$/", $username)) {
        $response['status'] = "error";
        $response['message'] = "Username must be at least 8 characters.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['status'] = "error";
        $response['message'] = "Invalid Email Format.";
    } elseif (strlen($feedback) < 10) {
        $response['status'] = "error";
        $response['message'] = "Feedback must be at least 10 characters.";
    } else {
        // Check if username or email already exists
        $sql = "SELECT ID FROM feedback WHERE Username = ? OR Email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $response['status'] = "error";
            $response['message'] = "Username or Email already exists.";
        } else {
            // Insert feedback into the database
            $sql = "INSERT INTO feedback (Username, Email, feedback) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $email, $feedback);
            if ($stmt->execute()) {
                $response['status'] = "success";
                $response['message'] = "Thank you for your feedback!";
            } else {
                $response['status'] = "error";
                $response['message'] = "Failed to submit feedback: " . $stmt->error;
            }
            $stmt->close();
        }
    }
    // Close database connection and return response
    $conn->close();
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
?>




<div class="video-container">
    <video autoplay muted loop id="bgVideo">
        <source src="bg videos/batmobile-pursuit-moewalls-com.mp4" type="video/mp4">
    </video>
</div>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Trebuchet MS', Arial, sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-clip: cover;
    background-position: center;
}

.video-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: -1;
}

#bgVideo {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.wrapper {
    width: 420px;
    background: transparent;
    color: aliceblue;
    border-radius: 12px;
    padding: 30px 40px;
}

.wrapper h1 {
    font-size: 36px;
    text-align: center;
}

.wrapper .input-box {
    position: relative;
    width: 100%;
    margin: 30px 0;
}

.input-box input, .input-box textarea {
    width: 100%;
    background: transparent;
    border: none;
    outline: none;
    border: 2px solid rgba(255, 255, 255, 2);
    border-radius: 40px;
    font-size: 16px;
    color: white;
    padding: 20px;
}

.input-box input::placeholder, .input-box textarea::placeholder {
    color: white;
}

.input-box textarea {
    height: 100px;
    border-radius: 20px;
    padding: 20px;
}

.input-box i {
    position: absolute;
    right: 20px;
    top: 30%;
    transform: translate(-50%);
    font-size: 20px;
}

.wrapper .btn {
    width: 100%;
    height: 45px;
    background: white;
    border: none;
    border-radius: 40px;
    cursor: pointer;
    font-size: 16px;
    color: #333;
    font-weight: 600;
    box-shadow: 0 0 10px rgba(0, 0, 0, 1);
}

.success-message, .failure-message {
    display: none;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
    margin-top: 10px;
    opacity: 0;
    transition: opacity 1s ease-in-out;
}

.success-message {
    background-color: #28a745;
    color: white;
}

.failure-message {
    background-color: #dc3545;
    color: white;
}
</style>

<div class="wrapper">
    <form id="feedbackForm">
        <h1>Feedback</h1>

        <!-- Name Field -->
        <div class="input-box">
            <input type="text" name="username" id="name" placeholder="Username" required>
            <i class='bx bxs-user'></i>
        </div>

        <!-- Email Field -->
        <div class="input-box">
            <input type="email" name="email" id="email" placeholder="Email" required>
            <i class='bx bxs-envelope'></i>
        </div>

        <!-- Feedback Field -->
        <div class="input-box">
            <textarea name="feedback" id="feedback" placeholder="Your Feedback" required></textarea>
            <i class='bx bxs-message'></i>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn">Submit Feedback</button>

        <!-- Success & Failure Messages -->
        <p class="success-message" id="successMessage">Thank you for your feedback!</p>
        <p class="failure-message" id="failureMessage">Submission failed! Please fill out all fields.</p>
    </form>
</div>

<script>
document.getElementById('feedbackForm').addEventListener('submit', function(event) {
    event.preventDefault();  // Prevent the form from submitting traditionally

    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var feedback = document.getElementById('feedback').value;

    var successMessage = document.getElementById('successMessage');
    var failureMessage = document.getElementById('failureMessage');

    // Reset messages
    successMessage.style.display = 'none';
    failureMessage.style.display = 'none';

    fetch('feedback.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            username: name,
            email: email,
            feedback: feedback
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            successMessage.innerHTML = data.message;
            successMessage.style.display = 'block';
            setTimeout(function() {
                successMessage.style.opacity = 1;
            }, 100);
            setTimeout(function() {
                document.getElementById('feedbackForm').reset();
                successMessage.style.opacity = 0;
            }, 4000);
        } else {
            failureMessage.innerHTML = data.message;
            failureMessage.style.display = 'block';
            failureMessage.style.opacity = 0;
            setTimeout(function() {
                failureMessage.style.opacity = 1;
            }, 100);
            setTimeout(function() {
                failureMessage.style.opacity = 0;
            }, 4000);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        failureMessage.innerHTML = "Submission failed! Please try again.";
        failureMessage.style.display = 'block';
        failureMessage.style.opacity = 0;
        setTimeout(function() {
            failureMessage.style.opacity = 1;
        }, 100);
        setTimeout(function() {
            failureMessage.style.opacity = 0;
        }, 4000);
    });
});

</script>
