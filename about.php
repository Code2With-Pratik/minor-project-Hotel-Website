<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>GrandStay - About</title>
    <link rel="icon" href="images/logo/hotel-logo.avif">
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <style>
      .box:hover{
         border-top-color: var(--teal) !important;
      }
    </style>
  </head>
  <body class="bg-light">

  <?php require('inc/header.php'); ?>
      
<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">About Us</h2>
  <div class="h-line bg-dark "></div>
  <p class="text-center mt-3">
     Experience Grandeur, Every Day Where Luxury Meets Comfort</br>
        Experience Grandeur, Every Day .Affordable Comfort,
        <br> Anytime and Smart Stays for Savvy Travelers
       . Simplify Your Stay </p>
  </p>
</div>

<div class="container">
  <div class="row justify-content-between  align-items-center">
    <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
      <h2 class="mb-4 fw-bold h-font">"GrandStay - Where Every Stay is a Grand Experience"</h2>
      <h6 class="mb-4 h-font">- grandstay</h6>

      <p>
      "Welcome to GrandStay, where comfort meets luxury. Experience exceptional
       hospitality, world-class amenities, and unforgettable stays tailored just for you."
      Discover relaxation, convenience, and a welcoming atmosphere at every step.
       Let GrandStay be your destination for timeless experiences and cherished moments."
      </p>
    </div>
    <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
       <img src="images/about/about.jpg" class="w-100">
    </div>
  </div>
</div>

<div class="container mt-5">
  <div class="row">
    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
        <img src="images/about/hotel.svg" width="70px">
        <h4 class="mt-3">100+ ROOMS</h4>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
        <img src="images/about/customers.svg" width="70px">
        <h4 class="mt-3">200+ CUSTOMERS</h4>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
        <img src="images/about/rating.svg" width="70px">
        <h4 class="mt-3">150+ REVIEWS</h4>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
        <img src="images/about/staff.svg" width="70px">
        <h4 class="mt-3">200+ STAFF</h4>
      </div>
    </div>
  </div>
</div>

<h3 class="my-5 fw-bold h-font text-center">MANAGHEMENT TEAM</h3>

<div class="container px-4">
  <!-- Swiper -->
  <div class="swiper mySwiper">
    <div class="swiper-wrapper mb-5 ">
      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="images/users/images.jpeg" class="w-100">
        <h5 class="mt-2">Henry</h5>
      </div>
      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="images/users/employee.jpg" class="w-100">
        <h5 class="mt-2">Sufi</h5>
      </div>  
      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="images/users/images2jpeg.jpeg" class="w-100">
        <h5 class="mt-2">Goyal</h5>
      </div>
      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="images/users/images3.jpeg" class="w-100">
        <h5 class="mt-2">Param</h5>
      </div>
      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="images/users/images4.jpeg" class="w-100">
        <h5 class="mt-2">Maria</h5>
      </div>
    </div>
    <div class="swiper-pagination"></div>
  </div>
</div>

 <?php require('inc/footer.php');?>

  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
       slidesPerView: 4,
       spaceBetween: 40,
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints: {
        320: {
          slidePerView: 1,
        },
        640: {
          slidePerView: 1,
        },
        768: {
          slidePerView: 3,
        },
        1024: {
          slidePerView: 3,
        },
      }
    });
  </script>
  
  </body>
</html>
