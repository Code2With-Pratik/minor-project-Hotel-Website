<?php
  require('inc/essentials.php');
  require('inc/db_config.php');
  adminLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <link rel="icon" href="../images/logo/hotel-logo.avif">
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

<?php 
  require('inc/header.php');

  // Fetch shutdown status
  $is_shutdown = mysqli_fetch_assoc(mysqli_query($con, "SELECT `shutdown` FROM `settings`"));

 
  // $current_bookings = mysqli_fetch_assoc(mysqli_query($con, "SELECT 
  //     COUNT(CASE WHEN `status` = '0' AND arrival = 0 THEN 1 END) AS `new_bookings`,
  //     COUNT(CASE WHEN `status` = '1' AND refund = 0 THEN 1 END) AS `refund_bookings`,
  //   FROM `bookings`
  // "));

  // Fetch unread queries count
  $unread_queries = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(sr_no) AS `count`
    FROM `user_queries`
    WHERE `seen` = 0
  "));
  $unread_users = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id) AS `count`
    FROM `registered_users`
    WHERE `status` = 1
  "));

  // Fetch unread reviews count
  // $unread_reviews = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(sr_no) AS `count`
  //   FROM `rating_review`
  //   WHERE `seen` = 0
  // "));

  $current_users = mysqli_fetch_assoc(mysqli_query($con, "SELECT 
       COUNT(id) AS `total`,
       COUNT(CASE WHEN `status` = 1 THEN 1 END) AS `active`,
       COUNT(CASE WHEN `status` = 0 THEN 1 END) AS `inactive`,
       COUNT(CASE WHEN `is_verified` = 0 THEN 1 END) AS `unverified`
       FROM `registered_users`
   "));
?>




 <div class="container-fluid" id="main-content" >
  <div class="row">
    <div class="col-lg-10 ms-auto p-4 over-hidden">
      

    <div class="d-flex align-items-center justify-content-between mb-4">
      <h3>DASHBOARD</h3>
      <?php 
        if($is_shutdown['shutdown']){
          echo<<<data
          <h6 class="badge bg-danger py-2 px-2 rounded">Shutdown mode is Active!</h6>
          data;
        }
      ?>
    </div>

    <div class="row mb-4">
      <div class="col-md-3 mb-4">
        <a class="text-decoration-none" href="new_bookings.php">
          <div class="card text-center text-success p-3">
            <h6>New Bookings</h6>
            <h1 class=" mb-0">5</h1>
          </div>
        </a>
      </div>
      <div class="col-md-3 mb-4">
        <a class="text-decoration-none" href="new_bookings.php">
          <div class="card text-center text-warning p-3">
            <h6>Refund Bookings</h6>
            <h1 class=" mb-0">3</h1>
          </div>
        </a>
      </div>
      <div class="col-md-3 mb-4">
        <a class="text-decoration-none" href="user_queries.php">
          <div class="card text-center text-info p-3">
            <h6>User Queries</h6>
            <h1 class=" mb-0"><?php echo $unread_queries['count']?></h1>
          </div>
        </a>
      </div>
      <div class="col-md-3 mb-4">
        <a class="text-decoration-none" href="users.php">
          <div class="card text-center text-primary p-3">
            <h6>Total User</h6>
            <h1 class=" mb-0"><?php echo $unread_users['count']?></h1>
          </div>
        </a>
      </div>
    </div>

    <div class="d-flex align-items-center justify-content-between mb-3">
      <h5>Bookings Analysis</h5>
      <select class="form-select w-auto" aria-label="Default select example">
        <option value="1">Past 30 Days</option>
        <option value="2">Past 90 Days</option>
        <option value="3">Past 1 year</option>
        <option value="4">All time</option>
      </select>
    </div>

    
    <div class="row mb-3">
      <div class="col-md-3 mb-4"> 
        <div class="card text-center text-primary p-3">
          <h6>Total Bookings</h6>
          <h1 class="mt-2 mb-0">6</h1>
          <h4 class="mt-2 mb-0">₹43210</h4>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card text-center text-success p-3">
          <h6>Active Bookings</h6>
          <h1 class="mt-2 mb-0">4</h1>
          <h4 class="mt-2 mb-0">₹36100</h4>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card text-center text-danger p-3">
          <h6>Cancelled Bookings</h6>
          <h1 class="mt-2 mb-0">2</h1>
          <h4 class="mt-2 mb-0">₹8100</h4>
        </div>
      </div>
      
    </div>

    <div class="d-flex align-items-center justify-content-between mb-3">
      <h5>User ,Queries ,Reviews Analysis</h5>
      <select class="form-select w-auto" aria-label="Default select example" onchange="user_analytics(this.value)">
        <option value="1">Past 30 Days</option>
        <option value="2">Past 90 Days</option>
        <option value="3">Past 1 year</option>
        <option value="4">All time</option>
      </select>
    </div>

    <div class="row mb-3">
      <div class="col-md-3 mb-4">
        <div class="card text-center text-primary p-3">
          <h6>New Regestration</h6>
          <h1 class="mt-2 mb-0" id="total_new_reg"><?php echo $current_users['total'] ?></h1>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card text-center text-success p-3">
          <h6>Queries</h6>
          <h1 class="mt-2 mb-0" id="total_queries">0</h1>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card text-center text-warning p-3">
          <h6>Reviews</h6>
          <h1 class="mt-2 mb-0">8</h1>
        </div>
      </div>
      
    </div>

    <h5>Users</h5>
    <div class="row mb-3">
      <div class="col-md-3 mb-4">
        <div class="card text-center text-info p-3">
          <h6>Total Users</h6>
          <h1 class="mt-2 mb-0"><?php echo $current_users['total'] ?></h1>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card text-center text-success p-3">
          <h6>Active Users</h6>
          <h1 class="mt-2 mb-0"><?php echo $current_users['active'] ?></h1>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card text-center text-warning p-3">
          <h6>Inactive Users</h6>
          <h1 class="mt-2 mb-0"><?php echo $current_users['inactive'] ?></h1>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card text-center text-danger p-3">
          <h6>Unverified Users</h6>
          <h1 class="mt-2 mb-0"><?php echo $current_users['unverified'] ?></h1>
        </div>
      </div>
    </div>


    </div>
  </div>
 </div>
 


<?php require('inc/scripts.php'); ?> 
</body>
</html>
