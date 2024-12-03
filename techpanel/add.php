<<?php
include('header.php');



// Display error and success messages
if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
    unset($_SESSION['error']); // Clear the error after displaying
}

if (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
    unset($_SESSION['success']); // Clear the success message after displaying
}
?>


<style>
        /* Fade in animation for the form */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px); /* Start slightly below */
            }
            to {
                opacity: 1;
                transform: translateY(0); /* End in original position */
            }
        }

        .container-fluid {
            animation: fadeIn 0.5s ease forwards; /* Apply fade-in effect to the container */
        }

        /* Focus effect for form inputs */
        .form-control:focus {
            border-color: #dc3545; /* Change border color on focus */
            box-shadow: 0 0 5px rgba(220, 53, 69, 0.5); /* Add a subtle shadow */
            transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for border and shadow */
        }
    </style>

<body>
    <div class="container-fluid pt-4 px-4">
        <h2 class="mb-4">Add Record</h2>
        <form class="post-form needs-validation" action="savedata.php" method="post" novalidate>
            <div class="form-group">
                <label for="fullname">Customer Fullname</label>
                <input type="text" name="CustomerFullname" id="fullname" class="form-control" required />
                <div class="invalid-feedback">Please enter the customer's full name.</div>
            </div>
            <br>
            <div class="form-group">
                <label for="email">Customer Email</label>
                <input type="email" name="CustomerEmail" id="email" class="form-control" required />
                <div class="invalid-feedback">Please enter a valid email.</div>
            </div>
            <br>
            <div class="form-group">
                <label for="phone">Customer Phone</label>
                <input type="text" name="CustomerPhone" id="phone" class="form-control" required />
                <div class="invalid-feedback">Please enter the customer's phone number.</div>
            </div>
            <br>
            <div class="form-group">
                <label for="carModel">Booked Car Model</label>
                <input type="text" name="BookedCarModel" id="carModel" class="form-control" required />
                <div class="invalid-feedback">Please enter the booked car model.</div>
            </div>
            <br>
            <div class="form-group">
                <label for="serviceType">Book Service Type</label>
                <input type="text" name="BookServiceType" id="serviceType" class="form-control" required />
                <div class="invalid-feedback">Please enter the service type.</div>
            </div>
            <br>
            <div class="form-group">
                <label for="bookingDate">Booking Date</label>
                <input type="date" name="BookingDate" id="bookingDate" class="form-control" required />
                <div class="invalid-feedback">Please enter the booking date.</div>
            </div>
            <br>
            <div class="form-group">
                <label for="serviceName">Service Name</label>
                <input type="text" name="ServiceName" id="serviceName" class="form-control" required />
                <div class="invalid-feedback">Please enter the service name.</div>
            </div>
            <br>
            <div class="form-group">
                <label for="serviceDate">Service Date</label>
                <input type="date" name="ServiceDate" id="serviceDate" class="form-control" required />
                <div class="invalid-feedback">Please enter the service date.</div>
            </div>
            <br>
            <div class="form-group">
                <label for="contactRegDate">Contact Registration Date</label>
                <input type="date" name="ContactRegistrationDate" id="contactRegDate" class="form-control" required />
                <div class="invalid-feedback">Please enter the contact registration date.</div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary justify-content-center">Add</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Bootstrap form validation
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    </body>


<?php
include('footer.php');
?>
