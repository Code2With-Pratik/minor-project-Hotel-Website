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

               <!-- User queries section -->
            <div class="card border-0 shadow-sm mb-4">
              <div class="card-body">
              
                  <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                      <table class="table table-hover border">
                        <thead class="sticky-top">
                          <tr>
                            <th class="bg-dark text-light" scope="col">#</th>
                            <th class="bg-dark text-light" width="10%" scope="col">Name</th>
                            <th class="bg-dark text-light" scope="col">Email</th>
                            <th class="bg-dark text-light" width="20%" scope="col">Subject</th>
                            <th class="bg-dark text-light" width="30%" scope="col">Message</th>
                            <th class="bg-dark text-light" scope="col">Date</th>
                            <th class="bg-dark text-light" width="15%" scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                         
                        </tbody>
                      </table>
                  </div>

              </div>
            </div>

      </div>
    </div>
</div>
 


<?php require('inc/scripts.php'); ?> 

</body>
</html>