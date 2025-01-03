<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>GrandStay - ROOMS DETAILS</title>
    <link rel="icon" href="images/logo/hotel-logo.avif">
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
                      $features_data .="<span class='badge rounded-pill text-bg-light text-wrap me-1 mb-1'>
                              $fea_row[name]
                        </span>";
                    }

                     echo<<<features
                         <div class="mb-3">
                          <h6 class="mb-1">Features</h6>
                          $features_data
                         </div>
                     features;

                      // get facilities of rooms

                    $fac_q = mysqli_query($con,"SELECT f.name FROM `facilities` f 
                    INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id 
                    WHERE rfac.room_id = '$room_data[id]'");

                    $facilities_data = "";
                    while($fac_row = mysqli_fetch_assoc($fac_q)){
                      $facilities_data .="<span class='badge rounded-pill text-bg-light text-wrap me-1 mb-1'>
                              $fac_row[name]
                            </span>";
                    }

                    echo<<<facilities
                          <div class=" mb-3">
                            <h6 class="mb-1">Facilities</h6>
                            $facilities_data
                          </div>
                    facilities;

                    echo<<<guests
                      <div class="guest">
                        <h6 class="mb-1">Guest</h6>
                        <span class="badge rounded-pill text-bg-light text-wrap">
                            $room_data[adult] Adult
                          </span>
                          <span class="badge rounded-pill text-bg-light text-wrap">
                            $room_data[children] Children
                          </span>
                      </div>
                    guests;

                    echo<<<area
                      <div class="area mb-3 mt-3">
                          <h6 class="mb-1">Area</h6>
                            <span class='badge rounded-pill text-bg-light text-wrap me-1 mb-1'>
                            $room_data[area] sq. ft.
                            </span>
                        </div>
                    area;

                    $book_btn = "";

                    if(!$row['shutdown']){
                      $login=0;
                      if(isset($_SESSION['login']) && $_SESSION['login'] === true){
                        $login=1;
                      }
                      echo<<<book
                         <button onclick='checkLoginToBook($login,$room_data[id])' class="btn w-100 text-white custom-bg shadow-none mb-1">Book Now</button>
                      book;
                    }

                  ?>
                </div>
               </div>
             </div>
             
             <div class="col-12 mt-4 px-4">
               <div class="mb-5">
                 <h5>Description</h5>
                 <p>
                   <?php echo $room_data['description']?>
                 </p>
               </div>
               <div>
                 <h5>Reviews & Ratings</h5>
               </div>
                 <div class="profile d-flex align-item-center mb-2">
                   <img src="images/features/star.svg" width="30px">
                   <h6 class="m-2 ms-0">Vivek Yadav</h6>
                 </div>
                 <p>
                 Great value for money stay near Helsinki station, location was fantastic,
                  room was spacious a living room area flanked by the 2 
                 rooms on each side , place was clean, staff were friendly, breakfast was
                  great, water pressure was strong and water heater worked well."
                 </p>
                 <div class="rating">
                   <i class="bi bi-star-fill text-warning"></i>
                   <i class="bi bi-star-fill text-warning"></i>
                   <i class="bi bi-star-fill text-warning"></i>
                   <i class="bi bi-star-fill text-warning"></i>
                 </div>
               </div>
             </div>
  </div>
</div>

 <?php require('inc/footer.php');?>

  
  </body>
</html>
