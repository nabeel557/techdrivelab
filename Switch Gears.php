<?php
include('header.php');

// Database connection settings
$host = 'localhost'; // Your database host
$dbname = 'techdrivelab'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

// Create database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize input data
    $productName = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postalCode = $_POST['postalCode'];
    $country = $_POST['country'];
    $cardName = $_POST['cardName'];
    $cardNumber = $_POST['cardNumber'];
    $expiryDate = $_POST['expiryDate'];
    $cvv = $_POST['cvv'];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO cart_orders (product_name, quantity, name, address, city, postal_code, country, card_name, card_number, expiry_date, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssssssss", $productName, $quantity, $name, $address, $city, $postalCode, $country, $cardName, $cardNumber, $expiryDate, $cvv);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "<script>alert('Order placed successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-1.jpg);">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Switch Gears</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Switch Gears</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header End -->


<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="text-primary text-uppercase">Switch Gears</h1>
            <h1 class="mb-5"></h1>
        </div>

        <style>
            /* Custom modal animation - sliding in from the left */
            .modal.fade .modal-dialog {
                transform: translateX(-100%);
                opacity: 0;
                transition: transform 0.6s ease-out, opacity 0.6s ease-out;
            }

            .modal.show .modal-dialog {
                transform: translateX(0);
                opacity: 1;
            }

            /* Modal backdrop fade-in with scale effect */
            .modal-backdrop.show {
                opacity: 0.7;
                transform: scale(1.1);
                transition: opacity 0.4s ease-out, transform 0.4s ease-out;
            }

            /* Button hover effects with rotation */
            .btn-square:hover {
                transform: rotate(360deg);
                transition: all 0.5s ease-in-out;
            }

            /* Another hover effect with bounce */
            .btn-square:nth-child(2):hover {
                transform: translateY(-10px);
                transition: transform 0.3s ease-in-out;
            }

            /* A different modal animation - scale in */
            .modal.fade .modal-dialog.scale-in {
                transform: scale(0.8);
                opacity: 0;
                transition: transform 0.5s ease-out, opacity 0.5s ease-out;
            }

            .modal.show .modal-dialog.scale-in {
                transform: scale(1);
                opacity: 1;
            }

            /* Button hover with shadow and border animation */
            .btn-square:hover {
                box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
                border: 2px solid #000;
                transition: box-shadow 0.3s ease-in-out, border 0.3s ease-in-out;
            }
        </style>

        <style>
            /* Notification styling */
            .notification {
                position: fixed;
                top: 20px;
                right: 20px;
                background-color: #28a745;
                /* Green for success */
                color: white;
                padding: 15px 20px;
                border-radius: 5px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                opacity: 0;
                transform: translateY(-20px);
                transition: opacity 0.4s ease, transform 0.4s ease;
                z-index: 9999;
                /* Make sure it's on top */
            }

            /* Show notification */
            .notification.show {
                opacity: 1;
                transform: translateY(0);
            }
        </style>


        <div class="row g-4">
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid" src="img/switch1.jpeg" alt="">
                        <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                        <a class="btn btn-square mx-1 add-to-favorites" data-id="fuse1" href="#"><i class="fas fa-heart"></i></a>
                        <a class="btn btn-square mx-1" href="#" data-bs-toggle="modal" data-bs-target="#cartModal" id="cartBtn"><i class="fas fa-shopping-cart"></i></a>
                        </div>
                    </div>
                    <div class="bg-light text-center p-4">
                        <h5 class="fw-bold mb-0">Relay</h5>
                        <small>
                            Electrically operated switch, controls high current circuits efficiently.</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid" src="img/switch2.jpeg" alt="">
                        <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                        <a class="btn btn-square mx-1 add-to-favorites" data-id="fuse1" href="#"><i class="fas fa-heart"></i></a>
                        <a class="btn btn-square mx-1" href="#" data-bs-toggle="modal" data-bs-target="#cartModal" id="cartBtn"><i class="fas fa-shopping-cart"></i></a>
                        </div>
                    </div>
                    <div class="bg-light text-center p-4">
                        <h5 class="fw-bold mb-0">Contactor</h5>
                        <small>
                            Heavy-duty switch for controlling motors and high-power loads.</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="team-item">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid" src="img/switch3.jpeg" alt="">
                        <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                        <a class="btn btn-square mx-1 add-to-favorites" data-id="fuse1" href="#"><i class="fas fa-heart"></i></a>
                        <a class="btn btn-square mx-1" href="#" data-bs-toggle="modal" data-bs-target="#cartModal" id="cartBtn"><i class="fas fa-shopping-cart"></i></a>
                        </div>
                    </div>
                    <div class="bg-light text-center p-4">
                        <h5 class="fw-bold mb-0">Fuse</h5>
                        <small>
                            Protects circuits by breaking connection during overload conditions.</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="team-item">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid" src="img/switch4.jpeg" alt="">
                        <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                        <a class="btn btn-square mx-1 add-to-favorites" data-id="fuse1" href="#"><i class="fas fa-heart"></i></a>
                        <a class="btn btn-square mx-1" href="#" data-bs-toggle="modal" data-bs-target="#cartModal" id="cartBtn"><i class="fas fa-shopping-cart"></i></a>
                        </div>
                    </div>
                    <div class="bg-light text-center p-4">
                        <h5 class="fw-bold mb-0">Circuit Breaker</h5>
                        <small>
                            Automatically interrupts circuit flow to prevent damage from overload.</small>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- Team End -->

<!-- Modal for Add to Cart and Payment -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Add to Cart & Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add to Cart Form -->
                <form id="cartForm">
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="name">Your Name:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="postalCode">Postal Code:</label>
                        <input type="text" id="postalCode" name="postalCode" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <input type="text" id="country" name="country" class="form-control" required>
                    </div>
                    <br>
                    <!-- Payment Method -->
                    <h5 class="mt-4">Payment Method</h5>
                    <div class="form-group">
                        <label for="cardName">Cardholder Name:</label>
                        <input type="text" id="cardName" name="cardName" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="cardNumber">Card Number:</label>
                        <input type="text" id="cardNumber" name="cardNumber" class="form-control" maxlength="16" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="expiryDate">Expiration Date:</label>
                        <input type="text" id="expiryDate" name="expiryDate" class="form-control" placeholder="MM/YY" maxlength="5" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="cvv">CVV:</label>
                        <input type="text" id="cvv" name="cvv" class="form-control" maxlength="3" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary w-100">Submit Order</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Handle modal and form
document.querySelectorAll('[id="cartBtn"]').forEach(button => {
    button.addEventListener('click', function() {
        var productName = this.getAttribute('data-product-name');
        document.getElementById('product_name').value = productName;
    });
});
</script>

<script>
    // Open modal with Add to Cart & Payment
    document.getElementById('cartBtn').addEventListener('click', function() {
        var cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
        cartModal.show();
    });

    // Form validation for payment
    document.getElementById('cartForm').addEventListener('submit', function(event) {
        var cardNumber = document.getElementById('cardNumber').value;
        var expiryDate = document.getElementById('expiryDate').value;
        var cvv = document.getElementById('cvv').value;

        // Basic validation for card details
        if (!/^\d{16}$/.test(cardNumber)) {
            alert('Please enter a valid 16-digit card number.');
            event.preventDefault();
        }
        if (!/^\d{2}\/\d{2}$/.test(expiryDate)) {
            alert('Please enter a valid expiration date (MM/YY).');
            event.preventDefault();
        }
        if (!/^\d{3}$/.test(cvv)) {
            alert('Please enter a valid 3-digit CVV.');
            event.preventDefault();
        }
    });
</script>



<script>
    // Check for existing favorites in Local Storage
    let favorites = JSON.parse(localStorage.getItem('favorites')) || [];

    // Add to favorites function
    function addToFavorites(id) {
        // Check if the item is already in favorites
        if (!favorites.includes(id)) {
            favorites.push(id);  // Add the item ID to the favorites array
            localStorage.setItem('favorites', JSON.stringify(favorites));  // Save the updated array to Local Storage
            showNotification('Added to favorites!'); // Show success notification
        } else {
            showNotification('Item is already in favorites!'); // Show error notification
        }
    }

    // Function to show notification
    function showNotification(message) {
        // Create a new div element for the notification
        const notification = document.createElement('div');
        notification.classList.add('notification');
        notification.textContent = message;
        
        // Append the notification to the body
        document.body.appendChild(notification);
        
        // Show the notification by adding the 'show' class
        setTimeout(() => {
            notification.classList.add('show');
        }, 10); // Small delay to trigger the transition

        // Hide and remove the notification after 3 seconds
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 400); // Match this duration with the CSS transition time
        }, 3000);
    }

    // Attach event listeners to all add-to-favorites buttons
    document.querySelectorAll('.add-to-favorites').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();  // Prevent page reload
            const itemId = this.getAttribute('data-id');  // Get the item ID from the data attribute
            addToFavorites(itemId);  // Call the function to add to favorites
        });
    });
</script>



<?php
include('footer.php');
?>