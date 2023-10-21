<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- | Sistem Informasi Aktif Pemilu -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/eksternal/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/eksternal/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">

  <style>
    /* Add background color and image for the body */
    body {
      background-color: #f0f0f0; /* Light gray background */
    }

    .konten {
      background-image: 
        url('<?php echo base_url(); ?>assets/img/<?php echo $profile["Background"][0]; ?>');
      background-size: cover; /* Cover the entire container */
      background-repeat: no-repeat;
      background-position: top center; /* Specific positions for each image */
      /*margin-top: 20px;*/ /* Add padding to the container */
    }
    /* Existing styles remain unchanged */


    /* Adjust the text color */
    .profile-name, .profile-description, .profile-bio p {
      color: #fff; /* Dark gray text */
    }


    .profile-name {
      font-size: 24px;
      margin-top: 10px;
      color: white;
    }


      /* Profile Name and Description */
      .profile-name,
      .profile-description {
        font-size: 18px;
        color: white;
      }

    @media (max-width: 768px) {
      /* Adjustments for mobile devices */
      
      /* Profile Container */
      .profile-container {
        /*padding: 10px;*/
      }

      /* Profile Picture */
      .profile-picture {
        width: 150px;
        height: 150px;
      }

      /* Image Gallery */
      .image-gallery img {
        max-width: 100%;
        height: auto;
        margin: 10px 0;
      }

      /* Vision and Mission */
      .vision-mission {
        padding: 10px;
      }

      .vision-mission h2 {
        font-size: 24px;
      }

      .vision-mission p {
        font-size: 16px;
      }

      /* Education */
      .education {
        padding: 10px;
      }

      .education h2 {
        font-size: 24px;
      }

      .education ul li {
        font-size: 16px;
      }

      /* Achievements */
      .achievements {
        padding: 10px;
      }

      .achievements h2 {
        font-size: 24px;
      }

      .achievements ul li {
        font-size: 16px;
      }

      /* Programs */
      .programs {
        padding: 10px;
      }

      .programs h2 {
        font-size: 24px;
      }

      .programs ul li {
        font-size: 16px;
      }


	    /* Adjust the text color */
	    .profile-name, .profile-description, .profile-bio p {
	      color: #fff; /* Dark gray text */
	    }


	    .profile-name {
	      font-size: 24px;
	      margin-top: 10px;
	      color: white;
	    }
	    

	      /* Profile Name and Description */
	      .profile-name,
	      .profile-description {
	        font-size: 18px;
	        color: white;
	      }


	    .profile-name, .profile-description, .profile-bio p {
	      color: #fff; /* Dark gray text */
	    }
    }

    /* Adjust the profile-container and other elements' styles accordingly */

    /* Adjust the colors for the profile container */
    .profile-container {
      /*padding: 20px;*/
      text-align: left;
      /*background-color: rgba(255, 255, 255, 0.8);*/ /* Semi-transparent white background */
    }
    /* Add styles for other sections accordingly */


    /* Gaya untuk Navbar */
  /*  .navbar {
      background-color: #333;
      overflow: hidden;
    }*/

    .navbar a {
      float: left;
      font-size: 16px;
      color: white;
      text-align: left;
      padding: 14px 16px;
      text-decoration: none;
    }

    .navbar span {
      float: left;
      font-size: 16px;
      color: white;
      text-align: left;
      padding: 14px 16px;
      text-decoration: none;
    }

    .navbar a:hover {
      background-color: #ddd;
      color: black;
    }

    /* Gaya untuk Profil */
    .profile-container {
      /*padding: 20px;*/
      text-align: left;
      /*background-color: #f8f8f8;*/
    }

    .profile-picture {
      /*border-radius: 50%;*/
      width: 200px;
      height: 200px;
      object-fit: cover;
      margin: 0 auto 50px;
      display: block;
    }
    .profile-description {
      font-size: 18px;
      margin-top: 10px;
    }
    /* Gaya untuk Gambar-gambar Online */
    .image-gallery {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    .image-gallery img {
      max-width: 250px;
      border: 2px solid #ddd;
      border-radius: 10px;
      margin-right: 20px;
      margin-left: 20px;
    }

    
    @media (max-width: 768px) {
      .image-gallery {
        overflow-x: auto;
        justify-content: flex-start;

      }

      .image-gallery img {
        max-width: 100%; /* Adjust the width as needed */
        height: auto; /* Maintain aspect ratio */
        display: block;
      }
    }

     @media (max-width: 768px) {
            /* Adjustments for mobile devices */

			/* .navbar.responsive{
                background-color: transparent;
            } */
            /* Navbar */
            .navbar {
			  position: relative;
			  overflow: hidden;
			}

			.navbar::before {
			  content: '';
			  position: absolute;
			  top: 0;
			  right: 0; /* Position on the right side */
			  width: 35%; /* Set the width to cover half of the navbar */
			  height: 100%;
			  z-index: -1;
			  background-color: #100296; /* Background color */
			}
            .navbar a {
                display: none;
            }

            .navbar .icon {
                float: right;
                display: block;
            }

            .navbar.responsive {
                position: relative;
            }

            .navbar.responsive .icon {
                position: absolute;
                top: 0;
                right: 0;
            }

            /*.navbar.responsive a {
                display: block;
                text-align: left;
            }*/
            .navbar.responsive {
              position: fixed;
              top: 0;
              left: 0;
              width: 100%;
              z-index: 999;
              padding: 10px;
              display: flex;
              justify-content: center; 
              flex-direction: column; 
            }

            .navbar.responsive a {
              display: block;
              color: white;
              text-align: right ;
              padding: 14px 16px;
              text-decoration: none;
              background-color: transparent;;
            }

            .navbar.responsive a:hover {
              background-color: transparent;
              color: white;
            }
        
        }

        /* Show hamburger icon only for mobile */
        @media (min-width: 769px) {
        	    /* Navbar styles */
		    .navbar {
			  background-color: #100296;
			  overflow: hidden;
			}

		    .navbar a:hover {
		      background-color: #100296; /* Darker blue on hover */
		    }

            .navbar .icon {
                display: none;
            }

            .navbar a {
                display: inline-block;
            }
        }
    /* Gaya untuk Visi dan Misi */
    .vision-mission {
      text-align: left;
      margin-top: 30px;
    }

    .vision-mission h2 {
      font-size: 28px;
    }

    .vision-mission p {
      font-size: 18px;
    }

    /* Gaya untuk Prestasi */
    .achievements {
      text-align: left;
      margin-top: 30px;
    }

    .achievements h2 {
      font-size: 28px;
    }

    .achievements ul {
      list-style-type: none;
      padding: 0;
    }

    .achievements li {
      font-size: 18px;
      margin-bottom: 10px;
    }

    /* Gaya untuk Kegiatan */
    .activities {
      text-align: left;
      margin-top: 30px;
    }

    .activities h2 {
      font-size: 28px;
    }

    .activities ul {
      list-style-type: none;
      padding: 0;
    }

    .activities li {
      font-size: 18px;
      margin-bottom: 10px;
    }

    /* Gaya untuk Program */
    .programs {
      text-align: left;
      margin-top: 30px;
    }

    .programs h2 {
      font-size: 28px;
    }

    .programs ul {
      list-style-type: none;
      padding: 0;
    }

    .programs li {
      font-size: 18px;
      margin-bottom: 10px;
    }

  </style>
  <link rel="icon" href="<?= base_url(); ?>assets/img/favicon.png" type="image/png" >
  <link rel="favicon" href="<?= base_url(); ?>assets/img/favicon.png" type="image/png">
  
  <title>SIAP</title>
</head>

<body>

  <div class="konten">

  <!-- Navbar -->
  <div class="navbar" style="position: fixed; left: 0; right: 0;">
      <span class="title"></span>
      <a href="#" class="icon" onclick="toggleNavbar()">☰</a>
      <a href="#">Menu Utama</a>
      <a href="#programkerja">Program</a>
      <a href="#visimisi">Visi Misi</a>
      <a href="#pendidikan">Pendidikan</a>
      <a href="<?php echo base_url(); ?>Auth/loginpage">Masuk</a>
  </div>

  <img id="banner" src="<?php echo base_url(); ?>assets/img/<?php echo $profile["Banner"][0]; ?>" alt="BGNU" style="width: 100%; margin-top: 55px;">
  

  <!-- Konten Profil -->
  <div class="profile-container" style=" padding: 20px;">
    <?php // echo "<pre>"; var_dump($profile); ?>
    <!-- <img src="<?php // echo base_url(); ?>assets/img/login.jpeg" alt="John Doe" class="profile-picture"> -->
     <!-- Tambahkan Biodata -->
    <div class="profile-bio" style="margin-top: 100px;">
        <?php echo $profile["Profile"][0]; ?>
    </div>
  </div>

  <!-- Galeri Gambar Online -->
  <?php /*
  <div class="image-gallery">
    <img src="<?php echo base_url(); ?>assets/img/l1.jpeg" alt="Gambar 1">
    <img src="<?php echo base_url(); ?>assets/img/l2.jpeg" alt="Gambar 2">
    <img src="<?php echo base_url(); ?>assets/img/l3.jpeg" alt="Gambar 3">
  </div>
*/?>

<!-- Visi dan Misi -->
<section id="visimisi">
  <div class="vision-mission" style="color: white; padding: 20px;">
    <h2 style="font-size: 28px;">Visi</h2>

        <?php echo $profile["Visi"][0]; ?>
  </div>

  <div class="vision-mission" style="color: white; padding: 20px;">
    <h2 style="font-size: 28px;">Misi</h2>

        <?php echo $profile["Misi"][0]; ?>
  </div>  <!-- Prestasi -->  
</section>

<section id="pendidikan">
<!-- Prestasi -->
<div class="education" style="color: white; padding: 20px;">
  <h2 style="font-size: 28px;">Pendidikan</h2>
        <?php echo $profile["Pendidikan"][0]; ?>

</div>
</section>

<section id="prestasi">
<!-- Prestasi -->
<div class="achievements" style="color: white; padding: 20px;">
  <h2 style="font-size: 28px;">Prestasi</h2>
  <ul>
    <?php
      foreach ($profile['Prestasi'] as $key => $value) {
        ?>
            <li style="font-size: 18px;"><?php echo $value; ?> </li>

        <?php
      }
    ?>
  </ul>
</div>
</section>

<section id="programkerja">
<div class="programs" style="color: white; padding: 20px;">
  <h2 style="font-size: 28px;">Rencana Program Kerja</h2>
  <ol>
    <?php
      foreach ($profile['Program'] as $key => $value) {
        ?>
            <li style="font-size: 18px;"><?php echo $value; ?></li>

        <?php
      }
    ?>
   <!-- Add more program items as needed -->
  </ol>
</div>
</section>
  <!-- ... (script JavaScript lainnya) ... -->
</div>
</body>
<script type="text/javascript">
        function toggleNavbar() {
            var navbar = document.querySelector('.navbar');
            navbar.classList.toggle('responsive');
        }
</script>
</html>
