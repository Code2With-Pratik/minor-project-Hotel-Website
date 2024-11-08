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

    if(isset($_POST['rem_member']))
    {
        $frm_data = filteration($_POST);
        $values = [$frm_data['rem_member']];

        $pre_q = "SELECT * FROM `team_details` WHERE `sr_no`=?";
        $res = select($pre_q,$values,'i');
        $img = mysqli_fetch_assoc($res);

        if(deleteImage($img['picture'],ABOUT_FOLDER)){
            $q = "DELETE FROM `team_details` WHERE `sr_no`=?";
            $res = delete($q,$values,'i'); 
            echo $res;
        }
        else{
            echo 0;
        }

    }

?>
