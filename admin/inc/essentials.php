<?php

    // frontend purpose data

    define('SITE_URL','http://127.0.0.1/hotelwebsite/');
    define('ABOUT_IMG_PATH',SITE_URL.'images/about/');
    define('CAROUSEL_IMG_PATH',SITE_URL.'images/carousel/');
    define('FACILITIES_IMG_PATH',SITE_URL.'images/facilities/');
    define('ROOMS_IMG_PATH',SITE_URL.'images/rooms/');

    // Backend upload process needs this data 

define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/minor project/images/');
define('ABOUT_FOLDER','about/');
define('CAROUSEL_FOLDER','carousel/');
define('FACILITIES_FOLDER','facilities/');
define('ROOMS_FOLDER','rooms/');
define('USERS_FOLDER','users/');

function adminLogin()
{
    session_start();
    if(!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true)){
        echo"<script>
           window.location.href='index.php';
        </script>";
        exit;
    }
//   session_regenerate_id(true);
}

function redirect($url){
    echo"<script>
       window.location.href='$url';
     </script>";
     exit;
}
function alert($type,$msg){

    $bs_class = ($type == "success") ? "alert-success" : "alert-danger";

    echo <<<alert
        <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
            <strong class="me-3" >$msg</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
     alert;
}

function uploadImage($image,$folder)
{
  $valid_mime = ['image/jpeg','image/png','image/webp'];
  $img_mime = $image['type'];

  if(!in_array($img_mime,$valid_mime)){
    return 'inv_img';  // invalid image or format
  }
  else if(($image['size']/(1024*1024))>2){  // convert images size from bites to Megabytes
    return 'inv_size';  // invalid size greater than 2 mb
  }
  else{
    $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
    $rname = 'IMG_'.random_int(11111,99999).".$ext";

    $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
    if(move_uploaded_file($image['tmp_name'],$img_path)){
        return $rname;
    }
    else{
        return 'upd_failed';
    }
  }
}

function deleteImage($image, $folder)
{
  if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
    return true;
  }
  else{
    return false;
  }
}

function uploadSVGImage($image,$folder)
{
  $valid_mime = ['image/svg+xml'];
  $img_mime = $image('type');

  if(!in_array($img_mime,$valid_mime)){
    return 'inv_img';  // invalid image or format
  }
  else if(($image['size']/(1024*1024))>1){  // convert images size from bites to Megabytes
    return 'inv_size';  // invalid size greater than 1 mb
  }
  else{
    $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
    $rname = 'IMG_'.random_int(11111,99999).".$ext";

    $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
    if(move_uploaded_file($image['tmp_name'],$img_path)){
        return $rname;
    }
    else{
        return 'upd_failed';
    }
  }
}

function uploadUserImage($image)
{
  $valid_mime = ['image/jpeg','image/png','image/webp'];
  $img_mime = $image['type'];

  if(!in_array($img_mime,$valid_mime)){
    return 'inv_img';  // invalid image or format
  }
  else{
    $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
    $rname = 'IMG_'.random_int(11111,99999).".jpeg";

    $img_path = UPLOAD_IMAGE_PATH.USERS_FOLDER.$rname;

    if($ext == 'png' || $ext == 'PNG'){
      $img = imagecreatefrompng($image['tmp_name']);
    }
    else if($ext == 'webp' || $ext == 'WEBP') {
      $img = imagecreatefromwebp($image['tmp_name']);
    }
    else{
      $img = imagecreatefromjpeg($image['tmp_name']);
    }
    
    if(imagejpeg($img,$img_path,75)){
        return $rname;
    }
    else{
        return 'upd_failed';
    }
  }
}

?>