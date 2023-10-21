<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active" ><a href="#profil" data-toggle="tab">Profil</a></li>
        <li><a href="#visimisi" data-toggle="tab">Visi Misi</a></li>
        <li><a href="#pendidikan" data-toggle="tab">Pendidikan</a></li>
        <li><a href="#prestasi" data-toggle="tab">Prestasi</a></li>
        <li><a href="#program" data-toggle="tab">Program</a></li>
      </ul>
      <div class="tab-content"> 
        <div class="active tab-pane" id="profil">
          <form class="form-horizontal profile-form" action="<?php echo base_url('profilecaleg/update_profile') ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="form-control" id="id_profil" name="id_profil" value="<?php echo $profile['Profile']['id'][0]; ?>">
            <input type="hidden" class="form-control" id="tipe" name="tipe" value="Profile">
            <input type="hidden" class="form-control" id="id_banner" name="id_banner" value="<?php echo $profile['Banner']['id'][0]; ?>">
            <input type="hidden" class="form-control" id="id_background" name="id_background" value="<?php echo $profile['Background']['id'][0]; ?>">
           
            <div class="form-group">
              <label for="passLama" class="col-sm-2 control-label">Profil Caleg</label>
              <div class="col-sm-10">
                <textarea id="profil_value" name="profil_value"><?php echo $profile['Profile']['values'][0]; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputFoto" class="col-sm-2 control-label">Foto Banner</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" placeholder="Foto" name="photo" id="photo">
              </div>
            </div>
            <div class="form-group">
              <label for="inputFoto" class="col-sm-2 control-label">Foto Background</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" placeholder="Foto" name="photobg" id="photobg">
              </div>
            </div>
            
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Simpan</button>
              </div>
            </div>
          </form>
        </div>
        <div class="tab-pane" id="visimisi">
          <form class="form-horizontal visimisi-form" action="<?php echo base_url('profilecaleg/update_visimisi') ?>" method="POST">
            <input type="hidden" class="form-control" id="id_visi" name="id_visi" value="<?php echo $profile['Visi']['id'][0]; ?>">
            <input type="hidden" class="form-control" id="id_misi" name="id_misi" value="<?php echo $profile['Misi']['id'][0]; ?>">
            <div class="form-group">
              <label for="passLama" class="col-sm-2 control-label">VISI</label>
              <div class="col-sm-10">
                <textarea id="profil_visi" name="profil_visi"><?php echo $profile['Visi']['values'][0]; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="passLama" class="col-sm-2 control-label">MISI</label>
              <div class="col-sm-10">
                <textarea id="profil_misi" name="profil_misi"><?php echo $profile['Misi']['values'][0]; ?></textarea>
              </div>
            </div>

            
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Simpan</button>
              </div>
            </div>
          </form>
        </div>
        <div class="tab-pane" id="pendidikan">
          <form class="form-horizontal education-form" action="<?php echo base_url('profilecaleg/update_pendidikan') ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="form-control" id="id_pendidikan" name="id_pendidikan" value="<?php echo $profile['Pendidikan']['id'][0]; ?>">
            <div class="form-group">
              <label for="passLama" class="col-sm-2 control-label">Pendidikan</label>
              <div class="col-sm-10">
                <textarea id="profil_education" name="profil_education"><?php echo $profile['Pendidikan']['values'][0]; ?></textarea>
              </div>
            </div>

            
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Simpan</button>
              </div>
            </div>

          </form>
        </div>

        <div class="tab-pane" id="prestasi">
          <form class="form-horizontal prestasi-form" action="<?php echo base_url('profilecaleg/update_prestasi') ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="form-control" id="tipe" name="tipe" value="Prestasi">
            <div class="form-group">
              <label for="prestasi_value" class="col-sm-2 control-label">Prestasi</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="prestasi_value" placeholder="" name="prestasi_value" value="">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Simpan</button>
              </div>
            </div>
          </form>
          <div class="table-responsive">

            <div class="col-md-12">
              <table id="table_prestasi" class="table table-condensed table-bordere table-hover" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th width= "30px">No</th>
                    <th >Nama Prestasi</th>
                    <th width= "130px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="3"></th>
                  </tr>
                </tfoot>
              </table>
            </div><!-- /.tabel-responsive -->
          </div>
         </div>
        <div class="tab-pane" id="program">
          <form class="form-horizontal program-form" action="<?php echo base_url('profilecaleg/update_program') ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="form-control" id="tipe" name="tipe" value="Program">
            <div class="form-group">
              <label for="profil_program" class="col-sm-2 control-label">Nama Program</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="program_value" name="program_value" value="">
              </div>
            </div>           
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Simpan</button>
              </div>
            </div>
          </form>

          <div class="table-responsive">

            <div class="col-md-12">
              <table id="table_program" class="table table-condensed table-bordere table-hover" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th width= "30px">No</th>
                    <th >Nama Program</th>
                    <th width= "130px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="3"></th>
                  </tr>
                </tfoot>
              </table>
            </div><!-- /.tabel-responsive -->
          </div>
         </div>

        </div>
      </div>
    </div>


  </div>
</div>

<script>
    // tinymce.init({selector:'textarea'});

    
    var table_program;
    var table_prestasi;
    $(document).ready(function() {
    ClassicEditor
        .create(document.querySelector('#profil_value'))
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#profil_visi'))
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#profil_misi'))
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#profil_education'))
        .catch(error => {
            console.error(error);
        });
      $('form.profile-form').on('submit', function(event) {
            event.preventDefault();  // Mencegah pengiriman formulir secara default

            // Mengambil data formulir
            var formData = new FormData(this);

            // Mengirimkan formulir menggunakan AJAX
            $.ajax({    
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                processData: false,  // Don't process the data (already in FormData)
                contentType: false,  // Don't set content type (browser will set as needed)
                success: function(response) {
                    // Menangani keberhasilan, jika diperlukan
                    // console.log('Formulir berhasil dikirim');
                    alert("Berhasil Simpan Data");
                },
                error: function(xhr, textStatus, errorThrown) {
                    // Menangani kesalahan, jika diperlukan
                    console.error('Pengiriman formulir gagal: ' + errorThrown);
                }
            });
        });
        $('form.visimisi-form').on('submit', function(event) {
            event.preventDefault();  // Mencegah pengiriman formulir secara default

            // Mengambil data formulir
            var formData = $(this).serialize();

            // Mengirimkan formulir menggunakan AJAX
            $.ajax({    
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                success: function(response) {
                    // Menangani keberhasilan, jika diperlukan
                    // console.log('Formulir berhasil dikirim');
                    alert("Berhasil Simpan Data");

                },
                error: function(xhr, textStatus, errorThrown) {
                    // Menangani kesalahan, jika diperlukan
                    console.error('Pengiriman formulir gagal: ' + errorThrown);
                }
            });
        });

        $('form.education-form').on('submit', function(event) {
            event.preventDefault();  // Mencegah pengiriman formulir secara default

            // Mengambil data formulir
            var formData = $(this).serialize();

            // Mengirimkan formulir menggunakan AJAX
            $.ajax({    
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                success: function(response) {
                    // Menangani keberhasilan, jika diperlukan
                    // console.log('Formulir berhasil dikirim');
                    alert("Berhasil Simpan Data");

                },
                error: function(xhr, textStatus, errorThrown) {
                    // Menangani kesalahan, jika diperlukan
                    console.error('Pengiriman formulir gagal: ' + errorThrown);
                }
            });
        });
    //datatables
      table_program = $('#table_program').DataTable({
        "footerCallback": function ( row, data, start, end, display ) {
              var api = this.api(), data;
   
              // converting to interger to find total
              var intVal = function ( i ) {
                  return typeof i === 'string' ?
                      i.replace(/[\$,]/g, '')*1 :
                      typeof i === 'number' ?
                          i : 0;
              };
          },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
        "url": "<?php echo site_url('profilecaleg/list_program')?>",
        "type": "POST",
        "data": function ( data ) {
        }
        },
        //Set column definition initialisation properties.
        "columnDefs": [
            {
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
            },
          ],
        aLengthMenu: [
              [10, 25, 50, 100, 200, -1],
              [10, 25, 50, 100, 200, "All"]
          ],
          iDisplayLength: 10
      });

      table_prestasi = $('#table_prestasi').DataTable({
        "footerCallback": function ( row, data, start, end, display ) {
              var api = this.api(), data;
   
              // converting to interger to find total
              var intVal = function ( i ) {
                  return typeof i === 'string' ?
                      i.replace(/[\$,]/g, '')*1 :
                      typeof i === 'number' ?
                          i : 0;
              };
          },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
        "url": "<?php echo site_url('profilecaleg/list_prestasi')?>",
        "type": "POST",
        "data": function ( data ) {
        }
        },
        //Set column definition initialisation properties.
        "columnDefs": [
            {
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
            },
          ],
        aLengthMenu: [
              [10, 25, 50, 100, 200, -1],
              [10, 25, 50, 100, 200, "All"]
          ],
          iDisplayLength: 10
      });

      $('form.prestasi-form').on('submit', function(event) {
            event.preventDefault();  // Mencegah pengiriman formulir secara default

            // Mengambil data formulir
            var formData = $(this).serialize();

            // Mengirimkan formulir menggunakan AJAX
            $.ajax({    
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                success: function(response) {
                    // Menangani keberhasilan, jika diperlukan
                    // console.log('Formulir berhasil dikirim');
                    alert("Berhasil Simpan Data");
                    table_prestasi.ajax.reload();

                },
                error: function(xhr, textStatus, errorThrown) {
                    // Menangani kesalahan, jika diperlukan
                    console.error('Pengiriman formulir gagal: ' + errorThrown);
                }
            });
        });
      $('form.program-form').on('submit', function(event) {
            event.preventDefault();  // Mencegah pengiriman formulir secara default

            // Mengambil data formulir
            var formData = $(this).serialize();

            // Mengirimkan formulir menggunakan AJAX
            $.ajax({    
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                success: function(response) {
                    // Menangani keberhasilan, jika diperlukan
                    // console.log('Formulir berhasil dikirim');
                    alert("Berhasil Simpan Data");
                    table_program.ajax.reload();

                },
                error: function(xhr, textStatus, errorThrown) {
                    // Menangani kesalahan, jika diperlukan
                    console.error('Pengiriman formulir gagal: ' + errorThrown);
                }
            });
        });

    }); 
function delete_prestasi(id)
  {
    swal({
      title: "Anda yakin?",
      text: "",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ya, hapus!",
      cancelButtonText: "Tidak",
      closeOnConfirm: false,
      closeOnCancel: false
    },

    function(isConfirm) {

    if (isConfirm) {

      $.ajax({
        url : "<?php echo site_url('profilecaleg/delete_prestasi')?>/"+id,
        type: "POST",
        dataType: "JSON",
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error deleting data');
        },

        success: function(data) {
              table_prestasi.ajax.reload();
              swal("Terhapus!", "Data berhasil dihapus.", "success");
        }
      });
    } else {
      swal("Dibatalkan", "Data batal dihapus :)", "error");
    }

  });

};
function delete_program(id)
  {
    swal({
      title: "Anda yakin?",
      text: "",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ya, hapus!",
      cancelButtonText: "Tidak",
      closeOnConfirm: false,
      closeOnCancel: false
    },

    function(isConfirm) {

    if (isConfirm) {

      $.ajax({
        url : "<?php echo site_url('profilecaleg/delete_program')?>/"+id,
        type: "POST",
        dataType: "JSON",
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error deleting data');
        },

        success: function(data) {
              table_program.ajax.reload();
              swal("Terhapus!", "Data berhasil dihapus.", "success");
        }
      });
    } else {
      swal("Dibatalkan", "Data batal dihapus :)", "error");
    }

  });
  };
</script>