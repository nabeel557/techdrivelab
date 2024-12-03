<?php
include ('header.php');
?>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-1.jpg);">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Contact</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Contact Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="mb-5">Contact For Any Query</h1>
        </div>
        <div class="row g-4">
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <iframe class="position-relative rounded w-100 h-100"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                    frameborder="0" style="min-height: 350px; border:0;" allowfullscreen="" aria-hidden="false"
                    tabindex="0"></iframe>
            </div>

            <div class="col-md-6">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <p class="mb-4"></p>

                    <!-- Contact Form Start -->
                    <form id="contactForm" method="POST" action="">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" id="message" name="message" style="height: 100px" required></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                    <div id="formResponse">
                        <?php
                        // Enable error reporting for debugging
                        ini_set('display_errors', 1);
                        ini_set('display_startup_errors', 1);
                        error_reporting(E_ALL);

                        // Database connection details
                        $servername = "localhost";
                        $username = "root"; // Your database username
                        $password = ""; // Your database password
                        $dbname = "techdrivelab"; // Your database name

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Check if the form data is set
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
                                // Escape the input values to prevent SQL injection
                                $name = $conn->real_escape_string($_POST['name']);
                                $email = $conn->real_escape_string($_POST['email']);
                                $subject = $conn->real_escape_string($_POST['subject']);
                                $message = $conn->real_escape_string($_POST['message']);

                                // Insert data into the database
                                $sql = "INSERT INTO contact (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

                                if ($conn->query($sql) === TRUE) {
                                    echo "<p class='text-success'>Message sent successfully!</p>";
                                } else {
                                    echo "<p class='text-danger'>Error: " . $sql . "<br>" . $conn->error . "</p>";
                                }
                            } else {
                                echo "<p class='text-danger'>All fields are required!</p>";
                            }
                        }

                        $conn->close();
                        ?>
                    </div>
                    <!-- Contact Form End -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<script>
    document.getElementById('contactForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Validate form inputs
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const subject = document.getElementById('subject').value.trim();
        const message = document.getElementById('message').value.trim();

        // Check if fields are filled
        if (name === '' || email === '' || subject === '' || message === '') {
            alert('All fields are required!');
            return;
        }

        // If all validations pass, submit the form
        this.submit(); // This will now submit the form to the same page
    });
</script>

<?php
include ('footer.php');
?>
