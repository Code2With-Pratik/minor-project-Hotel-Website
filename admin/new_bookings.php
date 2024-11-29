<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();

// Query to get booking data
$query = "SELECT `sr_no`, `billing_name`, `billing_email`, `billing_mobile`, `checkin`, `checkout`, `payAmount`, `date`, `status` FROM `bookings` WHERE 1";
$result = $con->query($query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . $con->error); // Output query error
}

// Check if there are any bookings
$bookings = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - New Bookings</title>
    <link rel="icon" href="../images/logo/hotel-logo.avif">
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

<?php require('inc/header.php'); ?>

<div class="container-fluid" id="main-content">
   <div class="row">
      <div class="col-lg-10 ms-auto p-4 over-hidden">
            <h3 class="mb-4">New Bookings</h3>

            <div class="card border-0 shadow-sm mb-4">
              <div class="card-body">
                  <div class="text-end mb-4">
                    <input type="text" oninput="search_user(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search">
                  </div>

                  <div class="table-responsive">
                      <table class="table table-hover border text-center">
                        <thead>
                          <tr>
                            <th class="bg-dark text-light" scope="col">#</th>
                            <th class="bg-dark text-light" scope="col">Name</th>
                            <th class="bg-dark text-light" scope="col">Email</th>
                            <th class="bg-dark text-light" scope="col">Phone No.</th>
                            <th class="bg-dark text-light" scope="col">Check In</th>
                            <th class="bg-dark text-light" scope="col">Check Out</th>
                            <th class="bg-dark text-light" scope="col">Pay Amount</th>
                            <th class="bg-dark text-light" scope="col">Date</th>
                            <th class="bg-dark text-light" scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody id="users-data">
                              <?php
                              // Check if there are any bookings and output them
                              if (!empty($bookings)) {
                                  foreach ($bookings as $booking) {
                                      echo "<tr>
                                              <td>" . $booking['sr_no'] . "</td>
                                              <td>" . $booking['billing_name'] . "</td>
                                              <td>" . $booking['billing_email'] . "</td>
                                              <td>" . $booking['billing_mobile'] . "</td>
                                              <td>" . $booking['checkin'] . "</td>
                                              <td>" . $booking['checkout'] . "</td>
                                              <td>" . $booking['payAmount'] . "</td>
                                              <td>" . $booking['date'] . "</td>
                                              <td>
                                                <button class='btn " . ($booking['status'] == 1 ? 'btn-success' : 'btn-danger') . "' 
                                                        onclick='toggleStatus(" . $booking['sr_no'] . ", this)'>
                                                    " . ($booking['status'] == 1 ? 'Booked' : 'Cancelled') . "
                                                </button>
                                              </td>
                                          </tr>";
                                  }
                              } else {
                                  echo "<tr><td colspan='9'>No bookings found.</td></tr>";
                              }
                              ?>
                          </tbody>

                      </table>
                  </div>
              </div>
            </div>

      </div>
    </div>
</div>

<?php require('inc/scripts.php'); ?> 

<script src="scripts/new_bookings.js"></script>

</body>
</html>
