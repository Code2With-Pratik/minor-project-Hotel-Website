<div class="container-fluid bg-white mt-5">
   <div class="row">
    <div class="col-lg-4 p-4">
        <h3 class="h-font fw-bold fs-3 mb-2">Hotel</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
           Iste quas optio voluptas.</p>
           Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Placeat, cumque.
    </div>
    <div class="col-lg-4 p-4">
          <h5 mb-3>link</h5>
          <a class="d-inline-block mb-2 text-dark text-decoration-none" href="index.php">Home</a><br>
          <a class="d-inline-block mb-2 text-dark text-decoration-none" href="rooms.php">Rooms</a><br>
          <a class="d-inline-block mb-2 text-dark text-decoration-none" href="facilities.php">Facilities</a><br>
          <a class="d-inline-block mb-2 text-dark text-decoration-none" href="contact.php">Contact Us</a><br>
          <a class="d-inline-block mb-2 text-dark text-decoration-none" href="about.php">About</a>
    </div>
    <div class="col-lg-4 p-4">
        <h5 class="mb-3">Follow Us</h5>
        <?php 
          if($contact_r['tw']!=''){
            echo<<<data
              <a href="$contact_r[tw]" class="d-inline-block text-dark text-decoration-none mb-2">
                <i class="bi bi-twitter me-1"></i>Twitter
              </a><br>
            data;
          }
        ?>
        <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block text-dark text-decoration-none mb-2">
          <i class="bi bi-instagram me-1"> Instagram</i>
        </a><br>
        <a href="<?php echo $contact_r['fb']?>" class="d-inline-block text-dark text-decoration-none">
          <i class="bi bi-facebook me-1"> Facebook</i>
        </a><br>
      </div>
   </div>
</div>

<h6 class="text-center bg-dark text-white p-3 m-0">Designed and Developed by @code_2_with_pratik</h6>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
crossorigin="anonymous"></script>

<script>

  function setActive()
  {
    let navbar = document.getElementById('nav-bar');
    let a_tags = navbar.getElementsByTagName('a');

    for(i=0; i<a_tags.length; i++){
      let file = a_tags[i].href.split('/').pop();
      let file_name = file.split('.')[0];

      if(document.location.href.indexOf(file_name) >= 0){
        a_tags[i].classList.add('active');
      }


    }
  }

  
  let register_form =document.getElementById('register-form');

  register_form.addEventListener('submit', (e)=>{
    e.preventDefault();

    let data = new FormData();

    data.append('name',register_form.elements['name'].value);
    data.append('email',register_form.elements['email'].value);
    data.append('phonenum',register_form.elements['phonenum'].value);
    data.append('address',register_form.elements['address'].value);
    data.append('pincode',register_form.elements['pincode'].value);
    data.append('dob',register_form.elements['dob'].value);
    data.append('pass',register_form.elements['pass'].value);
    data.append('cpass',register_form.elements['cpass'].value);
    data.append('profile',register_form.elements['profile'].files[0]);
    data.append('register','');

    var myModal = document.getElementById('registerModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/login_register.php",true);

    xhr.onload = function(){

    };

    xhr.send(data);
    
  });

  setActive();

</script>