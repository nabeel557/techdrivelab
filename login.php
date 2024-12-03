<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username and password are set
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        // Get form data
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Admin Credentials (replace with secure storage later)
        $adminUsername = "admin"; // Replace with actual admin username
        $adminPassword = "admin123"; // Replace with hashed admin password

        // Check for Admin Login
        if ($username === $adminUsername && $password === $adminPassword) {
            $_SESSION["username"] = $username;
            $_SESSION["is_admin"] = true;
            echo "<script>alert('Welcome Admin!'); window.location.href = 'techpanel/index.php';</script>";
            exit();
        }
        // Connect to the database
        $conn = mysqli_connect("localhost", "root", "", "techdrivelab");

        // Check if the connection was successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare SQL query to check if the user exists
        $sql = "SELECT id, username, password FROM signup WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

        // Check if the username exists in the database
        if (mysqli_stmt_fetch($stmt)) {
            // Verify the password
            if (password_verify($password, $hashed_password)) {
                $_SESSION["username"] = $username;
                $_SESSION["is_admin"] = false;
                echo "<script>alert('Welcome, $username!'); window.location.href = 'index.php';</script>";
                exit();
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "User not found.";
        }

        // Close the statement and the connection
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        $error = "Please enter both username and password.";
    }
}
?>



<div class="video-container">
        <video autoplay muted loop id="bgVideo">
            <source src="bg videos/WhatsApp Video 2024-09-14 at 3.14.22 PM.mp4" type="video/mp4">
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

.register-link p a{
    color: white;
    text-decoration: none;
    font-weight: 600;
}

.register-link p a:hover{
    text-decoration: underline;
}

      </style>

<div class="wrapper">
    <form id="loginForm" action="login.php" method="post">
        <h1>Login</h1>

        <!-- Show the error message if any -->
        <?php if (!empty($error)) echo '<div class="alert alert-danger">' . $error . '</div>'; ?>

        <!-- Username Field -->
        <div class="input-box">
            <input type="text" name="username" id="username" placeholder="Username" required>
            <i class='bx bxs-user'></i>
        </div>

        <!-- Password Field -->
        <div class="input-box">
            <input type="password" name="password" id="password" placeholder="Password" required>
            <i class='bx bxs-lock-alt'></i>
        </div>

        <!-- Remember Me Checkbox -->
        <div class="remember-forget">
            <label><input type="checkbox" id="rememberMe">Remember Me</label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn">Login</button>

        <!-- Register Link -->
        <div class="register-link">
            <p> Don't have an account? <a href="signup.php">Register</a></p>
        </div>
    </form>
</div>



    <script>
        // Password Toggle Visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');

        togglePassword?.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('bx-show');
            this.classList.toggle('bx-hide');
        });

        // Form Validation and Remember Me Functionality
        const loginForm = document.getElementById('loginForm');
        const usernameField = document.getElementById('username');
        const rememberMeCheckbox = document.getElementById('rememberMe');

        // Check if there's a saved username in localStorage
        window.onload = function() {
            const savedUsername = localStorage.getItem('username');
            if (savedUsername) {
                usernameField.value = savedUsername;
                rememberMeCheckbox.checked = true;
            }
        };

        // Handle the form submission
        loginForm.addEventListener('submit', function(event) {
            const username = usernameField.value.trim();
            const password = passwordField.value.trim();

            if (!username || !password) {
                alert('Please fill in both fields.');
                event.preventDefault();
                return;
            }

            // If Remember Me is checked, save the username to localStorage
            if (rememberMeCheckbox.checked) {
                localStorage.setItem('username', username);
            } else {
                localStorage.removeItem('username');
            }
        });
    </script>