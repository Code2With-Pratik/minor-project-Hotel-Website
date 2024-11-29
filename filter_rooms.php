<?php
// Include the database connection
require('admin/inc/db_config.php');

// Query to fetch all rooms
$sql = "SELECT * FROM rooms WHERE status = 1 AND remove = 0"; // Adjust the conditions if needed

$result = mysqli_query($con, $sql);

// Check if any rooms were found
if (mysqli_num_rows($result) > 0) {
    while ($room_data = mysqli_fetch_assoc($result)) {
        // Fetch features
        $fea_q = mysqli_query($con, "SELECT f.name FROM features f 
                                      INNER JOIN room_features rfea ON f.id = rfea.features_id 
                                      WHERE rfea.room_id = '$room_data[id]'");

        $features_data = "";
        while ($fea_row = mysqli_fetch_assoc($fea_q)) {
            $features_data .= "<span class='badge rounded-pill text-bg-light text-wrap me-1 mb-1'>{$fea_row['name']}</span>";
        }

        // Fetch facilities
        $fac_q = mysqli_query($con, "SELECT f.name FROM facilities f 
                                      INNER JOIN room_facilities rfac ON f.id = rfac.facilities_id 
                                      WHERE rfac.room_id = '$room_data[id]'");

        $facilities_data = "";
        while ($fac_row = mysqli_fetch_assoc($fac_q)) {
            $facilities_data .= "<span class='badge rounded-pill text-bg-light text-wrap me-1 mb-1'>{$fac_row['name']}</span>";
        }

        // Get room thumbnail
        $room_thumb = 'images/rooms/thumbnail.jpg'; // Default thumbnail
        $thumb_q = mysqli_query($con, "SELECT image FROM room_image WHERE room_id = '$room_data[id]' AND thumb = 1");
        if ($thumb_q && mysqli_num_rows($thumb_q) > 0) {
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            if (!empty($thumb_res['image'])) {
                $room_thumb = 'images/rooms/' . $thumb_res['image'];
            }
        }

        // Build the room card HTML
        echo "<div class='card mb-4 border-0 shadow'>
              <div class='row g-0 p-3 align-items-center'>
                <div class='col-md-5 mb-lg-0 mb-md-0 mb-3'>
                   <div id='roomCarousel' class='carousel slide' data-bs-ride='carousel'>
                      <div class='carousel-inner'>
                        <div class='carousel-item'>
                          <img src='images/rooms/1.jpg' class='d-block w-100' >
                        </div>
                        <div class='carousel-item'>
                          <img src='images/rooms/2.png' class='d-block w-100'>
                        </div>
                        <div class='carousel-item'>
                          <img src='images/rooms/3.png' class='d-block w-100' >
                        </div>
                        <div class='carousel-item'>
                          <img src='images/rooms/4.png' class='d-block w-100' >
                        </div>
                        <div class='carousel-item'>
                          <img src='images/rooms/5.png' class='d-block w-100' >
                        </div>
                        <div class='carousel-item active'>
                          <img src='images/rooms/6.png' class='d-block w-100' >
                        </div>
                        <div class='carousel-item'>
                          <img src='images/rooms/7.png' class='d-block w-100' >
                        </div>
                        <div class='carousel-item'>
                          <img src='images/rooms/8.png' class='d-block w-100' >
                        </div>
                      </div>
                      <button class='carousel-control-prev' type='button' data-bs-target='#roomCarousel' data-bs-slide='prev'>
                       <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                        <span class='visually-hidden'>Previous</span>
                      </button>
                      <button class='carousel-control-next' type='button' data-bs-target='#roomCarousel' data-bs-slide='next'>
                        <span class='carousel-control-next-icon' aria-hidden='true'></span>
                        <span class='visually-hidden'>Next</span>
                      </button>
                    </div>
                </div>
                <div class='col-md-5 px-lg-3 px-mb-3 px-0'>
                  <h5 class='mb-3'>$room_data[name]</h5>
                    <div class='features mb-3'>
                      <h6 class='mb-1'>Features</h6>
                      $features_data
                    </div>
                    <div class='facilities mb-3'>
                      <h6 class='mb-1'>Facilities</h6>
                      $facilities_data
                    </div>
                    <div class='guest'>
                      <h6 class='mb-1'>Guest</h6>
                      <span class='badge rounded-pill text-bg-light text-wrap'>
                          {$room_data['adult']} Adult
                        </span>
                        <span class='badge rounded-pill text-bg-light text-wrap'>
                          {$room_data['children']} Children
                        </span>
                    </div>
                </div>
                <div class='col-md-2 mt-lg-0 mt-md-0 mt-4 text-center'>
                  <h6 class='mb-4'>₹{$room_data['price']} /- per night</h6>
                  <a href='room_details.php?id={$room_data['id']}' class='btn btn-sm w-100 btn-outline-dark shadow-none'>More details</a>
                </div>
              </div>
            </div>
            ";
    }
} else {
    echo "No rooms available.";
}

// Close the database connection
mysqli_close($con);
?>
