<div class="msg" style="display:none;">
	<?php echo @$this->session->flashdata('msg'); ?>
</div>

<!-- Default box -->
<div class="box">
	<div class="box-body">


		<div class="panel panel-default">
			<div class="panel-body">
				<form id="form-filter" class="form-horizontal">
				    <div class="form-group">
                        <label class="col-sm-2 control-label">Kecamatan</label>
						<div class="col-sm-4">
                            <select id="filter_id_kec" name="filter_id_kec" class="form-control" >
    				           <option value="">-- Pilih Kecamatan --</option>
    				           <?php
    				           foreach($kecamatan as $kec){
    				             echo "<option value='".$kec['id_kec']."'>".$kec['nama_kec']."</option>";
    				           }
    				           ?>
    				        </select>
				        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kelurahan</label>
						<div class="col-sm-4">
                            <select id="filter_id_desa" name="filter_id_desa" class="form-control" >
    				           <option value="">-- Pilih Kelurahan --</option>
    				           <?php
    				           foreach($desa as $ds){
    				             echo "<option value='".$ds['id_desa']."'>".$ds['nama_desa']."</option>";
    				           }
    				           ?>
    				        </select>
				        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">RW</label>
						<div class="col-sm-4">
                            <select id="filter_id_rw" name="filter_id_rw" class="form-control" >
    				           <option value="">-- Pilih RW --</option>
    				           <?php
    				           foreach($rw as $r){
    				             echo "<option value='".$r['id_rw']."'>".$r['nama_rw']."</option>";
    				           }
    				           ?>
    				        </select>
				        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">RT</label>
						<div class="col-sm-4">
                            <select id="filter_id_rt" name="filter_id_rt" class="form-control" >
    				           <option value="">-- Pilih RT --</option>
    				           <?php
    				           foreach($rt as $t){
    				             echo "<option value='".$t['id_rt']."'>".$t['nama_rt']."</option>";
    				           }
    				           ?>
    				        </select>
				        </div>
                    </div>
					<div class="form-group">
						<label for="lbl_tps" class="col-sm-2 control-label">TPS</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="filter_nama_tps" name="filter_nama_tps">
						</div>
					</div>
					<div class="form-group">
						<label for="LastName" class="col-sm-2 control-label"></label>
						<div class="col-sm-4">
							<button type="button" id="btn-filter" class="btn btn-primary" >Cari</button>
							<button type="button" id="btn-reset" class="btn btn-default" >Batal</button>
					</div>
					</div>
				</form>
			</div> <!-- panel-body -->
		</div> <!-- panel -->
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="col-md-6 col-xs-12">
					<?php 
	        		echo '<h4 class="text-muted"><b>Data TPS</b></h4>';
	        		?>
	        	</div>
	        	<div class="col-md-2 col-xs-12">
				<?php

					echo '<button class="btn btn-success btn-block" onclick="add_tps()"><i class="glyphicon glyphicon-plus"></i> Tambah</button>';

				?>
				</div>
				<div class="col-md-2 col-xs-12">
        			<button class="btn btn-default btn-block" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Muat Ulang</button>
        		</div>
        		<div class="col-md-2 col-xs-12">
        			<a href="<?php //echo base_url('penyelenggara/export'); ?>" class="btn btn-default btn-block"><i class="fa fa-file-excel-o"></i> Unduh Excel</a>
        		</div>
			</div>
		</div>
		<div class="table-responsive">

			<div class="col-md-12">
				<table id="table" class="table table-condensed table-bordere table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th width= "30px" >No</th>
							<th >TPS</th>
							<th >RT</th>
							<th >RW</th>
							<th >Kelurahan</th>
							<th >Kecamatan</th>
							<th >Wilayah</th>
							<th width= "130px">Aksi</th>
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
						</tr>
					</tfoot>
				</table>
			</div><!-- /.tabel-responsive -->
		</div>
	</div><!-- /.box-body -->
	<div class="box-footer">
		&nbsp;
	</div><!-- /.box-footer-->
</div><!-- /.box -->

<script type="text/javascript">
	var table;
	$(document).ready(function() {
	//datatables
		table = $('#table').DataTable({
		    language: {
		        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
		    },
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
			"url": "<?php echo site_url('tps/ajax_list')?>",
			"type": "POST",
			"data": function ( data ) {
				data.kode_wilayah = $('#filter_kode_wilayah').val();
				data.id_kec = $('#filter_id_kec').val();
				data.id_desa = $('#filter_id_desa').val();
				data.id_rw = $('#filter_id_rw').val();
				data.id_rt = $('#filter_id_rt').val();
				data.nama_tps = $('#filter_nama_tps').val();
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

		
	// btn filter
	$('#btn-filter').click(function(){ //button filter event click
		table.ajax.reload();  //just reload table
	});

	$('#btn-reset').click(function(){ //button reset event click
		$('#form-filter')[0].reset();
		table.ajax.reload();  //just reload table
	});


	    document.getElementById('filter_id_kec').addEventListener('change', perbaruiPilihanKelurahan);

	    document.getElementById('id_kec').addEventListener('change', perbaruiInputKelurahan);

	    document.getElementById('filter_id_desa').addEventListener('change', perbaruiPilihanRW);

	    document.getElementById('id_desa').addEventListener('change', perbaruiInputRW);

	    document.getElementById('filter_id_rw').addEventListener('change', perbaruiPilihanRT);

	    document.getElementById('id_rw').addEventListener('change', perbaruiInputRT);


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
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
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

	$("#peringatan").fadeTo(2000, 500).slideUp(500, function(){
		$("#peringatan").slideUp(500);
	});

	function myChangeFunction(input1) {
		var input2 = document.getElementById('dpt_p');
		input2.value = input1.value;
	}

	function add_tps()
	{
	    save_method = 'add';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    $('#modal_form').modal('show'); // show bootstrap modal
	    $('.modal-title').text('Tambah Data'); // Set Title to Bootstrap modal title
	}

	function edit_tps(id)
	{
	    save_method = 'update';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string


	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo site_url('tps/ajax_edit')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
	        	
	            $('[name="id"]').val(data.id);
	            // $('[name="kode_wilayah"]').val(data.kode_wilayah);
	            $('[name="id_kec"]').val(data.id_kec);
	            perbaruiInputKelurahan(data.id_desa);
	            // $('[name="id_desa"]').val(data.id_desa);
	            perbaruiInputRW(data.id_rw, data.id_desa);
	            // $('[name="id_rw"]').val(data.id_rw);
	            perbaruiInputRT(data.id_rt, data.id_rw, data.id_desa);
	            $('[name="nama_tps"]').val(data.nama_tps);
	            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
	            $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title

	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
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
	        url = "<?php echo site_url('tps/ajax_add')?>";
	    } else {
	        url = "<?php echo site_url('tps/ajax_update')?>";
	    }

	    // ajax adding data to database

	    var formData = new FormData($('#form')[0]);
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
	            $('#btnSave').text('Simpan'); //change button text
	            $('#btnSave').attr('disabled',false); //set button enable 


	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error adding / update data');
	            $('#btnSave').text('save'); //change button text
	            $('#btnSave').attr('disabled',false); //set button enable 

	        }
	    });
	}

	function delete_tps(id)
	{
		swal({
			title: "Anda yakin?",
			text: "Menghapus data TPS di RW akan menghapus semua data Pemilih di TPS tersebut.",
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
				url : "<?php echo site_url('tps/ajax_delete')?>/"+id,
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
        var dropdownKecamatan = document.getElementById('filter_id_kec');
        var dropdownKelurahan = document.getElementById('filter_id_desa');
        var kecamatanTerpilih = dropdownKecamatan.value;

        // Bersihkan pilihan sebelumnya
        dropdownKelurahan.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';

        // Jika Kecamatan dipilih, isi pilihan Kelurahan sesuai
        if (kecamatanTerpilih !== '') {
        	$.ajax({
		        url : "<?php echo site_url('tps/ajax_get_kelurahan')?>/" + kecamatanTerpilih,
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
		        url : "<?php echo site_url('tps/ajax_getall_kelurahan')?>/",
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
        var dropdownKecamatan = document.getElementById('id_kec');
        var dropdownKelurahan = document.getElementById('id_desa');
        var kecamatanTerpilih = dropdownKecamatan.value;

        // Bersihkan pilihan sebelumnya
        dropdownKelurahan.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';

        // Jika Kecamatan dipilih, isi pilihan Kelurahan sesuai
        if (kecamatanTerpilih !== '') {
        	$.ajax({
		        url : "<?php echo site_url('tps/ajax_get_kelurahan')?>/" + kecamatanTerpilih,
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
		        url : "<?php echo site_url('tps/ajax_getall_kelurahan')?>/",
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
        var dropdownKelurahan = document.getElementById('filter_id_desa');
        var dropdownRW = document.getElementById('filter_id_rw');
        var kelurahanTerpilih = dropdownKelurahan.value;

        // Bersihkan pilihan sebelumnya
        dropdownRW.innerHTML = '<option value="">-- Pilih RW --</option>';

        // Jika Kecamatan dipilih, isi pilihan Kelurahan sesuai
        if (kelurahanTerpilih !== '') {
        	$.ajax({
		        url : "<?php echo site_url('tps/ajax_get_rw')?>/" + kelurahanTerpilih,
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
		        url : "<?php echo site_url('tps/ajax_getall_rw')?>/",
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
		        url : "<?php echo site_url('tps/ajax_get_rw')?>/" + kelurahanTerpilih,
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
		        url : "<?php echo site_url('tps/ajax_getall_rw')?>/",
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
        var dropdownRW = document.getElementById('filter_id_rw');
        var dropdownRT = document.getElementById('filter_id_rt');
        var RWTerpilih = dropdownRW.value;

        // Bersihkan pilihan sebelumnya
        dropdownRT.innerHTML = '<option value="">-- Pilih RT --</option>';

        // Jika Kecamatan dipilih, isi pilihan Kelurahan sesuai
        if (RWTerpilih !== '') {
        	$.ajax({
		        url : "<?php echo site_url('tps/ajax_get_rt')?>/" + RWTerpilih,
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
    function perbaruiInputRT(id_rt_selected = null, id_rw_selected = null, id_desa_selected = null) {
        var dropdownRW = document.getElementById('id_rw');
        var dropdownRT = document.getElementById('id_rt');
        var RWTerpilih = dropdownRW.value;
        if (id_rw_selected) {
        	RWTerpilih = id_rw_selected;	
        }

        // Bersihkan pilihan sebelumnya
        dropdownRT.innerHTML = '<option value="">-- Pilih RT --</option>';

        // Jika Kecamatan dipilih, isi pilihan Kelurahan sesuai
        if (RWTerpilih !== '') {
        	$.ajax({
		        url : "<?php echo site_url('tps/ajax_get_rt')?>/" + RWTerpilih,
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

    function isNumber(event) {
	  const charCode = (event.which) ? event.which : event.keyCode;
	  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
	    event.preventDefault();
	    return false;
	  }
	  return true;
	}
</script>

<!-- Bootstrap modal -->
<div class="modal" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <?php /*
                        <div class="form-group">
                            <label class="control-label col-md-3">Wilayah</label>
                            <div class="col-md-9">
                                <select id="kode_wilayah" name="kode_wilayah" class="form-control" >
						           <option>-- Pilih Wilayah --</option>
						           <?php
						           foreach($wilayah as $wil){
						             echo "<option value='".$wil['id']."'>".$wil['nama']."</option>";
						           }
						           ?>
						        </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        */ ?>
                        <div class="form-group">
                            <label class="control-label col-md-3">Kecamatan</label>
                            <div class="col-md-9">
                                <select id="id_kec" name="id_kec" class="form-control" >
						           <option value="">-- Pilih Kecamatan --</option>
						           <?php
						           foreach($kecamatan as $kec){
						             echo "<option value='".$kec['id_kec']."'>".$kec['nama_kec']."</option>";
						           }
						           ?>
						        </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Kelurahan</label>
                            <div class="col-md-9">
                                <select id="id_desa" name="id_desa" class="form-control" >
						           <option value="">-- Pilih Kelurahan --</option>
						           <?php
						           foreach($desa as $ds){
						             echo "<option value='".$ds['id_desa']."'>".$ds['nama_desa']."</option>";
						           }
						           ?>
						        </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">RW</label>
                            <div class="col-md-9">
                                <select id="id_rw" name="id_rw" class="form-control" >
						           <option value="">-- Pilih RW --</option>
						           <?php
						           foreach($rw as $r){
						             echo "<option value='".$r['id_rw']."'>".$r['nama_rw']."</option>";
						           }
						           ?>
						        </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">RT</label>
                            <div class="col-md-9">
                                <select id="id_rt" name="id_rt" class="form-control" >
						           <option value="">-- Pilih RT --</option>
						           <?php
						           foreach($rt as $t){
						             echo "<option value='".$t['id_rt']."'>".$t['nama_rt']."</option>";
						           }
						           ?>
						        </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama TPS</label>
                            <div class="col-md-9">
                                <input name="nama_tps" placeholder="Nama TPS" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Target TPS</label>
                            <div class="col-md-9">
                                <input name="target_tps" placeholder="Target TPS" class="form-control" type="text" onkeypress="return isNumber(event)">
                                <span class="help-block"></span>
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