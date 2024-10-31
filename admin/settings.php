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
      <div class="card border-0 shadow mb-4">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0" >General Settings</h5>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#general-s">
            <i class="bi bi-pencil-square"></i> Edit
            </button>
          </div>
          <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
          <p class="card-text" id="site_title" ></p>
          <h6 class="card-subtitle mb-1 fw-bold">About Us</h6>
          <p class="card-text" id="site_about" ></p>
        </div>
      </div>

        <!--General settings Modal -->
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
                 <input type="text" name="site_title" id="site_title_inp" class="form-control shadow-none">
                </div>                
                <div class="mb-3">
                 <label class="form-label">About Us</label>
                 <textarea  name="site_about" id="site_about_inp" class="form-control shadow-none" rows="6"></textarea>
                </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" onclick="site_title.value = general_data.site_title, site_about.value = general_data.site_about" class="btn text-secondary shadow-none" data-bs-dismiss="modal" >CANCEL</button>
                <button type="button" onclick="upd_general(site_title.value,site_about.value)" class="btn custom-bg text-white shadow-none">SUBMIT</button>
              </div>
            </div>
          </form>
        </div>
      </div>

        <!--shutdown section -->
      <div class="card border-0 shadow">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0" >Shutdown Website</h5>
            <div class="form-check form-switch">
              <form>
                <input onchange="upd_shutdown(this.value)" class="form-check-input" type="checkbox" role="switch" id="shutdown-toggle" >
              </form>
            </div>
          </div>
          <p class="card-text">
            No customers will be allowed to book hotel rooms, When Shutdown mode is turned On.
          </p>
        </div>
      </div>

    </div>
  </div>
 </div>
 


<?php require('inc/scripts.php'); ?> 
<!-- AJAX code -->
<script>
  let general_data;

  function get_general()
  {
    let site_title = document.getElementById('site_title');
    let site_about = document.getElementById('site_about');
    
    let site_title_inp = document.getElementById('site_title_inp');
    let site_about_inp = document.getElementById('site_about_inp');

    let shutdown_toggle = document.getElementById('shutdown-toggle');
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php",true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
      general_data = JSON.parse(this.responseText);
      
      site_title.innerText = general_data.site_title;
      site_about.innerText = general_data.site_about;

      site_title_inp.value = general_data.site_title;
      site_about_inp.value = general_data.site_about;

      if(general_data.shutdown == 0){
        shutdown_toggle.checked = false;
        shutdown_toggle.value = 0;
      }
      else{
        shutdown_toggle.checked = true;
        shutdown_toggle.value = 1;
      }
    }

    xhr.send('get_general');
  }

  function upd_general(site_title_val,site_about_val)
  {
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php",true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){

      var myModal = document.getElementById('general-s');
      var modal = bootstrap.Modal.getInstance(myModal);
       modal.hide();
       
       if(this.responseText == 1)
       {
        alert('success','Changes saved!');
        get_general();
      }
        else
        {
        alert('error','No Changes made!');
        }
      
    }

    xhr.send('site_title='+site_title_val+'&site_about='+site_about_val+'&upd_general');
  }

  function upd_shutdown(val)
  {
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php",true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
       
       if(this.responseText == 1 && general_data.shutdown==0)
       {
        alert('success','Site has been shutdown!');
      }
      else
      {
        alert('success','Shutdown mode is off!');
      }
      get_general();
    }

    xhr.send('upd_shutdown='+val);
  }

  window.onload = function(){
    get_general();
  }

</script>
</body>
</html>