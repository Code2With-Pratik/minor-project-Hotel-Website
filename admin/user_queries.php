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
                <div class="d-flex align-items-center justify-content-between mb-3">
                  <h5 class="card-title m-0" >Images</h5>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#carousel-s">
                  <i class="bi bi-plus-square"></i>Add
                  </button>
                </div>

                <div class="row" id="carousel-data">
                  <div class="col-md-5 mb-3 ">
                    <div class="card bg-light border-none shadow text-white p-2">
                      <img src="../images/carousel/1.png" class="card-img">
                      <div class="card-img-overlay text-end">
                        <button type="button" class="btn btn-danger btn-sm shadow-none">
                         <i class="bi bi-trash"></i> Delete
                        </button>
                      </div>
                    </div>
                    <div class="card bg-light border-none shadow text-white p-2">
                      <img src="../images/carousel/2.png" class="card-img">
                      <div class="card-img-overlay text-end">
                        <button type="button" class="btn btn-danger btn-sm shadow-none">
                         <i class="bi bi-trash"></i> Delete
                        </button>
                      </div>
                    </div>
                    <div class="card bg-light border-none shadow text-white p-2">
                      <img src="../images/carousel/3.png" class="card-img">
                      <div class="card-img-overlay text-end">
                        <button type="button" class="btn btn-danger btn-sm shadow-none">
                         <i class="bi bi-trash"></i> Delete
                        </button>
                      </div>
                    </div>
                    <div class="card bg-light border-none shadow text-white p-2">
                      <img src="../images/carousel/4.png" class="card-img">
                      <div class="card-img-overlay text-end">
                        <button type="button" class="btn btn-danger btn-sm shadow-none">
                         <i class="bi bi-trash"></i> Delete
                        </button>
                      </div>
                    </div>
                    <div class="card bg-light border-none shadow text-white p-2">
                      <img src="../images/carousel/5.png" class="card-img">
                      <div class="card-img-overlay text-end">
                        <button type="button" class="btn btn-danger btn-sm shadow-none">
                         <i class="bi bi-trash"></i> Delete
                        </button>
                      </div>
                    </div>
                    <div class="card bg-light border-none shadow text-white p-2">
                      <img src="../images/carousel/6.png" class="card-img">
                      <div class="card-img-overlay text-end">
                        <button type="button" class="btn btn-danger btn-sm shadow-none">
                         <i class="bi bi-trash"></i> Delete
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

      </div>
    </div>
</div>
 


<?php require('inc/scripts.php'); ?> 

</body>
</html>