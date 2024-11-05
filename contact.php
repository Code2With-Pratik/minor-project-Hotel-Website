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
    <iframe class="w-100 rounded mb-4" height="320px" src="<?php echo $contact_r['iframe']?>" loading="lazy"></iframe>
      <h5>Address</h5>
      <a href="<?php echo $contact_r['gmap']?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
      <i class="bi bi-geo-alt-fill"></i> <?php echo $contact_r['address']?>
      </a>
      <h5 class="mt-4">Call Us</h5>
    <a href="tel:+<?php echo $contact_r['pn1']?>" class="d-inline-block mb-2 text-decoration-none text-dark">
      <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn1']?>
    </a>
    <br>
    <?php
      if($contact_r['pn2']!=''){
        echo<<<data
          <a href="tel: +$contact_r[pn2]" class="d-inline-block text-decoration-none text-dark">
            <i class="bi bi-telephone-fill"></i> +$contact_r[pn2]
          </a>
        data;
      }
    ?>
    <h5 class="mt-4">Email</h5>
    <a href="mailto: <?php echo $contact_r['email']?>" class="d-inline-block text-decoration-none text-dark">
    <i class="bi bi-envelope-at-fill"></i>   <?php echo $contact_r['email']?>
    </a>

    <h5 class="mt-4">Follow Us</h5>
    <?php 
      if($contact_r['tw']!=''){
        echo<<<data
          <a href="$contact_r[tw]" class="d-inline-block text-dark fs-5 me-2">
            <span class="badge bg-light text-dark fs-6">
            <i class="bi bi-twitter"></i></span>
          </a>
        data;
      }
    ?>

    <a href="<?php echo $contact_r['insta']?>" class="d-inline-block text-dark fs-5 me-2">
      <span class="badge bg-light text-dark fs-6">
      <i class="bi bi-instagram"></i></span>
    </a>
    <a href="<?php echo $contact_r['fb']?>" class="d-inline-block text-dark fs-5">
      <span class="badge bg-light text-dark fs-6">
      <i class="bi bi-facebook"></i></span>
    </a>
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
