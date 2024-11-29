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
    <link rel="icon" href="../images/logo/hotel-logo.avif">
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

<?php require('inc/header.php'); ?>


 <div class="container-fluid" id="main-content" >
   <div class="row">
      <div class="col-lg-10 ms-auto p-4 over-hidden">
            <h3 class="mb-4 " >SETTINGS</h3>

                <!-- General settings section -->
            <div class="card border-1 shadow-sm mb-3">
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
                <form id="general_s_form">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">General Settings</h5>
                    </div>
                    <div class="modal-body">
                      
                      <div class="mb-3 ">
                      <label class="form-label fw-bold">Site Title</label>
                      <input type="text" name="site_title" id="site_title_inp" class="form-control shadow-none" required >
                      </div>                
                      <div class="mb-3">
                      <label class="form-label fw-bold">About Us</label>
                      <textarea  name="site_about" id="site_about_inp" class="form-control shadow-none" rows="6" required ></textarea>
                      </div>
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" onclick="site_title.value = general_data.site_title, site_about.value = general_data.site_about" class="btn text-secondary shadow-none" data-bs-dismiss="modal" >CANCEL</button>
                      <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

              <!--shutdown section -->
            <div class="card border-1 shadow-sm mb-3">
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

             <!-- contact details section -->

            <div class="card border-1 shadow-sm mb-3">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                  <h5 class="card-title m-0" >Contact Settings</h5>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#contacts-s">
                  <i class="bi bi-pencil-square"></i> Edit
                  </button>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="mb-4">
                      <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                      <p class="card-text" id="address" ></p>
                    </div>
                    <div class="mb-4">
                      <h6 class="card-subtitle mb-1 fw-bold">Google Map</h6>
                      <p class="card-text" id="gmap" ></p>
                    </div>
                    <div class="mb-4">
                      <h6 class="card-subtitle mb-1 fw-bold">Phone Numbers</h6>
                      <p class="card-text mb-1">
                        <i class="bi bi-telephone-fill"></i> 
                        <span id="pn1"></span>
                      </p>
                      <p class="card-text">
                        <i class="bi bi-telephone-fill"></i> 
                        <span id="pn2"></span>
                      </p>
                    </div>
                    <div class="mb-4">
                      <h6 class="card-subtitle mb-1 fw-bold">E-mail</h6>
                      <p class="card-text" id="email" ></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                   <div class="mb-4">
                      <h6 class="card-subtitle mb-1 fw-bold">Social Links</h6>
                      <p class="card-text mb-1">
                        <i class="bi bi-facebook"></i>  
                        <span id="fb"></span>
                      </p>
                      <p class="card-text mb-1">
                        <i class="bi bi-instagram"></i>
                        <span id="insta"></span>
                      </p>
                      <p class="card-text">
                        <i class="bi bi-twitter"></i>
                        <span id="tw"></span>
                      </p>
                    </div>
                    <div class="mb-4">
                      <h6 class="card-subtitle mb-1 fw-bold">iframe</h6>
                      <iframe id="iframe" class="border p-2 w-100" loading="lazy"></iframe>
                    </div>
                  </div>
                </div>
              </div>
            </div>

                <!--Contact Detail Modal -->
            <div class="modal fade" id="contacts-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <form id="contacts_s_form">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Contact Settings</h5>
                    </div>
                    <div class="modal-body">
                      <div class="container-fluid p-0">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 ">
                            <label class="form-label fw-bold">Address</label>
                            <input type="text" name="address" id="address_inp" class="form-control shadow-none" required >
                            </div>                
                            <div class="mb-3 ">
                            <label class="form-label fw-bold">Google Map Links</label>
                            <input type="text" name="gmap" id="gmap_inp" class="form-control shadow-none" required >
                            </div>                
                            <div class="mb-3 ">
                              <label class="form-label fw-bold">Phone Number (with country code)</label>
                              <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                <input type="number" name="pn1" id="pn1_inp" class="form-control shadow-none" required>
                              </div>
                              <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                <input type="number" name="pn2" id="pn2_inp" class="form-control shadow-none">
                              </div>
                            </div>     
                            <div class="mb-3 ">
                            <label class="form-label fw-bold">E-mail</label>
                            <input type="email" name="email" id="email_inp" class="form-control shadow-none" required >
                            </div>              
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 ">
                              <label class="form-label fw-bold">Social Links</label>
                                <div class="input-group mb-3">
                                  <span class="input-group-text"><i class="bi bi-facebook"></i></span>
                                  <input type="text" name="fb" id="fb_inp" class="form-control shadow-none" required>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                                  <input type="text" name="insta" id="insta_inp" class="form-control shadow-none" required>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text"><i class="bi bi-twitter"></i></i></span>
                                  <input type="text" name="tw" id="tw_inp" class="form-control shadow-none">
                                </div>
                            </div>  
                            <div class="mb-3 ">
                              <label class="form-label fw-bold">iframe Src</label>
                              <input type="text" name="iframe" id="iframe_inp" class="form-control shadow-none" required >
                            </div>  
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" onclick="contacts_inp(contacts_data)" class="btn text-secondary shadow-none" data-bs-dismiss="modal" >CANCEL</button>
                      <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

               <!-- Management Team section -->
            <div class="card border-1 shadow-sm mb-3">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                  <h5 class="card-title m-0" >Management Team</h5>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#team-s">
                  <i class="bi bi-plus-square"></i>Add
                  </button>
                </div>

                <div class="row" id="team-data">
                  <div class="col-md-2 mb-3">
                    <div class="card bg-dark text-white">
                      <img src="../images/about/team.jpg" class="card-img">
                      <div class="card-img-overlay text-end">
                        <button type="button" class="btn btn-danger btn-sm shadow-none">
                         <i class="bi bi-trash"></i> Delete
                        </button>
                      </div>
                      <p class="card-text text-center px-3 py-2">Rakesh</p>
                    </div>
                  </div>
                  <div class="col-md-2 mb-3">
                    <div class="card bg-dark text-white">
                      <img src="../images/users/userimage2.png" class="card-img">
                      <div class="card-img-overlay text-end">
                        <button type="button" class="btn btn-danger btn-sm shadow-none">
                         <i class="bi bi-trash"></i> Delete
                        </button>
                      </div>
                      <p class="card-text text-center px-3 py-2">Tripti</p>
                    </div>
                  </div>
                  <div class="col-md-2 mb-3">
                    <div class="card bg-dark text-white">
                      <img src="../images/users/userimage.jpg" class="card-img">
                      <div class="card-img-overlay text-end">
                        <button type="button" class="btn btn-danger btn-sm shadow-none">
                         <i class="bi bi-trash"></i> Delete
                        </button>
                      </div>
                      <p class="card-text text-center px-3 py-2">Member 1</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!--Management Team Modal -->

            <div class="modal fade" id="team-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <form id="team_s_form">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Add Team Member</h5>
                    </div>
                    <div class="modal-body">  
                      <div class="mb-3 ">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" name="member_name" id="member_name_inp" class="form-control shadow-none" required >
                      </div>                
                      <div class="mb-3">
                        <label class="form-label fw-bold">Picture</label>
                        <input type="file" name="member_picture" id="member_picture_inp" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none" required >
                      </div>  
                    </div>
                    <div class="modal-footer">
                      <button type="button" onclick="member_name.value='' ,member_picture.value=''" class="btn text-secondary shadow-none" data-bs-dismiss="modal" >CANCEL</button>
                      <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>


      </div>
    </div>
</div>
 

<?php require('inc/scripts.php'); ?> 
<script src="scripts/settings.js"></script>
</body>
</html>
