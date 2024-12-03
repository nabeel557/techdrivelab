<?php
session_start(); // Start the session

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection (corrected database name)
    $conn = mysqli_connect("localhost", "root", "", "techdrivelab");

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get form data and sanitize
    $fullname = $conn->real_escape_string(trim($_POST['fullname']));
    $username = $conn->real_escape_string(trim($_POST['username']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = $conn->real_escape_string(trim($_POST['password']));
    $confirmPassword = $conn->real_escape_string(trim($_POST['confirmPassword']));

    // Validate form data
    if (empty($fullname) || empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: signup.php");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: signup.php");
        exit();
    } elseif ($password !== $confirmPassword) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: signup.php");
        exit();
    } elseif (strlen($password) < 8) {
        $_SESSION['error'] = "Password must be at least 8 characters long.";
        header("Location: signup.php");
        exit();
    } else {
        // Check for duplicate username or email
        $checkStmt = $conn->prepare("SELECT id FROM signup WHERE username = ? OR email = ?");
        $checkStmt->bind_param("ss", $username, $email);
        $checkStmt->execute();
        $checkStmt->store_result();
        
        if ($checkStmt->num_rows > 0) {
            $_SESSION['error'] = "Username or email already exists.";
            $checkStmt->close();
            header("Location: signup.php");
            exit();
        }
        $checkStmt->close();

        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO signup (fullname, username, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fullname, $username, $email, $hashedPassword);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Redirect to index.php after successful signup
            $_SESSION['success'] = "Signup successful! Welcome, $username.";
            header("Location: index.php");
            exit(); // Make sure to call exit after header to stop further script execution
        } else {
            $_SESSION['error'] = "Error: " . $stmt->error;
            header("Location: signup.php");
            exit();
        }

        // Close the prepared statement
        $stmt->close();
    }

    // Close the database connection
    mysqli_close($conn);
}
?>



    <div class="video-container">
        <video autoplay muted loop id="bgVideo">
          <source src="bg videos/WhatsApp Video 2024-09-14 at 3.14.30 PM.mp4" type="video/mp4">
        </video>
      </div>

      <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}

body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url(WhatsApp\ Image\ 2024-09-14\ at\ 3.18.35\ PM.jpeg) no-repeat;
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
  

.wrapper{
    width: 420px;
    background: transparent;
    color: aliceblue;
    border-radius: 12px;
    padding: 30px 40px;
}

.wrapper h1{
    font-size: 36px;
    text-align: center;
}

.wrapper .input-box{
    position: relative;
    width: 100%;
    height: 50px;
    margin: 30px 0;
}

.input-box input{
    width: 100%;
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    border: 2px solid rgba(255, 255, 255, 2);
    border-radius: 40px;
    font-size: 16px;
    color: white;
    padding: 20px 45px 20px 20px;
}

.input-box input::placeholder{
    color: white;
}

.input-box i{
    position: absolute;
    right: 20px;
    top: 30%;
    transform: translate(-50%);
    font-size: 20px;
}

.wrapper .remember-forget{
    display: flex;
    justify-content: space-between;
    font-size: 14.5px;
    margin: -15px 0 15px;
}

.remember-forget a{
    color: white;
    text-decoration: none;
}

.remember-forget a:hover{
    text-decoration: underline;
}

.wrapper .btn{
    width: 100%;
    height: 45px;
    background: white;
    border: none;
    outline: none;
    border-radius: 40px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 1);
    cursor: pointer;
    font-size: 16px;
    color: #333;
    font-weight: 600;
}

.wrapper .register-link{
    font-size: 14.5px;
    text-align: center;
    margin-top: 20px;
}

.register-login p a{
    color: white;
    text-decoration: none;
    font-weight: 600;
}

.register-link p a:hover{
    text-decoration: underline;
}



      </style>

<div class="wrapper">
    <form id="signupForm" action="signup.php" method="post">
        <h1>Sign Up</h1>

        <!-- Full Name Input -->
        <div class="input-box">
            <input type="text" id="fullname" name="fullname" placeholder="Full Name" required>
            <i class='bx bxs-user'></i>
        </div>

        <!-- Username Input -->
        <div class="input-box">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <i class='bx bxs-user'></i>
        </div>

        <!-- Email Input -->
        <div class="input-box">
            <input type="email" id="email" name="email" placeholder="Email" required>
            <i class='bx bx-envelope'></i>
        </div>

        <!-- Password Input -->
        <div class="input-box">
            <input type="password" id="password" name="password" placeholder="Password" required>
            <i class='bx bxs-lock-alt'></i>
            <i class='bx bx-show' id="togglePassword" style="cursor: pointer;"></i>
        </div>

        <!-- Confirm Password Input -->
        <div class="input-box">
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
            <i class='bx bxs-lock-alt'></i>
        </div>

        <button type="submit" class="btn">Sign Up</button>

        <div class="register-link">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>

        <script>
            const signupForm = document.getElementById('signupForm');
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('confirmPassword');
            const togglePassword = document.getElementById('togglePassword');

            // Show/hide password toggle
            togglePassword.addEventListener('click', function () {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                confirmPasswordField.setAttribute('type', type);
                this.classList.toggle('bx-show');
                this.classList.toggle('bx-hide');
            });

            // Form Validation
            signupForm.addEventListener('submit', function (event) {
                event.preventDefault();

                const fullname = document.getElementById('fullname').value.trim();
                const email = document.getElementById('email').value.trim();
                const password = passwordField.value.trim();
                const confirmPassword = confirmPasswordField.value.trim();

                // Validate if fields are not empty
                if (!fullname || !email || !password || !confirmPassword) {
                    alert('Please fill out all fields.');
                    return;
                }

                // Validate email format
                if (!validateEmail(email)) {
                    alert('Please enter a valid email address.');
                    return;
                }

                // Validate password match
                if (password !== confirmPassword) {
                    alert('Passwords do not match.');
                    return;
                }

                // Password length validation
                if (password.length < 6) {
                    alert('Password must be at least 6 characters long.');
                    return;
                }

                // If validation passes, submit the form
                signupForm.submit();
            });

            // Email validation function
            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(String(email).toLowerCase());
            }
        </script>
    </form>
</div>
