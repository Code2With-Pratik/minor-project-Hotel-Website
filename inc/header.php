             <!-- nav bar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary bg-white pg-lg-3 py-lg-2 shadow-sm sticky-top"></nav> 
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
     
           <!-- login form -->

<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form>
      <div class="modal-header">
        <h1 class="modal-title fs-4 d-flex"><i class="bi bi-person-circle fs-3 me-2"></i>User Login</h1>
        <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control shadow-none">
        </div>
        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" class="form-control shadow-none">
        </div>
        <div class="d-flex align-item-center justify-content-between">
          <button type="submit" class="btn btn-dark shadow-none">LOGIN</button>
          <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot Password?</a>
        </div>
      </div>
     
      </form>
    </div>
  </div>
</div>
   
          <!-- Registration Form -->

<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form>
      <div class="modal-header">
        <h1 class="modal-title fs-4 d-flex"><i class="bi bi-person-plus-fill fs-3 me-2"></i>User Regestration</h1>
        <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <span class="badge rounded-pill text-bg-light mb-3 text-wrap lh-base">
        Note: Your details must metch with your ID (Aadhar Card , Passport , Driving Licence etc...)
        that will be require during check-in.
      </span>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 ">
          <label class="form-label">Name</label>
          <input type="text" class="form-control shadow-none">
          </div>
          <div class="col-md-6 ">
          <label class="form-label">Email</label>
          <input type="email" class="form-control shadow-none">
          </div>
          <div class="col-md-6 ">
          <label class="form-label">Phone Number</label>
          <input type="number" class="form-control shadow-none">
          </div>
          <div class="col-md-6  mb-3">
          <label class="form-label">Picture</label>
          <input type="file" class="form-control shadow-none">
          </div>
          <div class="col-md-12 mb-3">
          <label class="form-label">Address</label>
          <textarea class="form-control shadow-none" rows="1"></textarea>
          </div>
          <div class="col-md-6 ">
          <label class="form-label">Pincode</label>
          <input type="number" class="form-control shadow-none">
          </div>
          <div class="col-md-6  mb-3">
          <label class="form-label">Date of Birth</label>
          <input type="date" class="form-control shadow-none">
          </div>
          <div class="col-md-6 ">
          <label class="form-label">Password</label>
          <input type="password" class="form-control shadow-none">
          </div>
          <div class="col-md-6 mb-3">
          <label class="form-label">Confirm Password</label>
          <input type="password" class="form-control shadow-none">
          </div>
        </div>
      </div>
      <div class="text-center my-1">
      <button type="submit" class="btn btn-dark shadow-none">REGISTER</button>
      </div>
    </div>
     
      </form>
    </div>
  </div>
</div>
