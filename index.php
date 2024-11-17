<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hotel - Home</title>
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <style>   
       .availability-form{
        margin-top: -50px;
        z-index: 2;
        position: relative;
       }
       @media screen and (max-width: 575px) {
        .availability-form{
          margin-top: 25px;
          padding: 0 35px;
        }
       }
    </style>
  </head>
  <body class="bg-light">

  <?php require('inc/header.php'); ?>
          <!-- Swiper -->

<div class="container-fluid px-lg-4 mt-4">
  <div class="swiper swiper-container">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <img src="images/carousel/1.png" class="w-100 d-block">
      </div>
      <div class="swiper-slide">
        <img src="images/carousel/2.png" class="w-100 d-block">
      </div>
      <div class="swiper-slide">
        <img src="images/carousel/3.png" class="w-100 d-block">
      </div>
      <div class="swiper-slide">
        <img src="images/carousel/4.png" class="w-100 d-block">
      </div>
      <div class="swiper-slide">
        <img src="images/carousel/5.png" class="w-100 d-block">
      </div>
      <div class="swiper-slide">
        <img src="images/carousel/6.png" class="w-100 d-block">
      </div>
    </div>
  </div>
</div>
          <!-- check Availability form -->

<div class="container availability-form">
  <div class="row">
    <div class="col-lg-12 bg-white shadow p-4 rounded">
      <h5 class="mb-4">Check Booking Availability</h5>
      <form>
        <div class="row align-item-end">
          <div class="col-lg-3 mb-3">
            <label class="form-label" style="font-weight: 500;">Check In</label>
            <input type="date" class="form-control shadow-none">
          </div>
          <div class="col-lg-3 mb-3">
            <label class="form-label" style="font-weight: 500;">Check Out</label>
            <input type="date" class="form-control shadow-none">
          </div>
          <div class="col-lg-3 mb-3">
            <label class="form-label" style="font-weight: 500;">Adult</label>
            <select class="form-select shadow-none">
              <!-- <option selected>Open this secect menu</option> -->
              <option value="1">one</option>
              <option value="2">two</option>
              <option value="3">three</option>
              <option value="4">four</option>
            </select>
          </div>
          <div class="col-lg-3 mb-3">
            <label class="form-label" style="font-weight: 500;">Children</label>
            <select class="form-select shadow-none">
              <!-- <option selected>Open this secect menu</option> -->
              <option value="1">one</option>
              <option value="2">two</option>
              <option value="3">three</option>
              <option value="4">four</option>
            </select>
          </div>
          <div class="cool-lg-2 mb-lg-3 mt-2">
            <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>




 <!-- Room Cart -->
<H2 class="mt-4 pt-2 mb-4 text-center fw-bold h-font">Our Rooms</H2>
<div class="container">
  <div class="row">
     <?php
        $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `remove`=? ORDER BY id DESC LIMIT 3", [1, 0], 'ii');

        while($room_data = mysqli_fetch_assoc($room_res))
        {
          // get feature of rooms

          $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f 
          INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
          WHERE rfea.room_id = '$room_data[id]'");

          $features_data = "";
          while($fea_row = mysqli_fetch_assoc($fea_q)){
            $features_data .="<span class='badge rounded-pill text-bg-light text-wrap  me-1 mb-1'>
                    $fea_row[name]
                  </span>";
          }

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
          

         // Get thumbnail of the image
          $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg"; // Default thumbnail
          $thumb_q = mysqli_query($con, "SELECT `image` FROM `room_image` 
                                        WHERE `room_id` = '$room_data[id]' AND `thumb` = '1'");

          if ($thumb_q && mysqli_num_rows($thumb_q) > 0) {
              $thumb_res = mysqli_fetch_assoc($thumb_q);
              if (!empty($thumb_res['image'])) {
                  $room_thumb = ROOMS_IMG_PATH . $thumb_res['image']; // Update with the actual thumbnail
              }
          }


          // print room card

          echo <<<data
           
          <div class="col-lg-4 col-md-6 my-3">
            <div class="card border-0 shadow" style="max-width: 350px; margin: auto; ">
              <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
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
              <div class="card-body">
                <h5>$room_data[name]</h5>
                <h6 class="mb-4">₹$room_data[price] /- per night</h6>
                
                
                <div class="features mb-3">
                  <h6 class="mb-1">Features</h6>
                  $features_data
                </div>

              <div class="facilities mb-3">
                <h6 class="mb-1">Facilities</h6>
                    $facilities_data
              </div>

              <div class="guest mb-3">
                <h6 class="mb-1">Guest</h6>
                  <span class="badge rounded-pill text-bg-light text-wrap">
                     $room_data[adult] Adult
                  </span>
                  <span class="badge rounded-pill text-bg-light text-wrap">
                     $room_data[children] Children
                  </span>
              </div>

                <div class="rating mb-4">
                  <h6 class="mb-1">Rating</h6>
                  <span class="badge rounded-pill bg-light">
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  </span>
                </div>
                <div class="d-flex justify-content-evenly mb-2">
                  <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                  <a href="room_details.php?id=$room_data[id]" class="btn btn-sm  btn-outline-dark shadow-none">More details</a>
                </div>
              </div>
            
            </div>
          </div>
          data;
        }

     ?>

    <div class="col-lg-12 text-center mt-5">
        <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-1 fw-bold shadow-none">More Rooms >>></a>
    </div>
  </div>
</div>

        <!-- our facilities -->

<H2 class="mt-4 pt-2 mb-4 text-center fw-bold h-font">Our Facilities</H2>

<div class="container">
  <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
  <?php 
      $res = mysqli_query($con, "SELECT * FROM `facilities` ORDER BY id DESC LIMIT 5");

    while($row = mysqli_fetch_assoc($res)){
      echo<<<data
          <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
            <img src="images/features/facility.png" width="60px">
            <h5 class="mt-3">$row[name]</h5>
          </div>
      data;
    }
  ?>

    <div class="col-lg-12 text-center mt-5">
       <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded-1 fw-bold shadow-none">More Facilities >>></a>
    </div>
  </div>
</div>

         <!-- Testimonials -->

<H2 class="mt-4 pt-2 mb-4 text-center fw-bold h-font">Testimonials</H2>
  <div class="container">
      <!-- Swiper -->
  <div class="swiper swiper-testimonials">
    <div class="swiper-wrapper mb-5">
      <div class="swiper-slide bg-white p-4">
        <div class="profile d-flex align-item-center p-0">
          <img src="images/features/star.svg" alt="">
          <h6 class="m-5 ms-0">Random user1</h6>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. 
          Quod assumenda nobis eveniet quisquam alias magni velit perspiciatis 
          sequi ipsa ex!
        </p>
        <div class="rating">
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
        </div>
      </div>
      <div class="swiper-slide bg-white p-4">
        <div class="profile d-flex align-item-center p-0">
          <img src="images/features/star.svg" alt="">
          <h6 class="m-5 ms-0">Random user1</h6>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. 
          Quod assumenda nobis eveniet quisquam alias magni velit perspiciatis 
          sequi ipsa ex!
        </p>
        <div class="rating">
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
        </div>
      </div>
      <div class="swiper-slide bg-white p-4">
        <div class="profile d-flex align-item-center p-0">
          <img src="images/features/star.svg" alt="">
          <h6 class="m-5 ms-0">Random user1</h6>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. 
          Quod assumenda nobis eveniet quisquam alias magni velit perspiciatis 
          sequi ipsa ex!
        </p>
        <div class="rating">
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
        </div>
      </div>
      <div class="swiper-slide bg-white p-4">
        <div class="profile d-flex align-item-center p-0">
          <img src="images/features/star.svg" alt="">
          <h6 class="m-5 ms-0">Random user1</h6>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. 
          Quod assumenda nobis eveniet quisquam alias magni velit perspiciatis 
          sequi ipsa ex!
        </p>
        <div class="rating">
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
        </div>
      </div>
    </div>
    <div class="swiper-pagination"></div>
  </div>
  <div class="col-lg-12 text-center mt-5">
     <a href="about.php" class="btn btn-sm btn-outline-dark rounded-1 fw-bold shadow-none">Know More >>></a>
  </div>
  </div>

    <!-- Reach us -->
<?php
   $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
   $values = [1];
   $contact_r = mysqli_fetch_assoc(select($contact_q,$values, 'i'));
?>


<H2 class="mt-4 pt-2 mb-4 text-center fw-bold h-font">Reach Us</H2>
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
     <iframe class="w-100 rounded" height="320px" src="<?php echo $contact_r['iframe'] ?>" loading="lazy"></iframe>
    </div>
    <div class="col-lg-4 col-md-4">
      <div class="bg-white p-5 rounded mb-4">
      
      <!-- Call Us Section -->
        <h5>Call Us</h5>
        <a href="tel:+<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
          <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn1'] ?>
        </a>
        <br>
      <?php
        if($contact_r['pn2']!=''){
          echo<<<data
            <a href="tel: +$contact_r[pn2]" class="d-inline-block text-decoration-none text-dark">
              <i class="bi bi-telephone-fill"></i> +$contact_r[pn2]
            </a>
            data;
        }
      ?>

      <!-- Follow Us Section -->
      <h5 class="mt-4">Follow Us</h5>
      <?php
      if($contact_r['tw']!=''){
        echo<<<data
        <a href="$contact_r[tw]" class="d-inline-block mb-3">
          <span class="badge bg-light text-dark fs-6">
          <i class="bi bi-twitter"></i>  Twitter</span>
        </a>
        <br>
        data;
      }
      ?>
      <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block mb-3">
        <span class="badge bg-light text-dark fs-6">
        <i class="bi bi-instagram"></i>  Instagram</span>
      </a>
      <br>
      <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-3">
        <span class="badge bg-light text-dark fs-6">
        <i class="bi bi-facebook"></i>  facebook</span>
      </a>
    </div>
  </div>
  </div>
</div>

 <?php require('inc/footer.php');?>

    
     <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

   <script>
    var swiper = new Swiper(".swiper-container", {
      spaceBetween: 30,
      effect: "fade",
      loop: true,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      }
    });

    var swiper = new Swiper(".swiper-testimonials", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      slidesPerView: "3",
      loop: true,
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: false,
      },
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints: {
        320: {
          slidePerView: 1,
        },
        640: {
          slidePerView: 1,
        },
        768: {
          slidePerView: 3,
        },
        1024: {
          slidePerView: 4,
        },
      }
    });
  </script>

  </body>
</html>
