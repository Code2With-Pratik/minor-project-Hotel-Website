<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hotel - CONFIRM BOOKING</title>
    <?php require('inc/links.php'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  </head>
  <body class="bg-light">

  <?php require('inc/header.php'); ?>

  <?php
   if(!isset($_GET['id'])){
    redirect('rooms.php');
   }
   else if(!(isset($_SESSION['login']) && $_SESSION['login'] === true)){
    redirect('rooms.php');
   }

   $data = filteration($_GET);

   $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `remove`=?",[$data['id'],1,0],'iii');

   if(mysqli_num_rows($room_res)==0){
    redirect('rooms.php');
   }

   $room_data = mysqli_fetch_assoc($room_res);

   $_SESSION['room'] = [
    "id"=> $room_data['id'],
    "name"=> $room_data['name'],
    "price"=> $room_data['price'],
    "payment"=> null,
    "available"=> null,
   ];

  ?>
      
      <div class="container">
        <div class="row">

            <div class="col-12 my-5 mb-4 px-4">
              <h2 class="fw-bold">CONFIRM BOOKING</h2>
              <div style="font-size: 14px;">
                <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                <span class="text-dark"> > </span>
                <a href="rooms.php" class="text-secondary text-decoration-none">ROOMS</a>
                <span class="text-dark"> > </span>
                <a href="#" class="text-secondary text-decoration-none">CONFIRM</a>
              </div>
            </div>

            <div class="col-lg-7 col-md-12 px-4 card p-3 shadow-sm rounded">
              <div id="roomCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                <div class="carousel-inner rounded">
                  <?php 
                    // Get thumbnail of the image
                    $room_img = ROOMS_IMG_PATH . "thumbnail.jpg"; // Default thumbnail
                    $thumb_q = mysqli_query($con, "SELECT `image` FROM `room_image` 
                                                  WHERE `room_id` = '$room_data[id]' AND `thumb` = '1'");

                    if ($thumb_q && mysqli_num_rows($thumb_q) > 0) {
                        $thumb_res = mysqli_fetch_assoc($thumb_q);
                        if (!empty($thumb_res['image'])) {
                            $room_thumb = ROOMS_IMG_PATH . $thumb_res['image']; // Update with the actual thumbnail
                        }
                    }
                  ?>
                  <!-- Use the fetched thumbnail image or the default one -->
                  <div class="carousel-item active">
                    <img src="<?php echo isset($room_thumb) ? $room_thumb : 'images/rooms/6.png'; ?>" class="d-block w-100" >
                  </div>
                  <div class="carousel-item">
                    <img src="images/rooms/1.jpg" class="d-block w-100" >
                  </div>
                  <div class="carousel-item">
                    <img src="images/rooms/2.png" class="d-block w-100">
                  </div>
                  <div class="carousel-item">
                    <img src="images/rooms/3.png" class="d-block w-100" >
                  </div>
                  <div class="carousel-item">
                    <img src="images/rooms/4.png" class="d-block w-100" >
                  </div>
                  <div class="carousel-item">
                    <img src="images/rooms/5.png" class="d-block w-100" >
                  </div>
                  <div class="carousel-item">
                    <img src="images/rooms/7.png" class="d-block w-100" >
                  </div>
                  <div class="carousel-item">
                    <img src="images/rooms/8.png" class="d-block w-100" >
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
                <?php 
                  echo<<<data
                    <h5>$room_data[name]</h5>
                    <h6>₹$room_data[price]/- per night</h6>
                  data;
                ?>
           </div>
          
             <div class="col-lg-5 col-mb-12 px-4">
               <div class="card mb-4 border-0 shadow-sm rounded-3">
                <div class="card-body">
                  <form id="booking_form">
                    <h6 class="mb-3">BOOKING DETAILS</h6>
                    <div class="row">
                      <div class="col-md-12 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="billing_name" id="billing_name" class="form-control shadow-none"  placeholder="Enter name" autofocus="" required>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="billing_email" id="billing_email" class="form-control shadow-none" placeholder="Enter Email" required autofocus="">
                      </div>
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="number" name="billing_mobile" id="billing_mobile" class="form-control shadow-none" placeholder="Enter Phone No." required autofocus="">
                      </div>
                      <br>
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Check-In</label>
                        <input type="Date" onchange="check_availability()" name="checkin" class="form-control shadow-none" required>
                      </div>
                      <div class="col-md-6 mb-4">
                        <label class="form-label">Check-Out</label>
                        <input type="Date" onchange="check_availability()" name="checkout" class="form-control shadow-none" required>
                      </div>
                      <div class="col-12">
                        <div class="spinner-border text-info mb-3 d-none" id="info_loader" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>

                        <h6 class="mb-3 text-danger" id="pay_info">Provide Check-In and Check-Out date!</h6>

                        <div class="col-md-6 mb-3">
                          <label class="form-label">Total Amount</label>
                          <input type="text" class="form-control shadow-none" name="payAmount" id="payAmount" placeholder="Enter Amount" required autofocus="">
                        </div>

                        <button id="PayNow" name="pay_now" class="btn w-100 text-white custom-bg shadow-sm mb-1" disabled >Pay Now</button>
                      </div>
                    </div>
                  </form>
                </div>
               </div>
             </div>
            
        </div>
     </div>
</div>

 <?php require('inc/footer.php');?>

 <script>
// Reference to form and elements
let booking_form = document.getElementById('booking_form');
let info_loader = document.getElementById('info_loader');
let pay_info = document.getElementById('pay_info');
let pay_now_button = booking_form.querySelector('button[name="pay_now"]');
let room_price_per_night = <?php echo $room_data['price']; ?>; // Room price fetched from the database

function check_availability() {
    // Get values from check-in and check-out fields
    let checkin_val = booking_form.elements['checkin'].value;
    let checkout_val = booking_form.elements['checkout'].value;

    if (checkin_val && checkout_val) {
        // Show loader and reset messages
        info_loader.classList.remove('d-none'); // Show loader
        pay_info.textContent = ''; // Clear message
        pay_info.style.color = ''; // Reset text color
        pay_now_button.disabled = true; // Disable Pay Now button

        setTimeout(() => {
            // Hide loader after 2 seconds
            info_loader.classList.add('d-none');

            // Parse dates and calculate the difference in days
            let checkin_date = new Date(checkin_val);
            let checkout_date = new Date(checkout_val);
            let time_difference = checkout_date - checkin_date;
            let days = time_difference / (1000 * 3600 * 24); // Convert milliseconds to days

            if (days > 0) {
                // Calculate total price for the stay
                let total_price = room_price_per_night * days;

                // Update the value of the Total Amount input field
                let payAmountInput = document.getElementById('payAmount');
                payAmountInput.value = total_price; // Set calculated amount

                // Display the total price in the availability message
                pay_info.textContent = `Room is available! Total price for ${days} night(s): ₹${total_price}`;
                pay_info.style.cssText = 'color: green !important;'; // Set text color to green
                pay_now_button.disabled = false; // Enable Pay Now button
            } else {
                // If date range is invalid
                pay_info.textContent = "Please select a valid date range.";
                pay_info.style.color = 'red'; // Set text color to red

                // Clear the Total Amount input field
                let payAmountInput = document.getElementById('payAmount');
                payAmountInput.value = ''; // Clear value
            }
        }, 2000); // Loader delay (2 seconds)
    } else {
        // If dates are missing
        pay_info.textContent = "Provide Check-In and Check-Out date!";
        pay_info.style.color = 'red'; // Set text color to red

        // Clear the Total Amount input field
        let payAmountInput = document.getElementById('payAmount');
        payAmountInput.value = ''; // Clear value
    }
}

   //Pay Amount
   jQuery(document).ready(function($){

jQuery('#PayNow').click(function(e){

	var paymentOption='';
    let billing_name = $('#billing_name').val();
	let billing_mobile = $('#billing_mobile').val();
	let billing_email = $('#billing_email').val();
    var shipping_name = $('#billing_name').val();
	var shipping_mobile = $('#billing_mobile').val();
	var shipping_email = $('#billing_email').val();
    var paymentOption= "netbanking";
    var payAmount = $('#payAmount').val();
			
    var request_url="submitpayment.php";
		var formData = {
			billing_name:billing_name,
			billing_mobile:billing_mobile,
			billing_email:billing_email,
			shipping_name:shipping_name,
			shipping_mobile:shipping_mobile,
			shipping_email:shipping_email,
			paymentOption:paymentOption,
			payAmount:payAmount,
			action:'payOrder'
		}
		
		$.ajax({
			type: 'POST',
			url:request_url,
			data:formData,
			dataType: 'json',
			encode:true,
		}).done(function(data){
		
		if(data.res=='success'){
				var orderID=data.order_number;
				var orderNumber=data.order_number;
				var options = {
            "key": data.razorpay_key, // Enter the Key ID generated from the Dashboard
            "amount": data.userData.amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
            "currency": "INR",
            "name": "Pratik Dhandare", //your business name
            "description": data.userData.description,
            "image": "https://img.freepik.com/premium-vector/hotel-logo-design_423075-16.jpg?w=740",
            "order_id": data.userData.rpay_order_id, //This is a sample Order ID. Pass 
            "handler": function (response){

            window.location.replace("payment-success.php?oid="+orderID+"&rp_payment_id="+response.razorpay_payment_id+"&rp_signature="+response.razorpay_signature);

            },
            "modal": {
            "ondismiss": function(){
                window.location.replace("payment-success.php?oid="+orderID);
            }
        },
            "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
                "name": data.userData.name, //your customer's name
                "email": data.userData.email,
                "contact": data.userData.mobile //Provide the customer's phone number for better conversion rates 
            },
            "notes": {
                "address": "HotelBookingWebsite"
            },
            "config": {
            "display": {
            "blocks": {
                "banks": {
                "name": 'Pay using '+paymentOption,
                "instruments": [
                
                    {
                        "method": paymentOption
                    },
                    ],
                },
            },
            "sequence": ['block.banks'],
            "preferences": {
                "show_default_blocks": true,
            },
            },
        },
            "theme": {
                "color": "#3399cc"
            }
        };
    var rzp1 = new Razorpay(options);
    rzp1.on('payment.failed', function (response){

    window.location.replace("payment-failed.php?oid="+orderID+"&reason="+response.error.description+"&paymentid="+response.error.metadata.payment_id);

         });
      rzp1.open();
     e.preventDefault(); 
    }
 
  });
 });
});
</script>


</body>
</html>
