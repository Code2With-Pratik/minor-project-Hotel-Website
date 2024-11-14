<?php
 
    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();


    if(isset($_POST['add_feature']))
    {
        $frm_data = filteration($_POST);

        $q = "INSERT INTO `features`(`name`) VALUES (?)";
        $values = [$frm_data['name']];
        $res = insert($q,$values,'s');
        echo $res;
    }
 
    if(isset($_POST['get_features']))
    {
        $res = selectAll('features'); 
        $i=1;

        while($row = mysqli_fetch_assoc($res))
        {
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

    if(isset($_POST['rem_feature']))
    {
        $frm_data = filteration($_POST);
        $values = [$frm_data['rem_feature']];

        $check_q = select('SELECT * FROM `room_features` WHERE `features_id`=?',[$frm_data['rem_feature']],'i');

        if(mysqli_num_rows($check_q)==0){
            $q = "DELETE FROM `features` WHERE `id`=?";
            $res = delete($q,$values,'i'); 
            echo $res;
        }
        else{
            echo 'room_added';
        }
        
    }
    
    if (isset($_POST['add_facility'])) {
        $frm_data = filteration($_POST);
    
        $q = "INSERT INTO `facilities`(`name`, `description`) VALUES (?, ?)";
        $values = [$frm_data['name'], $frm_data['desc']]; // Use 'desc' to match JavaScript
        $res = insert($q, $values, 'ss');
        echo $res;
    }
    
    if (isset($_POST['get_facility'])) {
        $res = selectAll('facilities'); 
        $i = 1;
    
        // Output each facility in a table row
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

    if(isset($_POST['rem_facility']))
    {
        $frm_data = filteration($_POST);
        $values = [$frm_data['rem_facility']];

        $check_q = select('SELECT * FROM `room_facilities` WHERE `facilities_id`=?',[$frm_data['rem_facility']],'i');

        if(mysqli_num_rows($check_q)==0)
        {
            $pre_q = "SELECT * FROM `facilities` WHERE `id`=?";
            $res = select($pre_q,$values,'i');
            $img = mysqli_fetch_assoc($res);
         }
         else{
            echo 'room_added';
         }
    }
    
    
?>