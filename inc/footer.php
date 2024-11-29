<div class="container-fluid bg-white mt-5">
   <div class="row">
    <div class="col-lg-4 p-4">
        <h3 class="h-font fw-bold fs-3 mb-2">GrandStay</h3>
        <p>Experience Grandeur, Every Day Where Luxury Meets Comfort</br>
        Experience Grandeur, Every Day .Affordable Comfort, Anytime and Smart Stays for Savvy Travelers
       . Simplify Your Stay </p>
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

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>


      function alert(type,msg){
        let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');
        element.innerHTML = `
            <div class="alert ${bs_class} alert-dismissible fade show custom-alert" role="alert">
                <strong class="me-3" >${msg}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        document.body.append(element);
        setTimeout(remAlert, 2000);
     }

      function remAlert(){
          document.getElementsByClassName('alert')[0].remove();
      }


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

      
     // Register form submit event (AJAX)
  let register_form = document.getElementById('register-form');
  register_form.addEventListener('submit', function (e) {
    e.preventDefault();

    let data = new FormData(register_form);
    data.append('register', '');

    let myModal = document.getElementById('registerModal');
    let modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "login_register.php", true);

    xhr.onload = function () {
      if (this.responseText === 'pass_mismatch') {
        alert('error', 'Password Mismatch!');
      } else if (this.responseText === 'email_already') {
        alert('error', 'Email is already registered!');
      } else if (this.responseText === 'phone_already') {
        alert('error', 'Phone number is already registered!');
      } else if (this.responseText === 'ins_failed') {
        alert('error', 'Registration failed! Server down!');
      } else if (this.responseText === '1') {
        alert('success', 'Registration successful!');
        register_form.reset();
      }
    };
    xhr.send(data);
  });

  // Login form submit event (AJAX)
  let login_form = document.getElementById('login-form');
  login_form.addEventListener('submit', function (e) {
    e.preventDefault();

    let data = new FormData(login_form);
    data.append('login', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "login_register.php", true);

    xhr.onload = function () {
      if (this.responseText === 'no_user') {
        alert('error', 'No user found with this email!');
      } else if (this.responseText === 'invalid_pass') {
        alert('error', 'Invalid password!');
      } else if (this.responseText === '1') {
        alert('success', 'Login successful!');
        window.location.reload();
      } 
    };

    xhr.send(data);
  });


  function checkLoginToBook(status,room_id){
    if(status){
      window.location.href='confirm_booing.php?id='+room_id;
    }
    else{
      alert('error','Please login to Book Room!');
    }
  }

  setActive();
</script>
