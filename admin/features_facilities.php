<?php
  require('inc/essentials.php');
  require('inc/db_config.php');
  adminLogin();

        // for marked as read button 
  if(isset($_GET['seen']))
  {
    $frm_data = filteration($_GET);

    if($frm_data['seen']=='all'){
      $q = "UPDATE `user_queries` SET `seen`=?";
      $values = [1];
      if(update($q,$values,'i')){
        alert('success','Marked all as read!');
      }
      else{
        alert('error','Operation Failed!');
      }
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

        // for delete button
  if(isset($_GET['del']))
  {
    $frm_data = filteration($_GET);

    if($frm_data['del']=='all'){
      $q = "DELETE FROM `user_queries`";
      if(mysqli_query($con,$q)){
        alert('success','All data deleted!');
      }
      else{
        alert('error','Operation Failed!');
      }
    }
    else{
      $q = "DELETE FROM `user_queries` WHERE `sr_no`=?";
      $values = [$frm_data['del']];
      if(delete($q,$values,'i')){
        alert('success','Data deleted!');
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
    <title>Admin Panel - Features & Facilities</title>
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

<?php require('inc/header.php'); ?>


 <div class="container-fluid" id="main-content" >
   <div class="row">
      <div class="col-lg-10 ms-auto p-4 over-hidden">
            <h3 class="mb-4 " >FEATURES & FACILITIES</h3>

               <!-- User queries section -->
            <div class="card border-0 shadow-sm mb-4">
              <div class="card-body">

                  <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="card-title m-0" >Features</h5>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#feature-s">
                    <i class="bi bi-plus-square"></i>Add
                    </button>
                  </div>

              
                  <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                      <table class="table table-hover border">
                        <thead class="sticky-top">
                          <tr>
                            <th class="bg-dark text-light" scope="col">#</th>
                            <th class="bg-dark text-light" width="10%" scope="col">Name</th>
                            <th class="bg-dark text-light  scope="col">Email</th>
                            <th class="bg-dark text-light" width="20%" scope="col">Subject</th>
                            <th class="bg-dark text-light" width="30%" scope="col">Message</th>
                            <th class="bg-dark text-light" width="20%" scope="col">Date</th>
                            <th class="bg-dark text-light" width="25%" scope="col">Action</th>
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
                                $seen = "<a href='?seen=$row[sr_no]' class='btn btn-sm rounded-pill btn-primary'>Marked as read</a> <br>";
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
 
                 <!-- features  Modal -->

<div class="modal fade" id="feature-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="feature_s_form">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Feature</h5>
        </div>
        <div class="modal-body">
          <div class="mb-3 ">
            <label class="form-label fw-bold">Name</label>
            <input type="text" name="feature_name" class="form-control shadow-none" required >
          </div>                
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal" >CANCEL</button>
          <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
        </div>
      </div>
    </form>
  </div>
</div>


<?php require('inc/scripts.php'); ?> 

</body>
</html>