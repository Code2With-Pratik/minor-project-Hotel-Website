<?php 
require('admin/inc/essentials.php');
require('admin/inc/db_config.php');

if (isset($_POST['pay_now'])) {
    // Sanitize input (filteration function needs to be defined somewhere)
    $frm_data = filteration($_POST);

    // SQL query with placeholders
    $q = "INSERT INTO `bookings`(`billing_name`, `billing_email`, `billing_mobile`, `checkin`, `checkout`, `payAmount`) 
          VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare values to be inserted
    $values = [
        $frm_data['billing_name'],
        $frm_data['billing_email'],
        $frm_data['billing_mobile'],
        $frm_data['checkin'],
        $frm_data['checkout'],
        $frm_data['payAmount']
    ];

    // Insert into database using the insert function
    // Data types for each placeholder in the query:
    // 's' for string (for name, email, mobile, checkin, checkout)
    // 'i' for integer (for mobile, if you want it to be stored as an integer)
    // 'd' for decimal (for payAmount, if it's a float)
    $res = insert($q, $values, 'sssssd'); 

    // Check if the insertion was successful
    if ($res == 1) {
        alert('success', 'Room Booked!');
    } else {
        alert('error', 'Server Down! Try again later');
    }
}
?>
