<?php 
  require('admin/inc/db_config.php');
  require('admin/inc/essentials.php');

  $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
  $values = [1];
  $contact_r = mysqli_fetch_assoc(select($contact_q,$values, 'i'));

?>