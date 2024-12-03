<?php
include('header.php');
?>


<style>
  .animated-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for transform and shadow */
    height: 150px; /* Set a fixed height */
    width: 150px;  /* Set a fixed width */
    border-radius: 50%; /* Make the card round */
    display: flex; /* Center contents */
    align-items: center; /* Center contents vertically */
    justify-content: center; /* Center contents horizontally */
    margin: auto; /* Center cards in their grid */
    position: relative; /* Needed for the shadow effect */
    overflow: hidden; /* Ensure that the shadow doesn't overflow the card */
}

.animated-card:hover {
    transform: scale(1.1); /* Scale up on hover */
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); /* Add shadow on hover */
    background-color: #f8f9fa; /* Change background color on hover */
}

/* Optional: Adding a subtle animation when the card appears */
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

.animated-card {
    animation: fadeIn 0.5s ease-in-out; /* Fade in animation */
}

/* Center text inside */
.text-center {
    text-align: center;
}

/* Optional: For responsiveness on smaller screens */
@media (max-width: 768px) {
    .animated-card {
        height: 120px; /* Adjust height for smaller screens */
        width: 120px;  /* Adjust width for smaller screens */
    }
}


</style>
<!-- 
<style>
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px); 
    }
    to {
        opacity: 1;
        transform: translateY(0); 
    }
}

.table tbody tr {
    opacity: 0;
    animation: fadeIn 0.5s ease forwards; 
}

.table tbody tr:nth-child(even) {
    animation-delay: 0.1s; 
}

.table tbody tr:nth-child(odd) {
    animation-delay: 0.2s; 
}

.table tbody tr {
    animation-duration: 0.5s; 
}

</style> -->

            <!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card bg-light rounded-circle d-flex align-items-center justify-content-center p-4 animated-card">
                <i class="fa fa-chart-line fa-3x text-danger"></i>
                <div class="text-center ms-3">
                    <p class="mb-2">Today Sale</p>
                    <h6 class="mb-0">$15,000</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card bg-light rounded-circle d-flex align-items-center justify-content-center p-4 animated-card">
                <i class="fa fa-chart-bar fa-3x text-danger"></i>
                <div class="text-center ms-3">
                    <p class="mb-2">Total Sale</p>
                    <h6 class="mb-0">$579,000</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card bg-light rounded-circle d-flex align-items-center justify-content-center p-4 animated-card">
                <i class="fa fa-chart-area fa-3x text-danger"></i>
                <div class="text-center ms-3">
                    <p class="mb-2">Today Revenue</p>
                    <h6 class="mb-0">$4,000</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card bg-light rounded-circle d-flex align-items-center justify-content-center p-4 animated-card">
                <i class="fa fa-chart-pie fa-3x text-danger"></i>
                <div class="text-center ms-3">
                    <p class="mb-2">Total Revenue</p>
                    <h6 class="mb-0">$500,000</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->




<!-- Recent Sales Start -->

<!--  $conn = mysqli_connect('localhost', 'root', '', 'techdrivelab');


if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
 }


 $sql = "SELECT * FROM admin_table"; 
 $result = $conn->query($sql); 

 if ($result === false) {
    
 }
  -->


<!-- Recent Sales Start -->
<!-- <div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0">Recent Sales</h4>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">ID</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Car Model</th>
                        <th scope="col">Service Type</th>
                        <th scope="col">Booking Date</th>
                        <th scope="col">Service Name</th>
                        <th scope="col">Service Date</th>
                        <th scope="col">Registration Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    if ($result->num_rows > 0) {
                        
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";  
                    //         echo "<td>" . htmlspecialchars($row['booking_id']) . "</td>";
                    //         echo "<td>" . htmlspecialchars($row['customer_fullname']) . "</td>";
                    //         echo "<td>" . htmlspecialchars($row['customer_email']) . "</td>";
                    //         echo "<td>" . htmlspecialchars($row['customer_phone']) . "</td>";
                    //         echo "<td>" . htmlspecialchars($row['booked_car_model']) . "</td>";
                    //         echo "<td>" . htmlspecialchars($row['booked_service_type']) . "</td>";
                    //         echo "<td>" . htmlspecialchars($row['booking_date']) . "</td>";
                    //         echo "<td>" . htmlspecialchars($row['service_name']) . "</td>";
                    //         echo "<td>" . htmlspecialchars($row['service_date']) . "</td>";
                    //         echo "<td>" . htmlspecialchars($row['contact_registration_date']) . "</td>";
                    //         echo "<td>
                    //                 <a href='view.php?id=" . htmlspecialchars($row['booking_id']) . "' class='btn btn-info btn-sm'>View</a>
                    //                 <a href='edit.php?id=" . htmlspecialchars($row['booking_id']) . "' class='btn btn-warning btn-sm'>Edit</a>
                    //                 <form action='delete.php' method='POST' style='display:inline;' onsubmit='return confirm(\"Are you sure you want to delete this record?\");'>
                    //                     <input type='hidden' name='id' value='" . htmlspecialchars($row['booking_id']) . "'>
                    //                     <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                    //                 </form>
                    //               </td>";
                    //         echo "</tr>";
                    //     }
                    // } else {
                    //     echo "<tr><td colspan='11'>No records found</td></tr>";
                    // }
                    // ?>
                 </tbody>
            </table>
        </div>
    </div>
</div> -->
<!-- Recent Sales End -->


           <!-- Chart Start -->
           <!-- <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Single Line Chart</h6>
                            <canvas id="line-chart"></canvas>
                        </div>
                    </div> -->
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Multiple Line Chart</h6>
                            <canvas id="salse-revenue" width="400" height="200"></canvas>
                        </div>
                    </div>
                    <!-- <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Single Bar Chart</h6>
                            <canvas id="bar-chart"></canvas>
                        </div>
                    </div> -->
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Multiple Bar Chart</h6>
                            <canvas id="worldwide-sales" width="400" height="200"></canvas>
                        </div>
                    </div>
                    <!-- <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Pie Chart</h6>
                            <canvas id="pie-chart"></canvas>
                        </div>
                    </div> -->
                    <!-- <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Doughnut Chart</h6>
                            <canvas id="doughnut-chart"></canvas>
                        </div>
                    </div> -->
                </div>
            </div>
            <!-- Chart End -->


<?php
// $conn->close(); // Close the database connection
include('footer.php'); // Include your footer file
?>

<!-- </tbody>

            </table>
        </div>
    </div>
</div> -->
<!-- Recent Sales End -->

