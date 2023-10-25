<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Siap</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url(); ?>/assets/img/favicon.png" rel="icon">
  <!-- <link href="<?= base_url(); ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url(); ?>/assets/landingpage/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/assets/landingpage/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/assets/landingpage/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/assets/landingpage/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/assets/landingpage/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url(); ?>/assets/landingpage/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Append
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/append-bootstrap-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page" data-bs-spy="scroll" data-bs-target="#navmenu">

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="<?= base_url(); ?>/assets/landingpage/img/logo.png" alt=""> -->
        <!-- <h1>Append</h1>
        <span>.</span> -->
      </a>

      <!-- Nav Menu -->
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#profil">Profil</a></li>
          <li><a data-bs-toggle="modal" href="#pendidikanModal">Pendidikan</a></li>
          <li><a href="#prestasi">Prestasi</a></li>
          <li><a href="#visimisi">Visi & Misi</a></li>
          <li><a href="#program">Program</a></li>
        </ul>

        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav><!-- End Nav Menu -->

      <a class="btn-getstarted" href="<?php echo base_url('auth'); ?>">Masuk</a>

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- Hero Section - Home Page -->
    <section id="hero" class="hero">

      <!-- <img src="<?= base_url(); ?>/assets/landingpage/img/hero-bg.jpg" alt="" data-aos="fade-in"> -->
      <img src="<?php echo base_url(); ?>assets/img/<?php echo $profile["Banner"][0]; ?>" alt="" data-aos="fade-in">

    </section>
    <!-- End Hero Section -->

    <!-- Call-to-action Section - Home Page -->
    <section id="profil" class="call-to-action">
      <img src="<?php echo base_url(); ?>assets/img/<?php echo $profile["Banner"][0]; ?>" alt="">
      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-10">
            <div class="text-center">
              <!-- <h3>Call To Action</h3> -->
              <!-- <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->
              <!-- <a class="cta-btn" href="#">Lihat Visi & Misi</a> -->
              <div class="container my-5" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-xl-center gy-5">
                  <div class="col-12 content text-center card shadow p-4">
                    <!-- <h3>Profil</h3> -->
                    <div class="container section-title pb-0" data-aos="fade-up">
                      <h2>Profil</h2>
                    </div>

                    <hr/>
                    <p><?php echo $profile["Profile"][0]; ?></p>
                    <hr/>
                    <div>
                      <a data-bs-toggle="modal" href="#pendidikanModal" class="btn btn-success"><span>Pendidikan </span> <i class="bi bi-mortarboard-fill"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Call-to-action Section -->


    <!-- About Section - Home Page -->
    <!-- <section id="about" class="about">
      <div class="container my-5" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-xl-center gy-5">

          <div class="col-12 content text-center card shadow p-4">
            <h3>Profil</h3>
            <hr/>
            <p><?php echo $profile["Profile"][0]; ?></p>
            <hr/>
            <div>
              <a data-bs-toggle="modal" href="#pendidikanModal" class="read-more"><span>Pendidikan</span><i class="bi bi-mortarboard-fill"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section> -->

    <section id="prestasi" class="prestasi">
      <!--  Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Prestasi</h2>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-xl-center gy-5">

          <div class="col-12">
            <div class="row gy-4 icon-boxes">

              <?php
                foreach ($profile['Prestasi'] as $key => $value) {
                  ?>
                      <div class="col-12" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon-box card shadow p-4">
                          <p class="mb-0"><?php echo $value; ?></p>
                        </div>
                      </div> 
                  <?php
                }
              ?>
            </div>
          </div>

        </div>
      </div>

    </section>
    <!-- End About Section -->

    <!-- Services Section - Home Page -->
    <section id="visimisi" class="services">

      <!--  Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Visi & Misi</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="100">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-bullseye"></i></div>
              <div>
                <h4 class="title">Visi</h4>
                <p class="description"><?php echo $profile["Visi"][0]; ?> </p>
              </div>
            </div>
          </div>
          <!-- End Service Item -->

          <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="200">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-card-checklist"></i></div>
              <div>
                <h4 class="title">Misi</h4>
                <p class="description"><?php echo $profile["Misi"][0]; ?> </p>
              </div>
            </div>
          </div><!-- End Service Item -->
          <hr/>
        </div>

      </div>

    </section>

    <!-- Faq Section - Home Page -->
    <section id="program" class="faq">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="content px-xl-5">
              <h3><strong>Rencana Program Kerja</strong></h3>
            </div>
          </div>

          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">

            <div class="faq-container">
              <?php
                foreach ($profile['Program'] as $key => $value) {
                  ?>
                    <div class="faq-item">
                      <h3><span class="num"><?=$key+1?>.</span> <span><?php echo $value; ?></span></h3>
                    </div>
                  <?php
                }
              ?>
            </div>
          </div>
        </div>

      </div>

    </section><!-- End Faq Section -->

  </main>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer pb-0">

    <div class="container-fluid copyright text-center">
      <p>&copy; <span>Copyright</span> 
      <span>All Rights Reserved</span></p>
    </div>

  </footer><!-- End Footer -->

  <!-- Scroll Top Button -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>

  
  <!-- Modals-->
  <!-- Visi modal popup-->
  <div class="portfolio-modal modal fade" id="pendidikanModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <!-- <div class="close-modal" data-bs-dismiss="modal">
                <i class="bi bi-x-circle-fill"></i>
              </div> -->
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-lg-8">
                          <div class="modal-body">
                              <!-- Project details-->
                              <h2 class="text-uppercase">Pendidikan</h2>
                              <p><?php echo $profile["Pendidikan"][0]; ?></p>
                              <div style="text-align: right;">
                                <a class="btn btn-success" data-bs-dismiss="modal" type="button">
                                    Tutup 
                                </a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Visi modal popup-->
  <div class="portfolio-modal modal fade" id="misiModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <!-- <div class="close-modal" data-bs-dismiss="modal">
                <i class="bi bi-x-circle-fill"></i>
              </div> -->
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-lg-8">
                          <div class="modal-body">
                              <!-- Project details-->
                              <h2 class="text-uppercase">Misi</h2>
                              <p><?php echo $profile["Misi"][0]; ?></p>
                              <div style="text-align: right;">
                                <a class="btn btn-dark" data-bs-dismiss="modal" type="button">
                                    Tutup 
                                </a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Vendor JS Files -->
  <script src="<?= base_url(); ?>/assets/landingpage/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url(); ?>/assets/landingpage/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= base_url(); ?>/assets/landingpage/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="<?= base_url(); ?>/assets/landingpage/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?= base_url(); ?>/assets/landingpage/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?= base_url(); ?>/assets/landingpage/vendor/aos/aos.js"></script>
  <script src="<?= base_url(); ?>/assets/landingpage/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url(); ?>/assets/landingpage/js/main.js"></script>

</body>

</html>