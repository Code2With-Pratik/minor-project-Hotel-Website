<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>GrandStay - ROOMS</title>
    <link rel="icon" href="images/logo/hotel-logo.avif">
    <?php require('inc/links.php'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body class="bg-light">

  <?php require('inc/header.php'); ?>
      
<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">OUR ROOMS</h2>
  <div class="h-line bg-dark "></div>
  
</div>

<div class="container-fluid">
  <div class="row">

      <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 ps-4"> 
          <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
              <div class="container-fluid flex-lg-column align-items-stretch">
                  <h4 class="mt-2">FILTERS</h4>
                  <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
                      <div class="border bg-light p-3 rounded mb-2">
                          <h5 class="mb-3" style="font-size: 18px;">CHECK AVAILABILITY</h5>
                          <label class="form-label">Check In</label>
                          <input type="date" id="check_in" class="form-control shadow-none">
                          <label class="form-label">Check Out</label>
                          <input type="date" id="check_out" class="form-control shadow-none">
                      </div>
                      <div class="border bg-light p-3 rounded mb-2">
                          <h5 class="mb-3" style="font-size: 18px;">FACILITIES</h5>
                          <div class="mb-2">
                              <input type="checkbox" id="facility1" class="form-check-input shadow-none me-1">
                              <label class="form-check-label" for="facility1">Facility one</label>
                          </div>
                          <div class="mb-2">
                              <input type="checkbox" id="facility2" class="form-check-input shadow-none me-1">
                              <label class="form-check-label" for="facility2">Facility two</label>
                          </div>
                          <div class="mb-2">
                              <input type="checkbox" id="facility3" class="form-check-input shadow-none me-1">
                              <label class="form-check-label" for="facility3">Facility three</label>
                          </div>
                      </div>
                      <div class="border bg-light p-3 rounded mb-2">
                          <h5 class="mb-3" style="font-size: 18px;">GUESTS</h5>
                          <div class="d-flex">
                              <div class="me-3">
                                  <label class="form-label">Adults</label>
                                  <input type="number" id="adults" class="form-control shadow-none">
                              </div>
                              <div>
                                  <label class="form-label">Children</label>
                                  <input type="number" id="children" class="form-control shadow-none">
                              </div>
                          </div>
                      </div>
                      <button class="btn btn-primary mt-3" id="filterButton">Apply Filters</button>
                  </div>
              </div>
          </nav>
      </div>
      
      <div class="col-lg-9 col-mb-12 px-4" id="rooms-data">
        
        
              <div id="room-list" class="row mt-3">
                  <!-- Filtered rooms will be displayed here -->
              </div>



      <?php
        $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `remove`=? ORDER BY id DESC", [1, 0], 'ii');

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

          $book_btn = "";

          if(!$row['shutdown']){
            $login=0;
            if(isset($_SESSION['login']) && $_SESSION['login'] === true){
              $login=1;
            }
           $book_btn = "<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-sm w-100 text-white custom-bg shadow-none mb-2'>Book Now</button>";
          }


          // print room card

          echo <<<data
            <div class="card mb-4 border-0 shadow">
              <div class="row g-0 p-3 align-items-center">
                <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
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
                </div>
                <div class="col-md-5 px-lg-3 px-mb-3 px-0">
                  <h5 class="mb-3">$room_data[name]</h5>
                    <div class="features mb-3">
                      <h6 class="mb-1">Features</h6>
                      $features_data
                    </div>
                    <div class="facilities mb-3">
                      <h6 class="mb-1">Facilities</h6>
                      $facilities_data
                    </div>
                    <div class="guest">
                      <h6 class="mb-1">Guest</h6>
                      <span class="badge rounded-pill text-bg-light text-wrap">
                          $room_data[adult] Adult
                        </span>
                        <span class="badge rounded-pill text-bg-light text-wrap">
                          $room_data[children] Children
                        </span>
                    </div>
                </div>
                <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                  <h6 class="mb-4">₹$room_data[price] /- per night</h6>
                  $book_btn
                  <a href="room_details.php?id=$room_data[id]" class="btn btn-sm w-100 btn-outline-dark shadow-none">More details</a>
                </div>
              </div>
            </div>
          data;
        }
       ?>

    </div>
    
    
  </div>
</div>

<script>
    $(document).ready(function() {
    $('#filterButton').click(function() {
        // Get filter values
        var check_in = $('#check_in').val();
        var check_out = $('#check_out').val();
        var facilities = [];
        if ($('#facility1').prop('checked')) facilities.push('Facility one');
        if ($('#facility2').prop('checked')) facilities.push('Facility two');
        if ($('#facility3').prop('checked')) facilities.push('Facility three');
        var adults = $('#adults').val();
        var children = $('#children').val();

        // AJAX request to filter rooms
        $.ajax({
            type: 'POST',
            url: 'filter_rooms.php',
            data: {
                check_in: check_in,
                check_out: check_out,
                facilities: facilities,
                adults: adults,
                children: children
            },
            success: function(response) {
                // Show the filtered rooms in a specific div
                $('#room-list').html(response);
            }
        });
    });
});

</script>

 <?php require('inc/footer.php');?>

  
  </body>
</html>
