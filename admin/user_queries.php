<?php
  require('inc/essentials.php');
  require('inc/db_config.php');
  adminLogin();

  if(isset($_GET['seen']))
  {
    $frm_data = filteration($_GET);

    if($frm_data['seen']=='all'){

    }
    else{
      $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
      $values = [1,$frm_data['seen']];
      if(update($q,$values,'ii')){
        alert('success','Marked as read!');
      }
      else{
        alert('error','Operation Failed!');
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - User Queries</title>
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

<?php require('inc/header.php'); ?>


 <div class="container-fluid" id="main-content" >
   <div class="row">
      <div class="col-lg-10 ms-auto p-4 over-hidden">
            <h3 class="mb-4 " >USER QUERIES</h3>

               <!-- User queries section -->
            <div class="card border-0 shadow-sm mb-4">
              <div class="card-body">
              
                  <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                      <table class="table table-hover border">
                        <thead class="sticky-top">
                          <tr>
                            <th class="bg-dark text-light" scope="col">#</th>
                            <th class="bg-dark text-light" width="10%" scope="col">Name</th>
                            <th class="bg-dark text-light" scope="col">Email</th>
                            <th class="bg-dark text-light" width="20%" scope="col">Subject</th>
                            <th class="bg-dark text-light" width="30%" scope="col">Message</th>
                            <th class="bg-dark text-light" scope="col">Date</th>
                            <th class="bg-dark text-light" width="15%" scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $q = "SELECT * FROM `user_queries` ORDER BY `sr_no` DESC";
                            $data = mysqli_query($con,$q);
                            $i=1;

                            while($row = mysqli_fetch_assoc($data))
                            {
                              $seen='';
                              if($row['seen']!=1){
                                $seen = "<a href='?seen=$row[sr_no]' class='btn btn-sm rounded-pill btn-primary'>Marked as read</a>";
                              }
                              $seen.="<a href='?del=$row[sr_no]' class='btn btn-sm rounded-pill btn-danger mt-2'>Delete</a>";
                              echo<<<query
                              <tr>
                                <td>$i</td>
                                <td>$row[name]</td>
                                <td>$row[email]</td>
                                <td>$row[subject]</td>
                                <td>$row[message]</td>
                                <td>$row[date]</td>
                                <td>$seen</td>
                              </tr>
                              query;
                              $i++;
                            }
                          ?>
                        </tbody>
                      </table>
                  </div>

              </div>
            </div>

      </div>
    </div>
</div>
 


<?php require('inc/scripts.php'); ?> 

</body>
</html>