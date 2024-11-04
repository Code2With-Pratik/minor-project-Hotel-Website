<?php
 
    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();

    if(isset($_POST['get_general']))
    {
        $q = "SELECT * FROM `settings` WHERE `sr_no`=?";
        $values = [1];
        $res = select($q,$values,"i");
        $data = mysqli_fetch_assoc($res);
        $json_data = json_encode($data);
        echo $json_data;
    }

    if(isset($_POST['upd_general']))
    {
        $frm_data = filteration($_POST);

        $q = "UPDATE `settings` SET `site_title`=?,`site_about`=? WHERE `sr_no`=?";
        $values = [$frm_data['site_title'],$frm_data['site_about'],1];
        $res = update($q,$values,'ssi');
        echo $res;
    }


    if(isset($_POST['upd_shutdown']))
    {
        $frm_data = ($_POST['upd_shutdown']==0) ? 1 : 0;

        $q = "UPDATE `settings` SET `shutdown`=? WHERE `sr_no`=?";
        $values = [$frm_data,1];
        $res = update($q,$values,'ii');
        echo $res;
    }

    if(isset($_POST['get_contacts']))
    {
        $q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
        $values = [1];
        $res = select($q,$values,"i");
        $data = mysqli_fetch_assoc($res);
        $json_data = json_encode($data);
        echo $json_data;
    }

    if(isset($_POST['upd_contacts']))
    {
        $frm_data = filteration($_POST);

        $q = "UPDATE `contact_details` SET `address`=?,`gmap`=?,`pn1`=?,`pn2`=?,`email`=?,`fb`=?,`insta`=?,`tw`=?,`iframe`=? WHERE `sr_no`=?";
        $values = [$frm_data['address'],$frm_data['gmap'],$frm_data['pn1'],$frm_data['pn2'],$frm_data['email'],$frm_data['fb'],$frm_data['insta'],$frm_data['tw'],$frm_data['iframe'],1];
        $res = update($q,$values,'sssssssssi');
        echo $res;
    }

    if(isset($_POST['add_member']))
    {
        $frm_data = filteration($_POST);

        $img_r = uploadImage($_FILES['picture'],ABOUT_FOLDER);

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
            $q = "INSERT INTO `team_details`(`name`, `picture`) VALUES (?,?)";
            $values = [$frm_data['name'],$img_r];
            $res = insert($q,$values,'ss');
            echo $res;
        }
    }
 

    

?>
