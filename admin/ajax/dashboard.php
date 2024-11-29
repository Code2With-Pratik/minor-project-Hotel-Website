<?php
  require('inc/essentials.php');
  require('inc/db_config.php');
  adminLogin();

  // Check for form submission
  if(isset($_POST['user_analytics'])) {
      $frm_data = filteration($_POST); // Ensure input is sanitized

      $condition = "";

      // Determine the condition based on selected period
      if($frm_data['period'] == 1){
          $condition = "WHERE datentime BETWEEN NOW() - INTERVAL 30 DAY AND NOW()";
      } else if($frm_data['period'] == 2){
          $condition = "WHERE datentime BETWEEN NOW() - INTERVAL 90 DAY AND NOW()";
      } else if($frm_data['period'] == 3){
          $condition = "WHERE datentime BETWEEN NOW() - INTERVAL 1 YEAR AND NOW()";
      }

      // Run queries with error handling
      $total_queries_query = mysqli_query($con, "SELECT COUNT(sr_no) AS `count` FROM `user_queries` $condition");
      if (!$total_queries_query) {
          echo json_encode(['error' => 'Failed to fetch total queries: ' . mysqli_error($con)]);
          exit;
      }
      $total_queries = mysqli_fetch_assoc($total_queries_query);

      $total_new_reg_query = mysqli_query($con, "SELECT COUNT(id) AS `count` FROM `registered_users` $condition");
      if (!$total_new_reg_query) {
          echo json_encode(['error' => 'Failed to fetch total new registrations: ' . mysqli_error($con)]);
          exit;
      }
      $total_new_reg = mysqli_fetch_assoc($total_new_reg_query);

      // Prepare output
      $output = [
          'total_queries' => $total_queries['count'],
          'total_new_reg' => $total_new_reg['count']
      ];

      // Encode and return output
      echo json_encode($output);
  }
?>
