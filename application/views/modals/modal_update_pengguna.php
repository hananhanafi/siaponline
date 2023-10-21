<form id="form-update-pengguna" class="form-horizontal" method="POST">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h3 style="display:block; text-align:center;">Perbarui Data Tim</h3>                   
  </div> <!-- modal header -->
  <div class="modal-body form">
    <div class="form-msg"></div>
    <input type="hidden" name="id" value="<?php echo $dataPengguna->id; ?>"> 
    <input name="id_kabupaten" class="form-control" type="hidden" value="3210">
    <div class="form-body well">
      
      <!-- Kecamatan -->
      <div class="form-group">
        <label class="control-label col-md-2">Kecamatan</label>
        <div class="col-md-10">
          
          <select class="form-control select2" name="id_kecamatan" id="id_kecamatan" style="width: 100%" <?php if ($this->session->userdata('id_kecamatan')){ echo "disabled"; } ?> >
            <option value="">-- Choose --</option>
            <?php
            foreach ($dataKecamatan as $dtkec) {
            ?>
            <option <?=($dtkec->id_kec==$dataPengguna->id_kecamatan)?'selected="selected"':''; ?> value="<?php echo $dtkec->id_kec; ?>" <?php if ($dtkec->id_kec == $this->session->userdata('id_kecamatan')){ echo "selected"; } ?>><?php echo $dtkec->nama_kec; ?></option>
            <?php
            }
            ?>
          </select>
          <span class="help-block"></span>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-2">Kelurahan</label>
        <div class="col-md-10">
          
          <select class="form-control select2" name="id_desa" id="id_desa" style="width: 100%" <?php if ($this->session->userdata('id_desa')){ echo "disabled"; } ?> >
            <option value="">-- Choose --</option>
            <?php
            foreach ($dataKelurahan as $dtkel) {
            ?>
            <option <?=($dtkel->id_desa==$dataPengguna->id_desa)?'selected="selected"':''; ?> value="<?php echo $dtkel->id_desa; ?>" <?php if ($dtkel->id_desa == $this->session->userdata('id_desa')){ echo "selected"; } ?>><?php echo $dtkel->nama_desa; ?></option>
            <?php
            }
            ?>
          </select>
          <span class="help-block"></span>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-2">RW</label>
        <div class="col-md-10">
          
          <select class="form-control select2" name="id_rw" id="id_rw" style="width: 100%" <?php if ($this->session->userdata('id_rw')){ echo "disabled"; } ?> >
            <option value="">-- Choose --</option>
            <?php
            foreach ($dataRW as $dtrw) {
            ?>
            <option <?=($dtrw->id_rw==$dataPengguna->id_rw)?'selected="selected"':''; ?> value="<?php echo $dtrw->id_rw; ?>" <?php if ($dtrw->id_rw == $this->session->userdata('id_rw')){ echo "selected"; } ?>><?php echo $dtrw->nama_rw; ?></option>
            <?php
            }
            ?>
          </select>
          <span class="help-block"></span>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-2">RT</label>
        <div class="col-md-10">
          
          <input type="text" id="id_rt" name="id_rt" class="form-control" value="<?php echo $dataPengguna->id_rt; ?>">
          <!-- <select class="form-control select2" name="id_rt" id="id_rt" style="width: 100%" <?php // if ($this->session->userdata('id_rt')){ echo "disabled"; } ?> >
            <option value="">-- Choose --</option>
            <?php
            /* foreach ($dataRT as $dtrt) {
            ?>
            <option <?=($dtrt->id_rt==$dataPengguna->id_rt)?'selected="selected"':''; ?> value="<?php echo $dtrt->id_rt; ?>" <?php if ($dtrt->id_rt == $this->session->userdata('id_rt')){ echo "selected"; } ?>><?php echo $dtrt->nama_rt; ?></option>
            <?php
            } */
            ?>
          </select>
          -->
          <span class="help-block"></span>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-2">Username</label>
        <div class="col-md-10">
          <input name="username" placeholder="Username" class="form-control" type="text" value="<?php echo $dataPengguna->username; ?>">
          <span class="help-block"></span>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-2">Password</label>
        <div class="col-md-10">
          <div class="input-group">
            <input id="password2" name="password" class="form-control" type="password" data-toggle="password">
            <span class="input-group-btn">
              <button type="button" class="btn btn-flat" onclick="myFunction2()"><i class="fa fa-eye"></i></button>
            </span>
            <span class="help-block"></span>
          </div>
          <small class="text-teal">kosongkan untuk tidak mengganti password</small>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-2">Nama Depan</label>
        <div class="col-md-10">
          <input name="first_name" placeholder="Nama Depan" class="form-control" type="text" value="<?php echo $dataPengguna->first_name; ?>">
          <span class="help-block"></span>
        </div>
      </div>
      <?php if ($dataPengguna->id_role != 1) {
      ?>
      <div class="form-group">
        <label class="control-label col-md-2">Level Pengguna</label>
        <div class="col-md-10">

              <select class="form-control select2" name="id_role" id="id_role" style="width: 100%" >

                <?php
                foreach ($dataRole as $dtr) {
                ?>
                <option <?=($dtr->id==$dataPengguna->id_role)?'selected="selected"':''; ?> value="<?php echo $dtr->id; ?>" <?php if ($dtr->id == $this->session->userdata('id_role')){ echo "selected"; } ?>><?php echo $dtr->name; ?></option>
                <?php
                }
              ?>
              </select>
            <span class="help-block"></span>        
        </div>
      </div>
    <?php } ?>
      <div class="form-group">
        <label class="control-label col-md-2">Email</label>
        <div class="col-md-10">
          <input name="email" placeholder="Email" class="form-control" type="email" value="<?php echo $dataPengguna->email; ?>">
          <span class="help-block"></span>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-2">Phone</label>
        <div class="col-md-10">
          <input name="phone" placeholder="Phone" class="form-control" type="text" value="<?php echo $dataPengguna->phone; ?>">
          <span class="help-block"></span>
        </div>
      </div>

	    <div class="form-group">
        <label class="control-label col-md-2">Aktif?</label>
        <div class="col-md-10">
            <select class="form-control " name="statuser" id="id_role" placeholder="Role">
              <option <?=("Y"==$dataPengguna->active)?'selected="selected"':''; ?> value="Y" >Ya</option>
              <option <?=("N"==$dataPengguna->active)?'selected="selected"':''; ?> value="N" >Tidak</option>
            </select>
            <span class="help-block"></span>        
        </div>
      </div>
    </div>
  </div> <!-- modal body -->

  <div class="modal-footer">
    <div>
      <button type="submit" class="form-control btn btn-primary"><i class="fa fa-check"></i> Update Data</button>

    </div>
  </div> <!-- modal footer -->
</form>


<script type="text/javascript">


    $(document).ready(function() {
    });

    function perbaruiInputKelurahan(id_desa_selected = null) {
        var dropdownKecamatan = document.getElementById('id_kecamatan');
        var dropdownKelurahan = document.getElementById('id_desa');
        var kecamatanTerpilih = dropdownKecamatan.value;

        // Bersihkan pilihan sebelumnya
        dropdownKelurahan.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';

        // Jika Kecamatan dipilih, isi pilihan Kelurahan sesuai
        if (kecamatanTerpilih !== '') {
            $.ajax({
                url : "<?php echo site_url('pemilih/ajax_get_kelurahan')?>/" + kecamatanTerpilih,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    
                    var pilihanKelurahan = data; // Gantikan dengan sumber data aktual Anda

                    console.log(pilihanKelurahan.length);
                    for (var i = 0; i < pilihanKelurahan.length; i++) {
                        // console.log(pilihanKelurahan[i]);
                        var opsi = document.createElement('option');
                        opsi.value = pilihanKelurahan[i].id_desa;

                        if (id_desa_selected == pilihanKelurahan[i].id_desa) {
                            opsi.selected = "selected";
                        }
                        opsi.innerText = pilihanKelurahan[i].nama_desa;
                        dropdownKelurahan.appendChild(opsi);
                    }

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else {
            $.ajax({
                url : "<?php echo site_url('pemilih/ajax_getall_kelurahan')?>/",
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    
                    var pilihanKelurahan = data; // Gantikan dengan sumber data aktual Anda

                    console.log(pilihanKelurahan.length);
                    for (var i = 0; i < pilihanKelurahan.length; i++) {
                        // console.log(pilihanKelurahan[i]);
                        var opsi = document.createElement('option');
                        opsi.value = pilihanKelurahan[i].id_desa;
                        opsi.innerText = pilihanKelurahan[i].nama_desa;
                        dropdownKelurahan.appendChild(opsi);
                    }

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
    }

    function perbaruiInputRW(id_rw_selected = null, id_desa_selected = null) {
        var dropdownKelurahan = document.getElementById('id_desa');
        var dropdownRW = document.getElementById('id_rw');
        var kelurahanTerpilih = dropdownKelurahan.value;
        if (id_desa_selected) {
            kelurahanTerpilih = id_desa_selected;   
        }

        // Bersihkan pilihan sebelumnya
        dropdownRW.innerHTML = '<option value="">-- Pilih RW --</option>';

        // Jika Kecamatan dipilih, isi pilihan Kelurahan sesuai
        if (kelurahanTerpilih !== '') {
            $.ajax({
                url : "<?php echo site_url('pemilih/ajax_get_rw')?>/" + kelurahanTerpilih,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    
                    var pilihanRW = data; // Gantikan dengan sumber data aktual Anda

                    for (var i = 0; i < pilihanRW.length; i++) {
                        // console.log(pilihanKelurahan[i]);
                        var opsi = document.createElement('option');
                        opsi.value = pilihanRW[i].id_rw;

                        if (id_rw_selected == pilihanRW[i].id_rw) {
                            opsi.selected = "selected";
                        }
                        opsi.innerText = pilihanRW[i].nama_rw;
                        dropdownRW.appendChild(opsi);
                    }

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else {
            $.ajax({
                url : "<?php echo site_url('pemilih/ajax_getall_rw')?>/",
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    
                    var pilihanRW = data; // Gantikan dengan sumber data aktual Anda

                    for (var i = 0; i < pilihanRW.length; i++) {

                        var opsi = document.createElement('option');
                        opsi.value = pilihanRW[i].id_rw;
                        opsi.innerText = pilihanRW[i].nama_rw;
                        dropdownRW.appendChild(opsi);
                    }

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
    }


    function perbaruiInputRT(id_rt_selected = null, id_rw_selected = null) {
        var dropdownRW = document.getElementById('nama_rw');
        var dropdownRT = document.getElementById('nama_rt');
        var rwTerpilih = dropdownRW.value;
        if (id_rw_selected) {
            rwTerpilih = id_rw_selected;   
        }

        // Bersihkan pilihan sebelumnya
        dropdownRT.innerHTML = '<option value="">-- Pilih RT --</option>';

        // Jika Kecamatan dipilih, isi pilihan Kelurahan sesuai
        if (rwTerpilih !== '') {
            $.ajax({
                url : "<?php echo site_url('pemilih/ajax_get_rt')?>/" + rwTerpilih,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    
                    var pilihanRT = data; // Gantikan dengan sumber data aktual Anda

                    for (var i = 0; i < pilihanRT.length; i++) {
                        // console.log(pilihanKelurahan[i]);
                        var opsi = document.createElement('option');
                        opsi.value = pilihanRT[i].id_rt;

                        if (id_rt_selected == pilihanRT[i].id_rt) {
                            opsi.selected = "selected";
                        }
                        opsi.innerText = pilihanRT[i].nama_rt;
                        dropdownRT.appendChild(opsi);
                    }

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else {
            $.ajax({
                url : "<?php echo site_url('tps/ajax_getall_rt')?>/",
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    
                    var pilihanRT = data; // Gantikan dengan sumber data aktual Anda

                    for (var i = 0; i < pilihanRT.length; i++) {

                        var opsi = document.createElement('option');
                        opsi.value = pilihanRT[i].id_rt;
                        opsi.innerText = pilihanRT[i].nama_rt;
                        dropdownRT.appendChild(opsi);
                    }

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
    }
</script>