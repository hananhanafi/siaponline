<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<!-- /.box -->
<div class="box">
  <div class="box-header with-border">
    <div class="box-tools pull-right">
      <button class="btn btn-box-tool" data-toggle="tooltip" title="Reload" onclick="reload_table()"><i class="fa fa-refresh"></i></button>
      <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
      <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
    </div>
    <?php if($this->session->userdata('id_role') == 1 ){  ?>
    <div class="col-md-6">
      <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-pengguna"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
    <div class="col-md-4">
      <a href="<?php echo base_url('Pengguna/export'); ?>" class="form-control btn btn-danger"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Unduh Excel</a>
    </div>
    <?php }  ?>

  </div>
  <!-- /.box-header -->
  <div class="box-body">
    
    <div class="clearfix">&nbsp;</div>
      <div class="col-md-12 table-responsive">
      <table id="list-data" class="table table-hovered table-condensed">
        <thead>
          <tr>
            <th style="width:200px;text-align:center;vertical-align: middle;">Nama</th>
            <th>Unit Wilayah</th>
            <th>Unit Kecamatan</th>
            <th>Unit Kelurahan</th>
            <th>Unit RW</th>
            <th>Unit RT</th>
            <th>Nomor Handphone</th>
            <th style="width:150px;text-align:center;vertical-align: middle;">Peran</th>
            <th style="width:60px;text-align:center;vertical-align: middle;">Aktif?</th>

    <?php if($this->session->userdata('id_role') == 1 ){  ?>
            <th style="width:40px;text-align:center;vertical-align: middle;">Aksi</th>

    <?php } ?>
          </tr>
        </thead>
        <tbody id="data-pengguna">
          
        </tbody>
      </table>
      </div> <!-- /.row -->
    </div>
  </div>
  <?php echo $modal_tambah_pengguna; ?>
  <div id="tempat-modal"></div>
  <?php show_my_confirm('konfirmasiHapus', 'hapus-dataPengguna', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
  