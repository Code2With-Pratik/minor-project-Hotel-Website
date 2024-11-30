<?php

require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

// Fetch Admins
if (isset($_POST['get_admins'])) {
    $res = selectAll('admin_cred');
    $i = 1;

    $data = "";

    while ($row = mysqli_fetch_array($res)) {

        // Status Toggle Button
        $status = "<button onclick='toggle_status({$row['sr_no']}, 0)' class='btn btn-success btn-sm shadow-none'>
        Verified
        </button>";
        if (!$row['status']) {
          $status = "<button onclick='toggle_status({$row['sr_no']}, 1)' class='btn btn-danger btn-sm shadow-none'>
          Pending
            </button>";
        }

        // Format Date
        $date = date("d/m/y H:i", strtotime($row['datentime']));

        // Construct Table Row
        $data .= "
        <tr>
          <td>$i</td>
          <td>{$row['admin_name']}</td>
          <td>{$row['admin_email']}</td>
          <td>$date</td>
          <td>$status</td>
        </tr>
        ";
        $i++;
    }

    echo $data;
}

// Toggle Admin Status
if (isset($_POST['toggle_status'])) {
    $frm_data = filteration($_POST);

    $query = "UPDATE `admin_cred` SET `status`=? WHERE `sr_no`=?";
    $values = [$frm_data['value'], $frm_data['toggle_status']];

    if (update($query, $values, 'ii')) {
        echo 1;
    } else {
        echo 0;
    }
}

// Search Admins
if (isset($_POST['search_admins'])) {
    $frm_data = filteration($_POST);

    // Handle empty search input
    if (empty($frm_data['name'])) {
        echo "<tr><td colspan='7'>Please enter a name to search.</td></tr>";
        exit;
    }

    // Prepare the search query
    $query = "SELECT * FROM `admin_cred` WHERE `admin_name` LIKE ?";
    $res = select($query, ["%{$frm_data['name']}%"], 's');
    $i = 1;

    $data = "";

    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_array($res)) {
            // Status Toggle Button
            $status = "<button onclick='toggle_status({$row['sr_no']}, 0)' class='btn btn-success btn-sm shadow-none'>
            Verified
            </button>";
            if (!$row['status']) {
              $status = "<button onclick='toggle_status({$row['sr_no']}, 1)' class='btn btn-danger btn-sm shadow-none'>
              Pending
                </button>";
            }

            // Format Date
            $date = date("d-m-y H:i", strtotime($row['datentime']));

            // Construct Table Row
            $data .= "
            <tr>
              <td>$i</td>
              <td>{$row['admin_name']}</td>
              <td>{$row['admin_email']}</td>
              <td>$date</td>
              <td>$status</td>
            </tr>
            ";
            $i++;
        }
    } else {
        // No Admins Found
        $data = "<tr><td colspan='7'>No admins found.</td></tr>";
    }

    echo $data;
}
?>
