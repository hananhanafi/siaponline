<div class="row">

  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-purple">
      <div class="inner">
        <h3><?php echo number_format_short($jmlpemilihperrole->jmlpilih)."/".($target?number_format_short($target->target):0); ?></h3>
        <p>Target Pengguna</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-people"></i>
      </div>
      <a href="<?php echo base_url('rekap'); ?>" class="small-box-footer">info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div><!-- ./col -->

  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3><?php echo number_format_short($jmlpemilih->jmlpilih)."/".number_format_short(22500); ?></h3>
        <p>Target Dapil</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-people"></i>
      </div>
      <a href="<?php echo base_url('rekap'); ?>" class="small-box-footer">info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3><?php echo number_format_short($jmlpemilih->jmlpilih); ?></h3>
        <p>Total Calon Pemilih</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-people "></i>
      </div>
      <a href="<?php echo base_url('pemilih'); ?>" class="small-box-footer">info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?php echo number_format_short(0); ?></h3>
        <p>Total Pemilih</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-people "></i>
      </div>
      <a href="<?php echo base_url('realcount'); ?>" class="small-box-footer">info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div><!-- ./row -->

<div class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
        <!-- Indicator Carousel -->
        <ol class="carousel-indicators">
            <?php
              $ind = 0;
              foreach ($sliders as $slider) {
                ?>
                  <li data-target="#myCarousel" data-slide-to="<?php echo $ind; ?>" <?php if($ind==0){ echo 'class="active"'; }; ?> ></li>
                <?php
              $ind++;
              }
            ?>
        </ol>

        <!-- Item Carousel -->
        <div class="carousel-inner">

            <?php
              $ind = 0;
              foreach ($sliders as $slider) {
                ?>
                  <div class="item  <?php if($ind==0){ echo 'active'; } ?>">
                      <img src="https://sabaronline.com/assets/img/<?php echo $slider->path_slider; ?>" alt="<?php echo $slider->nama_slider; ?>" width="100%">
                  </div>
                  
                <?php
                $ind++;
              }
            ?>

        </div>

        <!-- Tombol Navigasi Carousel -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
</div>

<!-- FLASH MESSAGE -->
<div class="msg" style="display:none;">
  <?php if($this->session->flashdata('msg')):echo $this->session->flashdata('msg');endif; ?><br/>
</div>

<!-- FLASH MESSAGE -->
<div class="msg" style="display:none;">
  <?php if($this->session->flashdata('welcome_msg')):echo $this->session->flashdata('welcome_msg');endif; ?><br/>
</div>

<script type="text/javascript">
  $(document).ready(function(){
      $('#imageCarousel').carousel(); // Initialize the carousel
    });
</script>