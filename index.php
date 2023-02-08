<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>COESITAL</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/icon.ico" rel="shortcut icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: OnePage - v4.7.0
  * Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

      <!-- <h1 class="logo"><a href="index.php">Galfint</a></h1> -->
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="index.php" class="logo"><img src="assets/img/coesital.png" alt="" class="img-fluid"> COESITAL</a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
          <li><a class="nav-link scrollto" href="#about">Tentang</a></li>
          <li><a class="getstarted scrollto" href="dijkstra/index.php">Peta</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-9 text-center">
          <h3>ALGORITMA DJIKSTRA DALAM MENENTUKAN RUTE TERDEKAT LOKASI RUMAH SAKIT PENERIMA PASIEN COVID-19 BERBASIS WEBSITE</h3>
        </div>
      </div>
      <div class="text-center">
        <a href="dijkstra/index.php" class="btn-get-started scrollto">Peta</a>
      </div>

      <div class="row icon-boxes">
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-1 mb-lg-0 mt-1" data-aos="zoom-in" data-aos-delay="200">
          <div class="icon-box">
            <div class="icon"><i class="bx bxs-virus"></i></div>
            <h4 class="title"><a style= "pointer-events: none; cursor: default" href="">Covid-19</a></h4>
            <p class="description">Menurut WHO pada Maret 2020, secara resmi virus Covid-19 dikategorikan ke dalam pandemi karena kasus Covid-19 dapat ditemui secara global dan dalam waktu yang bersamaan. Hal ini dapat terjadi karena virus Covid-19 dapat ditularkan secara cepat melalui berbagai cara.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-1 mb-lg-0 mt-1" data-aos="zoom-in" data-aos-delay="300">
          <div class="icon-box">
            <div class="icon"><i class="bx bx-buildings"></i></div>
            <h4 class="title"><a style= "pointer-events: none; cursor: default" href="">Kota Kupang</a></h4>
            <p class="description">Kota Kupang memiliki jumlah penduduk 442.758 per 2020 dengan total 6 kecamatan menurut Badan Pusat Statistik Kota Kupang. Pada gelombang pertama Covid-19, di Kota Kupang tercatat sebanyak 1.475 total kasus dan naik menjadi 11.135 total kasus pada gelombang kedua.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-1 mb-lg-0 mt-1" data-aos="zoom-in" data-aos-delay="400">
          <div class="icon-box">
            <div class="icon"><i class="bx bx-plus-medical"></i></div>
            <h4 class="title"><a style= "pointer-events: none; cursor: default" href="">Rumah Sakit</a></h4>
            <p class="description">Di Kota Kupang terdapat 14 rumah sakit rujukan Covid-19 dengan total 1 RS untuk Kecamatan Alak, 2 RS untuk Kecamatan Maulafa, 7 RS untuk Kecamatan Oebobo, 2 RS untuk Kecamatan Kota Raja, 2 RS untuk Kecamatan Kota Lama, dan tidak ada RS untuk Kecamatan Kelapa Lima.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-1 mb-lg-0 mt-1" data-aos="zoom-in" data-aos-delay="500">
          <div class="icon-box">
            <div class="icon"><i class="bx bx-map-pin"></i></div>
            <h4 class="title"><a style= "pointer-events: none; cursor: default" href="">Coesital</a></h4>
            <p class="description">Coesital adalah sebuah sistem berbasis website yang dapat menentukan rute terpendek dari tiap kecamatan menuju rumah sakit penerima pasien Covid-19 yang berada di Kota Kupang dengan menggunakan algoritma Dijkstra.</p>
          </div>
        </div>

      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->

    <section id="about" class="d-flex align-items-center">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Dinas Kesehatan Kota Kupang</h2>
          <p>Dinas Kesehatan Kota Kupang bertugas membantu walikota dalam menyelenggarakan pembangunan kesehatan di Kota Kupang dengan melaksanakan kewenangan otonomi daerah di bidang Kesehatan.</p>
        </div>

        <div>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15709.22991034642!2d123.63144895161476!3d-10.155642677610253!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c56834a7d971191%3A0x9fab0664e2d94f29!2sDinas%20Kesehatan%20Kota%20Kupang!5e0!3m2!1sid!2sid!4v1648364337830!5m2!1sid!2sid" width="100%" height="270" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="container">

      <div class="row text-center mt-4">

        <div class="col-lg">
            <h5> <i class="bi bi-geo-alt"></i></h5>
            <h4>Alamat</h4>
            <p>Jl. SK Lerik, Kelapa Lima. 85228</p>
        </div>
        <div class="col-lg">
            <h5> <i class="bi bi-printer"></i> </h5>
            <h4>Faks</h4>
            <p>(0380) 825769</p>
        </div>
        <div class="col-lg">
            <h5> <i class="bi bi-telephone"></i> </h5>
            <h4>Telepon</h4>
            <p>(0380) 825769</p>
        </div>
      </div>
    </div>

      </div>
    </section><!-- End Contact Section -->
    <!-- End About Section -->



  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">



    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Dinas Kesehatan Kota Kupang</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          Made by <a href="https://www.instagram.com/galfint_jimmy/">Galfint Reeves Jimmy</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">

        <a href="https://dinkes-kotakupang.web.id/" class="Web"><i class="bx bx-globe"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
