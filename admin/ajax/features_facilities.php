<?php

require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

// Add a new feature to the database
if (isset($_POST['add_feature'])) {
    $frm_data = filteration($_POST);
    $q = "INSERT INTO `features`(`name`) VALUES (?)";
    $values = [$frm_data['name']];
    $res = insert($q, $values, 's');

    echo $res ? $res : "Failed to add feature";
}

// Get all features from the database
if (isset($_POST['get_features'])) {
    $res = selectAll('features'); 
    $i = 1;

    while ($row = mysqli_fetch_assoc($res)) {
        echo <<<data
          <tr>
            <td>$i</td>
            <td>$row[name]</td>
            <td>
              <button type="button" onclick="rem_feature($row[id])" class="btn btn-danger btn-sm shadow-none">
                <i class="bi bi-trash"></i> Delete
              </button>
            </td>
          </tr>
        data;
        $i++;
    }
}

// Remove a feature from the database
if (isset($_POST['rem_feature'])) {
    $frm_data = filteration($_POST);
    $feature_id = $frm_data['rem_feature'];

    // Check if the feature is associated with any room
    $check_q = select('SELECT * FROM `room_features` WHERE `features_id`=?', [$feature_id], 'i');

    if (mysqli_num_rows($check_q) == 0) {
        // Delete feature if not associated
        $q = "DELETE FROM `features` WHERE `id`=?";
        $res = delete($q, [$feature_id], 'i'); 
        echo $res ? $res : "Failed to delete feature";
    } else {
        echo 'room_added'; // Feature is still linked to rooms
    }
}

// Add a new facility to the database
if (isset($_POST['add_facility'])) {
    $frm_data = filteration($_POST);
    $q = "INSERT INTO `facilities`(`name`, `description`) VALUES (?, ?)";
    $values = [$frm_data['name'], $frm_data['desc']];
    $res = insert($q, $values, 'ss');

    echo $res ? $res : "Failed to add facility";
}

// Get all facilities from the database
if (isset($_POST['get_facility'])) {
    $res = selectAll('facilities'); 
    $i = 1;

    while ($row = mysqli_fetch_assoc($res)) {
        echo <<<data
            <tr>
                <td>{$i}</td>
                <td>{$row['name']}</td>
                <td>{$row['description']}</td>
                <td>
                    <button type="button" onclick="rem_facility({$row['id']})" class="btn btn-danger btn-sm shadow-none">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </td>
            </tr>
        data;
        $i++;
    }
}

// Remove a facility from the database
if (isset($_POST['rem_facility'])) {
    $frm_data = filteration($_POST);
    $facility_id = $frm_data['rem_facility'];

    // Check if the facility is associated with any room
    $check_q = select('SELECT * FROM `room_facilities` WHERE `facilities_id`=?', [$facility_id], 'i');

    if (mysqli_num_rows($check_q) == 0) {
        // Fetch the facility record to retrieve associated data, if necessary
        $res = select('SELECT * FROM `facilities` WHERE `id`=?', [$facility_id], 'i');
        
        if ($img = mysqli_fetch_assoc($res)) {
            // Delete the facility
            $q = "DELETE FROM `facilities` WHERE `id`=?";
            $del_res = delete($q, [$facility_id], 'i');
            echo $del_res ? $del_res : "Failed to delete facility";
        } else {
            echo "Failed to fetch facility data for deletion";
        }
    } else {
        echo 'room_added'; // Facility is still linked to rooms
    }
}

?>
