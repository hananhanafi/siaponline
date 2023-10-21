<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel" style="padding: 20px 0px 30px 0px">
      <div class="pull-left image">
        <img src="<?php echo base_url(); ?>assets/img/<?php if($this->session->userdata('photo')){echo $this->session->userdata('photo');} else {echo "ico21.png";} ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p style="word-wrap: break-word;"><?php echo $this->session->userdata('first_name'); ?></p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">LIST MENU</li>
      <li <?php if ($page == 'home') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Home'); ?>">
          <i class="fa fa-home"></i>
          <span>Beranda</span>
        </a>
      </li>

      <li class="header">DATA MASTER</li>
        
 <?php
      if ( $this->session->userdata('id_role') == 1) {
       ?>
       <li class="treeview <?php if ($page == 'Master Data') {echo 'active';} ?>">
      <a href="#">
        <i class="fa fa-folder-open"></i>
        <span>Master Data</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
         <?php if ( $this->session->userdata('id_role') == 1 ) { ?>

	      <li <?php if ($page == 'Data Wilayah') {echo 'class="active"';} ?>>
	        <a href="<?php echo base_url('kecamatan'); ?>">
	          <i class="fa fa-folder-open"></i>
	          <span>Master Wilayah </span>
	        </a>
	      </li>
        <?php 
        }
        if ( $this->session->userdata('id_role') == 1 ) { ?>
	      <li <?php if ($page == 'Data Kecamatan') {echo 'class="active"';} ?>>
	        <a href="<?php echo base_url('kelurahan'); ?>">
	          <i class="fa fa-folder-open"></i>
	          <span>Master Kecamatan </span>
	        </a>
	      </li>
        <?php 
        }
        if ( $this->session->userdata('id_role') == 1 ) { ?>
	      <li <?php if ($page == 'Data Kelurahan') {echo 'class="active"';} ?>>
	        <a href="<?php echo base_url('rW'); ?>">
	          <i class="fa fa-folder-open"></i>
	          <span>Master Kelurahan </span>
	        </a>
	      </li>
        <?php 
        }
   
        ?>
        <!-- Add more submenus for other master data here -->
      </ul>
    </li>
  
 <?php
}      

       ?>
      <li <?php if ($page == 'pemilih') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('pemilih'); ?>">
          <i class="fa fa-male"></i>
          <span>Calon Pemilih</span>
        </a>
      </li> 

 <?php
 if ( $this->session->userdata('id_role') == 1 ) {
       ?>     
      <li <?php if ($page == 'realcount') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('realcount'); ?>">
          <i class="fa fa-male"></i>
          <span>Pemilih </span>
        </a>
      </li>
      <li <?php if ($page == 'saksi') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('saksi'); ?>">
          <i class="fa fa-user"></i>
          <span>Data Saksi</span>
        </a>
      </li> 
      
<?php 
}
?>
 <?php
      if ( $this->session->userdata('id_role') == 1 ) {
       ?>
      <!-- Semua role -->
      <li class="header">REKAPITULASI</li>
      
      
      <li <?php if ($page == 'Rekap') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('rekap'); ?>">
          <i class="fa fa-table"></i>
          <span>Target Pencapaian</span>
        </a>
      </li>  

      <li <?php if ($page == 'Rekap Hasil') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('rekaphasil'); ?>">
          <i class="fa fa-table"></i>
          <span>Rekap Perolehan</span>
        </a>
      </li>  
	           <?php 
}
if ( ($this->session->userdata('id_role') == 1) or ($this->session->userdata('id_role') == 2) or ($this->session->userdata('id_role') == 3) ) {

        ?>

      <li class="header">PENGATURAN</li>
      <li <?php if ($page == 'pengguna') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Pengguna'); ?>">
          <i class="fa fa-users"></i>
          <span>Tim </span>
        </a>
      </li>
      <?php if ( $this->session->userdata('id_role') == 1 ) { ?>

      <li <?php if ($page == 'slideshow') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Slider'); ?>">
          <i class="fa fa-photo"></i>
          <span>Foto Beranda </span>
        </a>
      </li>
      <li <?php if ($page == 'profilecaleg') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Profilecaleg'); ?>">
          <i class="fa fa-user"></i>
          <span>Profil Caleg </span>
        </a>
      </li>
      <?php 
        }
      }
      ?>

    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>