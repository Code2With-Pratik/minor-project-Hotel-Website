<?php
require('../inc/db_config.php');

// Fetch bookings (GET request to retrieve booking data)
if (isset($_POST['get_bookings'])) {
    // SQL query to fetch booking data from the 'bookings' table
    $query = "SELECT `sr_no`, `billing_name`, `billing_email`, `billing_mobile`, `checkin`, `checkout`, `payAmount`, `date`, `status` FROM `bookings` WHERE 1";
    
    // Execute the query
    $result = $con->query($query);

    if ($result->num_rows > 0) {
        // Loop through the result set and display each booking as a row
        while ($row = $result->fetch_assoc()) {
            // Determine the button class and text for booking status
            $buttonClass = ($row['status'] == 1) ? 'btn-success' : 'btn-danger';
            $statusText = ($row['status'] == 1) ? 'Booked' : 'Cancelled';

            echo "<tr>
                    <td>" . $row['sr_no'] . "</td>
                    <td>" . $row['billing_name'] . "</td>
                    <td>" . $row['billing_email'] . "</td>
                    <td>" . $row['billing_mobile'] . "</td>
                    <td>" . $row['checkin'] . "</td>
                    <td>" . $row['checkout'] . "</td>
                    <td>" . $row['payAmount'] . "</td>
                    <td>" . $row['date'] . "</td>
                    <td>
                        <button class='btn $buttonClass' 
                                onclick='toggleStatus(" . $row['sr_no'] . ", this)'>
                            $statusText
                        </button>
                    </td>
                  </tr>";
        }

        // Close the table
        echo "</tbody></table>";
    } else {
        // If no results, display a message
        echo "<p>No bookings found.</p>";
    }
}

// Update booking status (POST request to update status)
if (isset($_POST['sr_no']) && isset($_POST['status'])) {
    $sr_no = (int) $_POST['sr_no'];  // Booking ID
    $status = (int) $_POST['status']; // New status

    // Query to update the booking status in the 'bookings' table
    $query = "UPDATE `bookings` SET `status` = ? WHERE `sr_no` = ?";
    if ($stmt = $con->prepare($query)) {
        // Bind parameters and execute query
        $stmt->bind_param("ii", $status, $sr_no);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'new_status' => $status]);
        } else {
            echo json_encode(['status' => 'error']);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error']);
    }
}




?>

