<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hotel - ROOMS DETAILS</title>
    <?php require('inc/links.php'); ?>
  </head>
  <body class="bg-light">

  <?php require('inc/header.php'); ?>

  <?php
   if(!isset($_GET['id'])){
    redirect('rooms.php');
   }

   $data = filteration($_GET);

   $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `remove`=?",[$data['id'],1,0],'iii');

   if(mysqli_num_rows($room_res)==0){
    redirect('rooms.php');
   }


   $room_data = mysqli_fetch_assoc($room_res);
  ?>
      
      
      <div class="container">
        <div class="row">

            <div class="col-12 my-5 mb-4 px-4">
              <h2 class="fw-bold"><?php echo $room_data['name'] ?></h2>
              <div style="font-size: 14px;">
                <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                <span class="text-dark"> > </span>
                <a href="rooms.php" class="text-secondary text-decoration-none">ROOMS</a>
              </div>
            </div>

            <div class="col-lg-7 col-md-12 px-4">
              <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner rounded">
                  <?php 
                    // Get thumbnail of the image
                    $room_img = ROOMS_IMG_PATH . "thumbnail.jpg"; // Default thumbnail
                    $thumb_q = mysqli_query($con, "SELECT `image` FROM `room_image` 
                                                  WHERE `room_id` = '$room_data[id]' AND `thumb` = '1'");

                    if ($thumb_q && mysqli_num_rows($thumb_q) > 0) {
                        $thumb_res = mysqli_fetch_assoc($thumb_q);
                        if (!empty($thumb_res['image'])) {
                            $room_thumb = ROOMS_IMG_PATH . $thumb_res['image']; // Update with the actual thumbnail
                        }
                        else{
                          echo "<div class='carousel-item'>
                            <img src='$room_img' class='d-block w-100' >
                          </div>";
                        }
                    }
                  ?>
                  <div class="carousel-item">
                    <img src="images/rooms/1.jpg" class="d-block w-100" >
                  </div>
                  <div class="carousel-item">
                    <img src="images/rooms/2.png" class="d-block w-100">
                  </div>
                  <div class="carousel-item">
                    <img src="images/rooms/3.png" class="d-block w-100" >
                  </div>
                  <div class="carousel-item">
                    <img src="images/rooms/4.png" class="d-block w-100" >
                  </div>
                  <div class="carousel-item">
                    <img src="images/rooms/5.png" class="d-block w-100" >
                  </div>
                  <div class="carousel-item active">
                    <img src="images/rooms/6.png" class="d-block w-100" >
                  </div>
                  <div class="carousel-item">
                    <img src="images/rooms/7.png" class="d-block w-100" >
                  </div>
                  <div class="carousel-item">
                    <img src="images/rooms/8.png" class="d-block w-100" >
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
          

             <div class="col-lg-5 col-mb-12 px-4">
               <div class="card mb-4 border-0 shadow-sm rounded-3">
                <div class="card-body">
                  <?php
                     echo<<<price
                       <h4>₹$room_data[price] /- per night</h4>
                     price;

                     echo<<<rating
                        <div class="mb-3">
                          <i class="bi bi-star-fill text-warning"></i>
                          <i class="bi bi-star-fill text-warning"></i>
                          <i class="bi bi-star-fill text-warning"></i>
                          <i class="bi bi-star-fill text-warning"></i>
                        </div>
                     rating;

                     // get feature of rooms

                    $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f 
                    INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
                    WHERE rfea.room_id = '$room_data[id]'");

                    $features_data = "";
                    while($fea_row = mysqli_fetch_assoc($fea_q)){
                      $features_data .="<span class='badge rounded-pill text-bg-light text-wrap'>
                              $fea_row[name]
                        </span>";
                    }

                     echo<<<features
                         <div class="mb-3">
                          <h6 class="mb-1">Features</h6>
                          $features_data
                        </div>
                     features;

                     
                  ?>
                </div>
               </div>


      <?php
        // $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `remove`=?",[1,0],'ii');

        // while($room_data = mysqli_fetch_assoc($room_res))
        // {
        //   // get feature of rooms

        //   $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f 
        //   INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
        //   WHERE rfea.room_id = '$room_data[id]'");

        //   $features_data = "";
        //   while($fea_row = mysqli_fetch_assoc($fea_q)){
        //     $features_data .="<span class='badge rounded-pill text-bg-light text-wrap'>
        //             $fea_row[name]
        //           </span>";
        //   }

        //   // get facilities of rooms

        //   $fac_q = mysqli_query($con,"SELECT f.name FROM `facilities` f 
        //   INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id 
        //   WHERE rfac.room_id = '$room_data[id]'");

        //   $facilities_data = "";
        //   while($fac_row = mysqli_fetch_assoc($fac_q)){
        //     $facilities_data .="<span class='badge rounded-pill text-bg-light text-wrap'>
        //             $fac_row[name]
        //           </span>";
        //   }
          

        //  // Get thumbnail of the image
        //   $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg"; // Default thumbnail
        //   $thumb_q = mysqli_query($con, "SELECT `image` FROM `room_image` 
        //                                 WHERE `room_id` = '$room_data[id]' AND `thumb` = '1'");

        //   if ($thumb_q && mysqli_num_rows($thumb_q) > 0) {
        //       $thumb_res = mysqli_fetch_assoc($thumb_q);
        //       if (!empty($thumb_res['image'])) {
        //           $room_thumb = ROOMS_IMG_PATH . $thumb_res['image']; // Update with the actual thumbnail
        //       }
        //   }


        //   // print room card

        //   echo <<<data
        //     <div class="card mb-4 border-0 shadow">
        //       <div class="row g-0 p-3 align-items-center">
        //         <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
        //           <img src="images/rooms/6.png" class="img-fluid rounded">
        //         </div>
        //         <div class="col-md-5 px-lg-3 px-mb-3 px-0">
        //           <h5 class="mb-3">$room_data[name]</h5>
        //             <div class="features mb-3">
        //               <h6 class="mb-1">Features</h6>
        //               $features_data
        //             </div>
        //             <div class="facilities mb-3">
        //               <h6 class="mb-1">Facilities</h6>
        //               $facilities_data
        //             </div>
        //             <div class="guest">
        //               <h6 class="mb-1">Guest</h6>
        //               <span class="badge rounded-pill text-bg-light text-wrap">
        //                   $room_data[adult] Adult
        //                 </span>
        //                 <span class="badge rounded-pill text-bg-light text-wrap">
        //                   $room_data[children] Children
        //                 </span>
        //             </div>
        //         </div>
        //         <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
        //           <h6 class="mb-4">₹$room_data[price] /- per night</h6>
        //           <a href="#" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2">Book Now</a>
        //           <a href="room_details.php?id=$room_data[id]" class="btn btn-sm w-100 btn-outline-dark shadow-none">More details</a>
        //         </div>
        //       </div>
        //     </div>
        //   data;
        // }
       ?>

    </div>
    
    
  </div>
</div>



 <?php require('inc/footer.php');?>

  
  </body>
</html>
