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
        
        $q = "DELETE FROM `features` WHERE `id`=?";
        $res = delete($q,$values,'i'); 
        echo $res;
    }

    if(isset($_POST['add_facility']))
    {
        $frm_data = filteration($_POST);

        $img_r = uploadSVGImage($_FILES['icon'],FEATURES_FOLDER);

        if($img_r == 'inv_img'){
            echo $img_r;
        }
        else if($img_r == 'inv_size'){
            echo $img_r;
        }
        else if($img_r == 'upd_failed'){
            echo $img_r;
        }
        else{
            $q = "INSERT INTO `facilities`(`icon`, `name`, `description`) VALUES (?,?,?)";
            $values = [$img_r,$frm_data['name'],$frm_data['desc']];
            $res = insert($q,$values,'sss');
            echo $res;
        }
    }

?>
