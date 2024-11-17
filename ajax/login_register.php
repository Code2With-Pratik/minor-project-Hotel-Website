<?php
    require('../admin/inc/db_config.php');
    require('../admin/inc/essentials.php');

    
    if(isset($_POST['register']))
    {
        $data = filteration($_POST);

        // match password and confirm password field

        if($data['pass'] != $data['cpass']){
            echo 'pass_mismatch';
            exit;
        }

        // check user exist or not 

        $u_exist = select("SELECT * FROM `user_cred` WHERE `email`= ? AND `phonenum`= ? LIMIT 1",
        [$data['email'],$data['phonenum']],"ss");

        if(mysqli_num_rows($u_exist)!=0){
            $u_exist_fetch = mysqli_fetch_assoc($u_exist);
            echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
            exit; 
        }

        // upload user image too server

        $img = uploadUserImage($_FILES['profile']);

        if($img == 'inv_img'){
            echo 'inv_image';
            exit;
        }
        else if($img == 'upd_failed'){
            echo 'updfailed';
            exit;
        }

        // send email confirmation link to the user's email

        
        
    }
?>