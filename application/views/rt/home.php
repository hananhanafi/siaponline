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
                            <select id="filter_id_kec" name="filter_id_kec" class="form-control" <?php if ($this->session->userdata('id_kecamatan')) {
                            	echo "disabled";
                            } ?>>
    				           <option value="">-- Pilih Kecamatan --</option>
    				           <?php
    				           foreach($kecamatan as $kec){
    				           		if ($this->session->userdata('id_kecamatan') == $kec['id_kec']) {
		    				            echo "<option value='".$kec['id_kec']."' selected>".$kec['nama_kec']."</option>";
	                            	} else {
		    				            echo "<option value='".$kec['id_kec']."'>".$kec['nama_kec']."</option>";
	                            	}
    				           }
    				           ?>
    				        </select>
				        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kelurahan</label>
						<div class="col-sm-4">
                            <select id="filter_id_desa" name="filter_id_desa" class="form-control" <?php if ($this->session->userdata('id_desa')) {
	                            	echo "disabled";
	                            } ?>>
    				           <option value="">-- Pilih Kelurahan --</option>
    				           <?php
    				           foreach($desa as $ds){
    				           		if ($this->session->userdata('id_desa') == $ds['id_desa']) {
		     				             echo "<option value='".$ds['id_desa']."' selected>".$ds['nama_desa']."</option>";
		                           	} else {
		     				             echo "<option value='".$ds['id_desa']."'>".$ds['nama_desa']."</option>";
		                            	}
	    				           }
    				           ?>
    				        </select>
				        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">RW</label>
						<div class="col-sm-4">
                            <select id="filter_id_rw" name="filter_id_rw" class="form-control" <?php if ($this->session->userdata('id_rw')) {
	                            	echo "disabled";
	                            } ?>>
    				           <option value="">-- Pilih RW --</option>
    				           <?php
    				           foreach($rw as $w){
    				             	if ($this->session->userdata('id_rw') == $w['id_rw']) {
		     				             echo "<option value='".$w['id_rw']."' selected>".$w['nama_rw']."</option>";
		                           	} else {
	     				             echo "<option value='".$w['id_rw']."'>".$w['nama_rw']."</option>";
	                            	}
    				           
    				           }
    				           ?>
    				        </select>
				        </div>
                    </div>
					<div class="form-group">
						<label for="lbl_desa" class="col-sm-2 control-label">RT</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="filter_nama_rt" name="filter_nama_rt">
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
	        		echo '<h4 class="text-muted"><b>Data RW</b></h4>';
	        		?>
	        	</div>
	        	<div class="col-md-2 col-xs-12">
				<?php

					echo '<button class="btn btn-success btn-block" onclick="add_rt()"><i class="glyphicon glyphicon-plus"></i> Tambah</button>';

				?>
				</div>
				<div class="col-md-2 col-xs-12">
        			<button class="btn btn-default btn-block" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Muat Ulang</button>
        		</div>
        		<div class="col-md-2 col-xs-12">
        			<a href="<?php echo base_url('rT/export'); ?>" class="btn btn-danger btn-block"><i class="fa fa-file-excel-o"></i> Unduh Excel</a>
        		</div>
			</div>
		</div>
		<div class="table-responsive">

			<div class="col-md-12">
				<table id="table" class="table table-condensed table-bordere table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th width= "30px" >No</th>
							<th >Wilayah</th>
							<th >Kecamatan</th>
							<th >Desa</th>
							<th >RW</th>
							<th >RT</th>
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
				"url": "<?php echo site_url('rT/ajax_list')?>",
				"type": "POST",
				"data": function ( data ) {
					// data.kode_wilayah = $('#filter_kode_wilayah').val();
					data.id_kec = $('#filter_id_kec').val();
					data.id_desa = $('#filter_id_desa').val();
					data.id_rw = $('#filter_id_rw').val();
					data.nama_rt = $('#filter_nama_rt').val();
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


	    // Tambahkan event listener pada dropdown Kecamatan
	    document.getElementById('filter_id_kec').addEventListener('change', perbaruiPilihanKelurahan);

	    document.getElementById('id_kec').addEventListener('change', perbaruiInputKelurahan);

	    // Tambahkan event listener pada dropdown Kecamatan
	    document.getElementById('filter_id_desa').addEventListener('change', perbaruiPilihanRW);

	    document.getElementById('id_desa').addEventListener('change', perbaruiInputRW);


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

	function add_rt()
	{
	    save_method = 'add';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    $('#modal_form').modal('show'); // show bootstrap modal
	    $('.modal-title').text('Tambah Data'); // Set Title to Bootstrap modal title
	}

	function edit_rt(id)
	{
	    save_method = 'update';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string


	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo site_url('rT/ajax_edit')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
	        	
	            $('[name="id_rt"]').val(data.id_rt);
	            $('[name="id_rw"]').val(data.id_rw);
	            $('[name="id_kec"]').val(data.id_kec);
	            // $('[name="kode_wilayah"]').val(data.id_wilayah);
	            $('[name="nama_rt"]').val(data.nama_rt);
	            perbaruiInputKelurahan(data.id_desa);
	            perbaruiInputRW(data.id_rw, data.id_desa);
	            // $('[name="id_desa"]').val(data.id_desa);
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
	        url = "<?php echo site_url('rT/ajax_add')?>";
	    } else {
	        url = "<?php echo site_url('rT/ajax_update')?>";
	    }

	    // ajax adding data to database

	    var formData = new FormData($('#form')[0]);
	    // Iterate through disabled select elements
	    $('select:disabled', '#form').each(function(index, element) {
	        // Get the name and value of the disabled select
	        var selectName = $(element).attr('name');
	        var selectValue = $(element).val();
	        
	        // Append the select name and value to the FormData
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

	function delete_rt(id)
	{
		swal({
			title: "Anda yakin?",
			text: "Menghapus data RT akan menghapus semua data Pemilih di RT tersebut.",
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
					url : "<?php echo site_url('rT/ajax_delete')?>/"+id,
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
		        url : "<?php echo site_url('rT/ajax_get_kelurahan')?>/" + kecamatanTerpilih,
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
		        url : "<?php echo site_url('rT/ajax_getall_kelurahan')?>/",
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
		        url : "<?php echo site_url('rT/ajax_get_kelurahan')?>/" + kecamatanTerpilih,
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
		        url : "<?php echo site_url('rT/ajax_getall_kelurahan')?>/",
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
		        url : "<?php echo site_url('rT/ajax_get_rw')?>/" + kelurahanTerpilih,
		        type: "GET",
		        dataType: "JSON",
		        success: function(data)
		        {
		        	
		            var pilihanRW = data; // Gantikan dengan sumber data aktual Anda

		            console.log(pilihanRW.length);
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
		        url : "<?php echo site_url('rT/ajax_getall_rw')?>/",
		        type: "GET",
		        dataType: "JSON",
		        success: function(data)
		        {
		        	
		            var pilihanRW = data; // Gantikan dengan sumber data aktual Anda

		            console.log(pilihanRW.length);
		            for (var i = 0; i < pilihanRW.length; i++) {
		            	// console.log(pilihanKelurahan[i]);
		                var opsi = document.createElement('option');
		                opsi.value = pilihanRW[i].id_rw;
		                opsi.innerText = pilihanRW[i].nama_rw;
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
        if (id_desa_selected) {
    	    var kelurahanTerpilih = id_desa_selected;

        } else {
	        var kelurahanTerpilih = dropdownKelurahan.value;

        }
        console.log(kelurahanTerpilih);
        // Bersihkan pilihan sebelumnya
        dropdownRW.innerHTML = '<option value="">-- Pilih RW --</option>';

        // Jika Kecamatan dipilih, isi pilihan Kelurahan sesuai
        if (kelurahanTerpilih !== '') {
        	$.ajax({
		        url : "<?php echo site_url('rT/ajax_get_rw')?>/" + kelurahanTerpilih,
		        type: "GET",
		        dataType: "JSON",
		        success: function(data)
		        {
		        	
		            var pilihanRW = data; // Gantikan dengan sumber data aktual Anda

		            console.log(pilihanRW.length);
		            for (var i = 0; i < pilihanRW.length; i++) {
		            	// console.log(pilihanKelurahan[i]);
		                var opsi = document.createElement('option');
		                opsi.value = pilihanRW[i].id_rw;

			            console.log(pilihanRW[i].id_rw);
			            console.log(id_rw_selected);

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
		        url : "<?php echo site_url('rT/ajax_getall_rw')?>/",
		        type: "GET",
		        dataType: "JSON",
		        success: function(data)
		        {
		        	
		            var pilihanRW = data; // Gantikan dengan sumber data aktual Anda

		            console.log(pilihanRW.length);
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
        }
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
                    <input type="hidden" value="" name="id_rt"/> 
                    <div class="form-body">
                        <?php /*
                        <div class="form-group">
                            <label class="control-label col-md-3">Wilayah</label>
                            <div class="col-md-9">
                                <select id="kode_wilayah" name="kode_wilayah" class="form-control" >
						           <option value="">-- Pilih Wilayah --</option>
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
                                <select id="id_kec" name="id_kec" class="form-control" <?php if ($this->session->userdata('id_kecamatan')) {
		                            	echo "disabled";
		                            } ?>>
						           <option value="">-- Pilih Kecamatan --</option>
						           <?php
						           foreach($kecamatan as $kec){
	    				           		if ($this->session->userdata('id_kecamatan') == $kec['id_kec']) {
			    				            echo "<option value='".$kec['id_kec']."' selected>".$kec['nama_kec']."</option>";
		                            	} else {
			    				            echo "<option value='".$kec['id_kec']."'>".$kec['nama_kec']."</option>";
		                            	}
						           }
						           ?>
						        </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Kelurahan</label>
                            <div class="col-md-9">
                                <select id="id_desa" name="id_desa" class="form-control"  <?php if ($this->session->userdata('id_desa')) {
		                            	echo "disabled";
		                            } ?>>
						           <option value="">-- Pilih Kelurahan --</option>
						           <?php
						           foreach($desa as $ds){

	    				           		if ($this->session->userdata('id_desa') == $ds['id_desa']) {
			     				             echo "<option value='".$ds['id_desa']."' selected>".$ds['nama_desa']."</option>";
			                           	} else {
		     				             echo "<option value='".$ds['id_desa']."'>".$ds['nama_desa']."</option>";
		                            	}
	    				           }
						           ?>
						        </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">RW</label>
                            <div class="col-md-9">
                                <select id="id_rw" name="id_rw" class="form-control"  <?php if ($this->session->userdata('id_rw')) {
		                            	echo "disabled";
		                            } ?>>
						           <option value="">-- Pilih RW --</option>
						           <?php
						           foreach($rw as $w){
	    				             	if ($this->session->userdata('id_rw') == $w['id_rw']) {
			     				             echo "<option value='".$w['id_rw']."' selected>".$w['nama_rw']."</option>";
			                           	} else {
		     				             echo "<option value='".$w['id_rw']."'>".$w['nama_rw']."</option>";
		                            	}
						           }
						           ?>
						        </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">RT</label>
                            <div class="col-md-9">
                                <select id="nama_rt" name="nama_rt" class="form-control" >
						           <option value="">-- Pilih RT --</option>
						           <?php

						           for($i=1; $i <= 15; $i++){
						             echo "<option value='".$i."'>".$i."</option>";
						           }
						           ?>
						        </select>
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