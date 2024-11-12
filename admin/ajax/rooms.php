<?php
 
    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();

    if (isset($_POST['add_room']))
    {
        $features = filteration(json_decode($_POST['features']));
        $facilities = filteration(json_decode($_POST['facilities']));

        $frm_data = filteration($_POST);

        $q1 = "INSERT INTO `rooms`(`name`, `area`, `price`, `quantity`, `adult`, `children`, `description`) VALUES (?,?,?,?,?,?,?)";
        $values = [$frm_data['name'],$frm_data['area'],$frm_data['price'],$frm_data['quantity'],$frm_data['adult'],$frm_data['children'],$frm_data['desc']];

        if(insert($q1,$values,'siiiiis')){
            $flag = 1;
        }

        $room_id = mysqli_insert_id($con);

        $q2 = "INSERT INTO `room_facilities`(`room_id`, `facilities_id`) VALUES (?,?)";
        if($stmt = mysqli_prepare($con,$q2))
        {
            foreach($facilities as $f){
                mysqli_stmt_bind_param($stmt,'ii',$room_id,$f);
                mysqli_stmt_execute($stmt);
            }
            mysqli_stmt_close($stmt);
        }
        else{
            $flag = 0;
            die('query cannot be prepared - insert');
        }

        $q3 = "INSERT INTO `room_features`(`room_id`, `features_id`) VALUES (?,?)";
        if($stmt = mysqli_prepare($con,$q3))
        {
            foreach($features as $f){
                mysqli_stmt_bind_param($stmt,'ii',$room_id,$f);
                mysqli_stmt_execute($stmt);
            }
            mysqli_stmt_close($stmt);
        }
        else{
            $flag = 0;
            die('query cannot be prepared - insert');
        }

        if($flag){
            echo 1;
        }
        else{
            echo 0;
        }
    }

    if (isset($_POST['get_all_rooms']))
    {
      $res = selectAll('rooms');
      $i=1;

      $data = "";

      while($row = mysqli_fetch_array($res))
      {
         if($row['status']==1){
          $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>active</button>
          ";
         }
         else{
          $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-warning btn-sm shadow-none'>inactive</button>";
         }


        $data.="
          <tr class='align-middle'>
             <td>$i</td>
             <td>$row[name]</td>
             <td>$row[area] sq. ft.</td>
             <td>
               <span class='badge rounded-pill bg-light text-dark'>
                 Adult: $row[adult]
               </span><br>
               <span class='badge rounded-pill bg-light text-dark'>
                 Children: $row[children]
               </span>
             </td>
             <td>₹$row[price]</td>
             <td>$row[quantity]</td>
             <td>$status</td>
             <td>
                  <button type='button' class='btn btn-primary shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-room'>
                    <i class='bi bi-pencil-square'></i>
                  </button>
             </td>
          </tr>
        ";
        $i++;
      }

      echo $data;
    }

    if (isset($_POST['toggle_status']))
    {
      $frm_data = filteration($_POST);

      $q = "UPDATE `rooms` SET `status`=? WHERE `id`=?";
      $v = [$frm_data['value'],$frm_data['toggle_status']];

      if(update($q,$v,'ii')){
        echo 1;
      }
      else{
        echo 0;
      }
    }

?>
