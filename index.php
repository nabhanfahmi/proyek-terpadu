<?php

include 'functions.php';
/*if(empty($_SESSION['user']))
    header("location:login.php");*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Sistem Informasi Geografis</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <link href="img/favicon.ico" rel="icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/assets_home/lib/animate/animate.min.css" rel="stylesheet">
  <link href="assets/assets_home/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/assets_home/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
  <link href="assets/assets_home/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/assets_home/css/style.css" rel="stylesheet">
  <script src="assets/js/jquery.min.js"></script>
  <script src="https://cdn.tiny.cloud/1/a5skmjfed85xz5tqxmr38kdb48xmym2cso750uhxj5s0k9j7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


  <script>
        tinymce.init({
        selector: "textarea.mce",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            menubar : false,
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
    </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArF0QiK8CUtO3LCvBUoN1cMiHhsTbfIEg&callback=initMap">
    type = "text/javascript"
  </script>
  <script>
    var default_lat = <?= get_option('default_lat') ?>;
    var default_lng = <?= get_option('default_lng') ?>;
    var default_zoom = <?= get_option('default_zoom') ?>;
  </script>
  <script src="assets/js/script.js"></script>

</head>

<body>
  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 wow fadeIn" data-wow-delay="0.1s">
    <a href="?" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
      <h2 class="m-0 text-primary">SIG Wisata Batang</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav ms-auto p-4 p-lg-0">
        <a href="?" class="nav-item nav-link">Home</a>
        <?php if ($_SESSION['login']) : ?>
          <a href="?m=tempat" class="nav-item nav-link">Daftar Wisata</a>
          <a href="?m=galeri" class="nav-item nav-link">Galeri</a>
          <a href="aksi.php?act=logout" class="nav-item nav-link">Logout</a>
        <?php else : ?>
          <a href="?m=tempat_list" class="nav-item nav-link">Daftar Wisata</a>
          <a href="?m=login" class="nav-item nav-link">Login</a>
        <?php endif ?>
      </div>
    </div>
  </nav>
  <!-- Navbar End -->
  <?php
  if (file_exists($mod . '.php'))
    include $mod . '.php';
  else
    include 'home.php';
  ?>


  <!-- Back to Top -->
  <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/assets_home/lib/wow/wow.min.js"></script>
  <script src="assets/assets_home/lib/easing/easing.min.js"></script>
  <script src="assets/assets_home/lib/waypoints/waypoints.min.js"></script>
  <script src="assets/assets_home/lib/counterup/counterup.min.js"></script>
  <script src="assets/assets_home/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="assets/assets_home/lib/tempusdominus/js/moment.min.js"></script>
  <script src="assets/assets_home/lib/tempusdominus/js/moment-timezone.min.js"></script>
  <script src="assets/assets_home/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

  <!-- Template Javascript -->
  <script src="assets/assets_home/js/main.js"></script>
</body>

</html>