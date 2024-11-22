<?php
require('admin/inc/db_config.php');
require('admin/inc/essentials.php');

// Registration
if (isset($_POST['register'])) {
    $data = filteration($_POST);

    // Match password and confirm password fields
    if ($data['password'] !== $data['cpass']) {
        echo 'pass_mismatch';
        exit;
    }

    // Check if user already exists (by email or phone)
    $u_exist = select(
        "SELECT * FROM `registered_users` WHERE `email`= ? OR `phone`= ? LIMIT 1",
        [$data['email'], $data['phone']],
        "ss"
    );

    if (mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
        exit;
    }

    // Encrypt the password
    $enc_pass = password_hash($data['password'], PASSWORD_BCRYPT);

    // Insert user data into the database
    $query = "INSERT INTO `registered_users`(`name`, `email`, `phone`, `address`, `pincode`, `dob`, `password`) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $values = [
        $data['name'], $data['email'], $data['phone'], $data['address'], $data['pincode'], $data['dob'], $enc_pass
    ];

    if (insert($query, $values, 'sssssss')) {
        echo 1; // Success
    } else {
        echo 'ins_failed'; // Database insertion failure
    }
}

// Login
if (isset($_POST['login'])) {
    $data = filteration($_POST);

    // Check if user exists
    $u_exist = select(
        "SELECT * FROM `registered_users` WHERE `email`= ? LIMIT 1",
        [$data['email']],
        "s"
    );

    if (mysqli_num_rows($u_exist) == 0) {
        echo 'no_user'; // User not found
        exit;
    }

    $u_exist_fetch = mysqli_fetch_assoc($u_exist);

    // Check if password matches
    if (!password_verify($data['pass'], $u_exist_fetch['password'])) {
        echo 'invalid_pass'; // Incorrect password
        exit;
    }

    // Start session and set user data
    session_start();
    $_SESSION['login'] = true;
    $_SESSION['u_id'] = $u_exist_fetch['id'];
    $_SESSION['u_name'] = $u_exist_fetch['name'];

    echo 1; // Login successful
}
?>
