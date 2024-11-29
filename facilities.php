<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>GrandStay - Facilities</title>
    <link rel="icon" href="images/logo/hotel-logo.avif">
    <?php require('inc/links.php'); ?>
    <style>
      .pop:hover{
        border-top-color: var(--teal) !important;
        transform: scale(1.03);
        transition: all 0.3s;
      }
    </style>
  </head>
  <body class="bg-light">

  <?php require('inc/header.php'); ?>
      
<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">OUR FACILITIES</h2>
  <div class="h-line bg-dark "></div>
  <p class="text-center mt-3">
  "Discover unparalleled luxury, modern amenities, spacious rooms,
  <br> serene 
  ambiance, premium comfort, stylish interiors,
  <br> 
  and quality hospitality for unforgettable stays."
  </p>
</div>

<div class="container">
  <div class="row">

      <?php 
        $res = selectAll('facilities');

        while($row = mysqli_fetch_assoc($res)){
          echo<<<data
              <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                  <div class="d-flex align-items-center mb-2">
                  <img src="images/features/facility.png" width="40px">
                  <h5 class="m-0 ms-3">$row[name]</h5>
                  </div>
                  <p>$row[description]</p>
                </div>
              </div>
          data;
        }
      ?>
      
  </div>
</div>

 <?php require('inc/footer.php');?>
  
  </body>
</html>
