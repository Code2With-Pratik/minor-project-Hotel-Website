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
    <title>Admin Panel - User Queries</title>
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

<?php require('inc/header.php'); ?>


 <div class="container-fluid" id="main-content" >
   <div class="row">
      <div class="col-lg-10 ms-auto p-4 over-hidden">
            <h3 class="mb-4 " >USER QUERIES</h3>

               <!-- Carousel section -->
            <div class="card border-1 shadow-sm mb-3">
              <div class="card-body">
              
              </div>
            </div>

      </div>
    </div>
</div>
 


<?php require('inc/scripts.php'); ?> 

</body>
</html>