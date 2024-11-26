<?php
if (isset($_POST['check_availability'])) {
    // Get the check-in and check-out dates
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    // Price per night (you can replace this with a dynamic value from your database)
    $room_price_per_night = 1000; // Example static value, replace with your room price

    // Calculate the duration in days between check-in and check-out
    $checkin_date = new DateTime($check_in);
    $checkout_date = new DateTime($check_out);
    $interval = $checkin_date->diff($checkout_date);
    $days = $interval->days;

    // If days is 0 or negative, return an error message
    if ($days <= 0) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Please select a valid date range.'
        ]);
    } else {
        // Calculate total price
        $total_price = $room_price_per_night * $days;

        // Return success response with availability status and total price
        echo json_encode([
            'status' => 'available',
            'message' => 'Room is available!',
            'total_price' => $total_price
        ]);
    }
}
?>
