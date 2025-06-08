//submit success model interface

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GrandStay-Payment Success</title>
  <link rel="icon" href="images/logo/hotel-logo.avif">
  <?php require('inc/links.php'); ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <style>
    body {
      background-color: #f4f4f9;
    }
    .alert-success {
      background-color: #d4edda;
      border-color: #c3e6cb;
      color: #155724;
      font-size: 1.4em;
      padding: 20px;
      margin-top: 50px;
    }
    .container {
      max-width: 800px;
      margin-top: 130px;
    }
    .btn-primary {
      font-size: 1em;
      /* border-radius: 5px 35px 5px 35px; */
      text-transform: uppercase;
    }
  </style>
</head>
<body>

  <?php require('inc/header.php'); ?>

  <div class="container">
    <div class="alert alert-success text-center">
      <h1>Payment Successful <i class="bi bi-credit-card"></i></h1>
      <p>Your booking has been confirmed. Thank you for choosing us!</p>
    </div>
    <div class="text-center">
      <a href="rooms.php" class="btn btn-primary p-2 fw-bold">More Booking</a>
    </div>
  </div>

  <?php require('inc/footer.php'); ?>

</body>
</html>

//submit success model interface ended
