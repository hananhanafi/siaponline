<!-- Default box -->
<div class="box">
    <div class="box-body">
        <?php
        ?>
        <div class="panel panel-primary">
            <div class="panel-body">
                    <div class="col-md-6 col-xs-12">
                    <?php 
                    echo '<h4 class="text-muted"><b>Data Saksi </b></h4>';
                    ?>
                    </div>
                    <div class="col-md-2 col-xs-12">
                    <?php

                    if ($this->session->userdata('id_role') == 3) {
                        if (getStatusTransaksi('Pengelolaan Data Calon Kepala Desa')) {
                         echo '<button class="btn btn-success btn-block" onclick="add_person()" ><i class="glyphicon glyphicon-plus" ></i> Tambah</button>';
                        } else {
                            echo '<button class="btn btn-success btn-block" onclick="add_person()" disabled><i class="glyphicon glyphicon-plus" ></i> Tambah</button>';
                        }
                    } else {
                        echo '<button class="btn btn-success btn-block" onclick="add_person()"><i class="glyphicon glyphicon-plus" ></i> Tambah</button>';
                    }
                    ?>
                    </div>
                    <div class="col-md-2 col-xs-12">
                <button class="btn btn-default btn-block" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Muat Ulang</button>
            </div>
            <div class="col-lg-2 col-xs-12">
                <a href="<?php echo base_url('saksi/export'); ?>" class="btn btn-danger btn-block"><i class="fa fa-file-excel-o"></i> Unduh Excel</a>
                
                </div>
            </div>
        </div>
    	<div class="table-responsive">
            <div class="col-md-12">
            <table class="table table-hover table-condensed" id="table">
        		<thead>
                    <tr>
                        <th>No</th>
            			<th>Nama</th>
            			<th>NIK</th>
            	        <th>Alamat</th>
                        <th>No Hp</th>
            			<th>Wilayah</th>
            			<th>Kecamatan</th>
            			<th>Kelurahan</th>
            			<th>RW</th>
            			<th>RT</th>
                        <th>Dibuat</th>
            			<th style="width:80px;">Aksi</th>
            		</tr>
        		</thead>
        		<tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
	        </table>
            </div>	
    	</div><!-- /.table-responsive -->
    </div><!-- /.box-body -->
    <div class="box-footer">
        &nbsp;
    </div><!-- /.box-footer-->
</div><!-- /.box -->


<!-- Bootstrap modal -->
<div class="modal" id="modal_form" role="dialog" tabindex="-1" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"> Form Pemilih </h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                    <input type="hidden" value="" name="id"/> 
<!--                     <input type="hidden" value="<?php // echo $this->session->userdata('thn_data'); ?>" name="thn_pemilihan"/>  -->

                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama</label>
                            <div class="col-md-9">

                                <input name="nama" placeholder="Nama Lengkap" class="form-control" type="text">
                                <span class="help-block"></span>

                            </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">N.I.K</label>
                            <div class="col-md-9">
                                <input name="nik" placeholder="NIK" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">No Telepon</label>
                            <div class="col-md-9">
                                <input name="no_handphone" placeholder="Nomor Telepon" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>

                        </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Alamat</label>
                            <div class="col-md-9">
                                <textarea name="alamat" rows = "2" placeholder="Alamat" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Kecamatan</label>
                            <div class="col-sm-9">
                                <?php echo $form_kec; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Kelurahan</label>
                            <div class="col-sm-9">
                                <?php echo $form_kel; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">RW</label>
                            <div class="col-sm-9">
                                <?php echo $form_rw; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">RT</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_rt" id="nama_rw" class="form-control">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<script type="text/javascript">

var save_method; //for save method string
var table;
var base_url = '<?php echo base_url();?>';

$(document).ready(function() {

    //datatables
    table = $('#table').DataTable({ 
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
        },
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('saksi/ajax_list')?>",
            "type": "POST",
            "data": function ( data ) {
            }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            { 
                "targets": [ -1 ], //last column
                "orderable": false, //set not orderable
            },
            { 
                "targets": [ -2 ], //2 last column (photo)
                "orderable": false, //set not orderable
            },
        ],
        aLengthMenu: [
                [10, 25, 50, 100, 200, -1],
                [10, 25, 50, 100, 200, "All"]
            ],
            iDisplayLength: 10
    });

    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: false,
        todayHighlight: true,  
        language: "id",
        locale: "id",
    });

    $('#btn-filter').click(function(){ //button filter event click
        table.ajax.reload();  //just reload table
    });

    $('#btn-reset').click(function(){ //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload();  //just reload table
    });

    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

    $('textarea').keypress(function(event) {
  if (event.which == 13) {
    event.preventDefault();
      var s = $(this).val();
      $(this).val(s+"\n");
  }
});
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

    //nested combobox
    $("#id_kec").change(function (){
        var url = "<?php echo site_url('calon/add_ajax_desa');?>/"+$(this).val();
        $('#id_desa').load(url);
        return false;
    });

    $(document).on('click', '.panel-heading span.clickable', function(e){
        var $this = $(this);
        if(!$this.hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body').slideUp();
            $this.addClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
        } else {
            $this.parents('.panel').find('.panel-body').slideDown();
            $this.removeClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
        }
    })  
});

function add_person()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Pemilih'); // Set Title to Bootstrap modal title

    $('#photo-preview').hide(); // hide photo preview modal

    $('#label-photo').text('Upload Photo'); // label photo upload
    document.getElementById('nama_kec').addEventListener('change', perbaruiPilihanKelurahan);
    document.getElementById('nama_kel').addEventListener('change', perbaruiPilihanRW);
    // document.getElementById('nama_rw').addEventListener('change', perbaruiPilihanRT);

    $('[name="id"]').val('');

}

function edit_saksi(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('saksi/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="nama"]').val(data.nama);
            $('[name="nik"]').val(data.nik);
            $('[name="no_handphone"]').val(data.no_hp);
            $('[name="alamat"]').val(data.alamat);
            // $('[name="nama_wil"]').val(data.kd_wilayah);
            $('[name="nama_kec"]').val(data.kd_kecamatan);
            $('[name="nama_kel"]').val(data.kd_kelurahan);
            $('[name="nama_rw"]').val(data.kd_rw);
            $('[name="nama_rt"]').val(data.kd_rt);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Pemilih'); // Set title to Bootstrap modal title


            document.getElementById('nama_kec').addEventListener('change', perbaruiPilihanKelurahan);
            document.getElementById('nama_kel').addEventListener('change', perbaruiPilihanRW);
            // document.getElementById('nama_rw').addEventListener('change', perbaruiPilihanRT);

            perbaruiInputKelurahan(data.kd_kelurahan);
            perbaruiInputRW(data.kd_rw, data.kd_kelurahan);
            // perbaruiPilihanRT(data.kd_rt, data.kd_rw);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax!');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('saksi/ajax_add')?>";
    } else {
        url = "<?php echo site_url('saksi/ajax_update')?>";
    }
    var formData = new FormData($('#form')[0]);
    // Mengambil semua elemen <select> dengan atribut 'disabled' dalam formulir
    var disabledSelects = $(form).find('select:disabled');

    // Menambahkan elemen-elemen <select> dengan atribut 'disabled' ke dalam FormData
    disabledSelects.each(function(index, select) {
        var selectName = $(select).attr('name');
        var selectValue = $(select).val();
        formData.append(selectName, selectValue);
    });
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error adding / update data');
			alert("Error requesting " + errorThrown.url + ": " + jqXHR.status + " " + jqXHR.statusText);
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function delete_saksi(id)
    {
        swal({
            title: "Anda yakin?",
            text: "Data yang sudah terhapus tidak akan bisa dikembalikan.",
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
                url : "<?php echo site_url('saksi/ajax_delete')?>/"+id,
                type: "POST",
                dataType: "JSON",
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                },

                success: function(data) {
                    $('#modal_form').modal('hide');
                    reload_table();
                    swal("Terhapus!", "Data berhasil dihapus.", "success");
                }
            });
        } else {
            swal("Dibatalkan", "Data batal dihapus :)", "error");
        }

    });

}   
    function perbaruiPilihanKelurahan() {
        var dropdownKecamatan = document.getElementById('nama_kec');
        var dropdownKelurahan = document.getElementById('nama_kel');
        var kecamatanTerpilih = dropdownKecamatan.value;
        console.log(dropdownKecamatan);
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
    function perbaruiInputKelurahan(id_desa_selected = null) {
        var dropdownKecamatan = document.getElementById('nama_kec');
        var dropdownKelurahan = document.getElementById('nama_kel');
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


    function perbaruiPilihanRW() {
        var dropdownKelurahan = document.getElementById('nama_kel');
        var dropdownRW = document.getElementById('nama_rw');
        var kelurahanTerpilih = dropdownKelurahan.value;

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
    function perbaruiInputRW(id_rw_selected = null, id_desa_selected = null) {
        var dropdownKelurahan = document.getElementById('nama_kel');
        var dropdownRW = document.getElementById('nama_rw');
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




    function perbaruiPilihanRT() {
        var dropdownRW = document.getElementById('nama_rw');
        var dropdownRT = document.getElementById('nama_rt');
        var rwTerpilih = dropdownRW.value;

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
                url : "<?php echo site_url('pemilih/ajax_getall_rt')?>/",
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



    function perbaruiPilihanTPS() {
        var dropdownRW = document.getElementById('nama_rw');
        var dropdownTPS = document.getElementById('nama_tps');
        var rwTerpilih = dropdownRW.value;

        // Bersihkan pilihan sebelumnya
        dropdownTPS.innerHTML = '<option value="">-- Pilih TPS --</option>';

        // Jika Kecamatan dipilih, isi pilihan Kelurahan sesuai
        if (rwTerpilih !== '') {
            $.ajax({
                url : "<?php echo site_url('pemilih/ajax_get_tps')?>/" + rwTerpilih,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    
                    var pilihanTPS = data; // Gantikan dengan sumber data aktual Anda

                    for (var i = 0; i < pilihanTPS.length; i++) {
                        // console.log(pilihanKelurahan[i]);
                        var opsi = document.createElement('option');
                        opsi.value = pilihanTPS[i].id;
                        opsi.innerText = pilihanTPS[i].nama_tps;
                        dropdownTPS.appendChild(opsi);
                    }

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else {
            $.ajax({
                url : "<?php echo site_url('pemilih/ajax_getall_tps')?>/",
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    
                    var pilihanTPS = data; // Gantikan dengan sumber data aktual Anda

                    for (var i = 0; i < pilihanTPS.length; i++) {

                        var opsi = document.createElement('option');
                        opsi.value = pilihanTPS[i].id;
                        opsi.innerText = pilihanTPS[i].nama_tps;
                        dropdownTPS.appendChild(opsi);
                    }

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
    }
    function perbaruiInputTPS(id_tps_selected = null, id_rw_selected = null) {
        var dropdownRW = document.getElementById('nama_rw');
        var dropdownTPS = document.getElementById('nama_tps');
        var rwTerpilih = dropdownRW.value;
        if (id_rw_selected) {
            rwTerpilih = id_rw_selected;   
        }

        // Bersihkan pilihan sebelumnya
        dropdownTPS.innerHTML = '<option value="">-- Pilih TPS --</option>';

        // Jika Kecamatan dipilih, isi pilihan Kelurahan sesuai
        if (rwTerpilih !== '') {
            $.ajax({
                url : "<?php echo site_url('pemilih/ajax_get_tps')?>/" + rwTerpilih,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    
                    var pilihanTPS = data; // Gantikan dengan sumber data aktual Anda

                    for (var i = 0; i < pilihanTPS.length; i++) {
                        // console.log(pilihanKelurahan[i]);
                        var opsi = document.createElement('option');
                        opsi.value = pilihanTPS[i].id;

                        if (id_tps_selected == pilihanTPS[i].id) {
                            opsi.selected = "selected";
                        }
                        opsi.innerText = pilihanTPS[i].nama_tps;
                        dropdownTPS.appendChild(opsi);
                    }

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else {
            $.ajax({
                url : "<?php echo site_url('tps/ajax_getall_tps')?>/",
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    
                    var pilihanTPS = data; // Gantikan dengan sumber data aktual Anda

                    for (var i = 0; i < pilihanTPS.length; i++) {

                        var opsi = document.createElement('option');
                        opsi.value = pilihanTPS[i].id;
                        opsi.innerText = pilihanTPS[i].nama_tps;
                        dropdownTPS.appendChild(opsi);
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