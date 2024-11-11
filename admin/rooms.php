<?php
  require('inc/essentials.php');
  require('inc/db_config.php');
  adminLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Rooms</title>
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

<?php require('inc/header.php'); ?>

               <!-- features  section -->

<div class="container-fluid" id="main-content" >
   <div class="row">
      <div class="col-lg-10 ms-auto p-4 over-hidden">
            <h3 class="mb-4">ROOMS</h3>

            <div class="card border-0 shadow-sm mb-4">
              <div class="card-body">
                
                  <div class="text-end mb-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-room">
                    <i class="bi bi-plus-square"></i>Add
                    </button>
                  </div>

              
                  <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                      <table class="table table-hover border">
                        <thead>
                          <tr>
                            <th class="bg-dark text-light" scope="col">#</th>
                            <th class="bg-dark text-light" scope="col">Name</th>
                            <th class="bg-dark text-light" scope="col">Area</th>
                            <th class="bg-dark text-light" scope="col">Guests</th>
                            <th class="bg-dark text-light" scope="col">Price</th>
                            <th class="bg-dark text-light" scope="col">Quantity</th>
                            <th class="bg-dark text-light" scope="col">Status</th>
                            <th class="bg-dark text-light" scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody id="room-data">
                          
                          </tbody>
                        </table>
                      </div>
                      
              </div>
            </div>

      </div>
    </div>
</div>
 



<?php require('inc/scripts.php'); ?> 
<script>
  let add_room_form =document.getElementById('add_room_form');

  add_room_form.addEventListener('submit',function(e){
    e.preventDefault();
    add_room();
  });

  function add_room()
  {
    let data = new FormData();
    data.append('add_room','');
    data.append('name',add_room_form.elements['name'].value);
    data.append('area',add_room_form.elements['area'].value);
    data.append('price',add_room_form.elements['price'].value);
    data.append('quantity',add_room_form.elements['quantity'].value);
    data.append('adult',add_room_form.elements['adult'].value);
    data.append('children',add_room_form.elements['children'].value);
    data.append('desc',add_room_form.elements['desc'].value);


    let features = [];
    add_room_form.elements['features'].forEach(el => {
      if(el.checked){
        features.push(el.value);
      }
    });
    
    let facilities = [];
    add_room_form.elements['facilities'].forEach(el => {
      if(el.checked){
        facilities.push(el.value);
      }
    });

    data.append('features',JSON.stringify(features));
    data.append('facilities',JSON.stringify(facilities));

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);

    xhr.onload = function(){
      var myModal = document.getElementById('add-room');
      var modal = bootstrap.Modal.getInstance(myModal);
      modal.hide();

      if(this.responseText == 1){
      alert('success','New room added!');
      add_room_form.reset();

      }
      else{
      alert('error','Server Down!');
      }
    }

    xhr.send(data);
  }

  function get_all_rooms()
  {
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);

    xhr.onload = function(){
     document.getElementById('room-data').innerHTML = this.responseText;
     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    };

    xhr.send('get_all_rooms');
  }

  window.onload = function(){
    get_all_rooms();
  }


</script>

</body>
</html>