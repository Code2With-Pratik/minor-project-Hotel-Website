<?php 
  require('admin/inc/db_config.php');
  require('admin/inc/essentials.php');

  $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
  $values = [1];
  $contact_r = mysqli_fetch_assoc(select($contact_q,$values, 'i'));

?>

          <!-- nav bar -->
   <nav class="navbar navbar-expand-lg bg-body-tertiary bg-white pg-lg-3 py-lg-2 shadow-sm sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php"
          >Hotel</a
        >
        <button
          class="navbar-toggler shadow-none"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active me-2" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-2" href="rooms.php">Rooms</a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-2" href="facilities.php">Facilities</a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-2" href="contact.php">Contact Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About</a>
            </li>
          </ul>
          <div class="d-flex" role="search">
            <button
              type="button"
              class="btn btn-outline-dark shadow-none me-lg-2 me-3"
              data-bs-toggle="modal"
              data-bs-target="#loginModal"
            >
             Login
            </button>
            <button
              type="button"
              class="btn btn-outline-dark shadow-none me-lg-2"
              data-bs-toggle="modal"
              data-bs-target="#registerModal"
              >
              Register
            </button>
          </div>
        </div>
      </div>
   </nav>