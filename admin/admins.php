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
    <title>Admin Panel - Manage Admins</title>
    <link rel="icon" href="../images/logo/hotel-logo.avif">
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

<?php require('inc/header.php'); ?>

<div class="container-fluid" id="main-content">
   <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <h3 class="mb-4">ADMIN MANAGEMENT</h3>

            <div class="card border-0 shadow-sm mb-4">
              <div class="card-body">
                
                  <div class="text-end mb-4">
                    <input type="text" oninput="search_admin(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search">
                  </div>

                  <div class="table-responsive">
                      <table class="table table-hover border text-center" style="min-width: 900px;">
                        <thead>
                          <tr>
                            <th class="bg-dark text-light" scope="col">#</th>
                            <th class="bg-dark text-light" scope="col">Name</th>
                            <th class="bg-dark text-light" width="30%" scope="col">Email</th>
                            <th class="bg-dark text-light" scope="col">Date & Time</th>
                            <th class="bg-dark text-light" scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody id="admins-data">
                          
                        </tbody>
                      </table>
                  </div>
           
              </div>
            </div>

      </div>
    </div>
</div>

<?php require('inc/scripts.php'); ?> 

<script src="scripts/admins.js"></script>


</body>
</html>
