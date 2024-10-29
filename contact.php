<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hotel - Contact</title>
    <?php require('inc/links.php'); ?>
    <style>
      .pop:hover{
        border-top-color: var(--teal) !important;
        transform: scale(1.03);
        transition: all 0.3s;
      }
    </style>
  </head>
  <body class="bg-light">

  <?php require('inc/header.php'); ?>
      
<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">CONTACT US</h2>
  <div class="h-line bg-dark "></div>
  <p class="text-center mt-3">
    Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
    Exercitationem quasi deleniti quae <br> officiis accusamus minus iusto, 
    corrupti perferendis harum maxime.
  </p>
</div>

<div class="container">
  <div class="row">
<div class="col-lg-6 col-md-6 mb-5 px-4">


   <div class="bg-white rounded shadow p-4">
    <iframe class="w-100 rounded mb-4" height="320px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d119037.49550084474!2d81.338075!3d21.19526785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a293cccec49ed45%3A0x2b3ff3bd73c91877!2sBhilai%2C%20Chhattisgarh!5e0!3m2!1sen!2sin!4v1729050881199!5m2!1sen!2sin" loading="lazy"></iframe>
      <h5>Address</h5>
      <a href="https://maps.app.goo.gl/uwVXCux5icuxVRdB8" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
      <i class="bi bi-geo-alt-fill"></i> XYX, bhilai, Chhattisgarh
      </a>
      <h5 class="mt-4">Call Us</h5>
    <a href="tel:+919876543210" class="d-inline-block mb-2 text-decoration-none text-dark">
      <i class="bi bi-telephone-fill"></i> +91 9876543210
    </a>
    <br>
    <a href="tel:+919876543210" class="d-inline-block text-decoration-none text-dark">
      <i class="bi bi-telephone-fill"></i> +91 9876543210
    </a>
    <!-- <h5 class="mt-4">Email</h5>
    <a href="mailto: try.pratik1204@gmail.com" class="d-inline-block text-decoration-none text-dark">
    <i class="bi bi-envelope-at-fill"></i>   try.pratik1204@gmail.com
    </a> -->


    <!-- <h5 class="mt-4">Follow Us</h5>
    <a href="#" class="d-inline-block text-dark fs-5 me-2">
      <span class="badge bg-light text-dark fs-6">
      <i class="bi bi-twitter"></i></span>
    </a>
    <a href="#" class="d-inline-block text-dark fs-5 me-2">
      <span class="badge bg-light text-dark fs-6">
      <i class="bi bi-instagram"></i></span>
    </a>
    <a href="#" class="d-inline-block text-dark fs-5">
      <span class="badge bg-light text-dark fs-6">
      <i class="bi bi-facebook"></i></span>
    </a> -->
     </div>
 </div>
    <div class="col-lg-6 col-md-6 px-4">
      <div class="bg-white rounded shadow p-4">
        <form>
        <h5>Send a message</h5>
        <div class="mt-3 ">
          <label class="form-label" style="font-weight: 500;">Name</label>
          <input type="text" class="form-control shadow-none">
          </div>
        <div class="mt-3 ">
          <label class="form-label" style="font-weight: 500;">Email</label>
          <input type="email" class="form-control shadow-none">
          </div>
        <div class="mt-3 ">
          <label class="form-label" style="font-weight: 500;">Subject</label>
          <input type="text" class="form-control shadow-none">
          </div>
        <div class="mt-3 ">
          <label class="form-label" style="font-weight: 500;">Message</label>
          <textarea class="form-control shadow-none" rows="5" style="resize: none;"></textarea>
          </div>
      <button type="submit" class="btn text-white custom-bg mt-3">SEND</button>

        </form>        
      </div>
    </div>

  </div>
</div>



 <?php require('inc/footer.php');?>

  
  </body>
</html>
