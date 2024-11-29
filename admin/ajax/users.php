<?php

  require('../inc/db_config.php');
  require('../inc/essentials.php');
  adminLogin();


  if (isset($_POST['get_users'])) {
    $res = selectAll('registered_users');
    $i = 1;

    $data = "";

    while ($row = mysqli_fetch_array($res)) {
        $del_btn = "<button type='button' onclick='remove_user({$row['id']})' class='btn btn-danger shadow-none btn-sm'>
          <i class='bi bi-trash'></i>
        </button>";

        $verified = "<span class='badge bg-danger'><i class='bi bi-x-lg'></i></span>";

        if ($row['is_verified']) {
            $verified = "<span class='badge bg-success'><i class='bi bi-check2'></i></span>";
        }

        $status = "<button onclick='toggle_status({$row['id']}, 0)' class='btn btn-dark btn-sm shadow-none'>
          active
        </button>";

        if (!$row['status']) {
            $status = "<button onclick='toggle_status({$row['id']}, 1)' class='btn btn-danger btn-sm shadow-none'>
              inactive
            </button>";
        }

        $date = date("d/m/y", strtotime($row['datentime']));

        $data .= "
        <tr>
          <td>$i</td>
          <td>
           <img src='' width='55px'><i class='bi bi-person-bounding-box'></i>
           <br>
           {$row['name']}
          </td>
          <td>{$row['email']}</td>
          <td>{$row['phone']}</td>
          <td>{$row['address']} | {$row['pincode']}</td>
          <td>{$row['dob']}</td>
          <td>$verified</td>
          <td>$status</td>
          <td>$date</td>
          <td>$del_btn</td>
        </tr>
        ";
        $i++;
    }

    echo $data;
}

  if (isset($_POST['toggle_status']))
  {
    $frm_data = filteration($_POST);

    $q = "UPDATE `registered_users` SET `status`=? WHERE `id`=?";
    $v = [$frm_data['value'],$frm_data['toggle_status']];

    if(update($q,$v,'ii')){
      echo 1;
    }
    else{
      echo 0;
    }
  }

  if (isset($_POST['remove_user'])) {
    // Sanitize incoming data to prevent SQL injection
    $frm_data = filteration($_POST);
    
    // Execute the DELETE query
    $res = delete(
        "DELETE FROM `registered_users` WHERE `id`=? AND `is_verified`=?", 
        [$frm_data['user_id'], 0], // Ensure only unverified users can be deleted
        'ii' // Specify parameter types: two integers
    );

    // Return the appropriate response
    if ($res) {
        echo 1; // Success response for deletion
    } else {
        echo 0; // Failure response
    }
}

if (isset($_POST['search_users'])) {
  $frm_data = filteration($_POST);

  // Handle empty search input
  if (empty($frm_data['name'])) {
      echo "<tr><td colspan='10'>Please enter a name to search.</td></tr>";
      exit;
  }

  // Prepare the search query
  $query = "SELECT * FROM `registered_users` WHERE `name` LIKE ?";
  $res = select($query, ["%{$frm_data['name']}%"], 's');
  $i = 1;

  $data = "";

  if (mysqli_num_rows($res) > 0) {
      while ($row = mysqli_fetch_array($res)) {
          // Delete button
          $del_btn = "<button type='button' onclick='remove_user({$row['id']})' class='btn btn-danger shadow-none btn-sm'>
              <i class='bi bi-trash'></i>
          </button>";

          // Verification status
          $verified = "<span class='badge bg-danger'><i class='bi bi-x-lg'></i></span>";
          if ($row['is_verified']) {
              $verified = "<span class='badge bg-success'><i class='bi bi-check2'></i></span>";
          }

          // Account status toggle
          $status = "<button onclick='toggle_status({$row['id']}, 0)' class='btn btn-dark btn-sm shadow-none'>
              active
          </button>";
          if (!$row['status']) {
              $status = "<button onclick='toggle_status({$row['id']}, 1)' class='btn btn-danger btn-sm shadow-none'>
                  inactive
              </button>";
          }

          // Format date
          $date = date("d-m-y", strtotime($row['datentime']));

          // Construct table row
          $data .= "
          <tr>
              <td>$i</td>
              <td>
                  <img src='' width='55px'><i class='bi bi-person-bounding-box'></i>
                  <br>
                  {$row['name']}
              </td>
              <td>{$row['email']}</td>
              <td>{$row['phone']}</td>
              <td>{$row['address']} | {$row['pincode']}</td>
              <td>{$row['dob']}</td>
              <td>$verified</td>
              <td>$status</td>
              <td>$date</td>
              <td>$del_btn</td>
          </tr>
          ";
          $i++;
      }
  } else {
      // No users found
      $data = "<tr><td colspan='10'>No users found.</td></tr>";
  }

  echo $data;
}

?>
