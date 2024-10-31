<?php
  require('inc/essentials.php');
  adminLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Settings</title>
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

<?php require('inc/header.php'); ?>


 <div class="container-fluid" id="main-content" >
  <div class="row">
    <div class="col-lg-10 ms-auto p-4 over-hidden">
      <h3 class="mb-4 " >SETTINGS</h3>

           <!-- General settings section -->
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0" >General Settings</h5>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#general-s">
            <i class="bi bi-pencil-square"></i> Edit
            </button>
          </div>
          <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
          <p class="card-text">content</p>
          <h6 class="card-subtitle mb-1 fw-bold">About Us</h6>
          <p class="card-text">content</p>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form>
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">General Settings</h5>
              </div>
              <div class="modal-body">
                
                <div class="mb-3 ">
                 <label class="form-label">Site Title</label>
                 <input type="text" name="site_title"  class="form-control shadow-none">
                </div>                
                <div class="mb-3">
                 <label class="form-label">About Us</label>
                 <textarea  name="site_about" class="form-control shadow-none" rows="6"></textarea>
                </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal" >CANCEL</button>
                <button type="button" class="btn custom-bg text-white shadow-none">SUBMIT</button>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
 </div>
 


<?php require('inc/scripts.php'); ?> 
</body>
</html>