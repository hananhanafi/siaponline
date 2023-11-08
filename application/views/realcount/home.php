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
			            <div class="col-sm-3">
			                <input type="date" class="form-control" id="filter_from" name="filter_from">
			            </div>
			            <div class="col-sm-3">
			                <input type="date" class="form-control" id="filter_to" name="filter_to">
			            </div>
			        </div>
			        
			        <div class="form-group">
			            <div class="col-sm-2">
			                <a id="btn-export" class="btn btn-block btn-danger" ><i class="fa fa-file-excel-o"></i> Unduh Excel</a>
			            </div>
			        </div>
			     <!-- 

					<div class="form-group">
						<label for="nama_desa" class="col-sm-2 control-label">Nama Saksi</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="filter_nama_slider" name="filter_nama_slider">
						</div>
					</div>

					<div class="form-group">
						<label for="LastName" class="col-sm-2 control-label"></label>
						<div class="col-sm-4">
							<button type="button" id="btn-filter" class="btn btn-primary">Cari</button>
							<button type="button" id="btn-reset" class="btn btn-default">Batal</button>
					</div> -->

				</form>
			</div> <!-- panel-body -->
		</div> <!-- panel -->
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="col-md-8 col-xs-12">
					<?php 
	        		echo '<h4 class="text-muted"><b>Data Hasil Pemilih</b></h4>';
	        		?>
	        	</div>
	        	<div class="col-md-2 col-xs-12">
				<?php
					echo '<button class="btn btn-success btn-block" onclick="add_realcount()"><i class="glyphicon glyphicon-plus"></i> Tambah</button>';

				?>
				</div>
				<div class="col-md-2 col-xs-12">
        			<button class="btn btn-default btn-block" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Muat Ulang</button>
        		</div>
			</div>
		</div>
		<div class="table-responsive">

			<div class="col-md-12">
				<table id="table" class="table table-condensed table-bordere table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th width= "30px">No</th>
							<th >Foto Plano </th>
							<th >Foto Dokumen C1 </th>
							<th >RT </th>
							<th >TPS </th>
							<th >Jumlah Suara</th>
            				<th style="width:80px;">Aksi</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
						<tr>
							<th colspan="7"></th>
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

		$('#foto_plano').change(function() {
			readImage(this, 'foto_plano_preview');
		});

		$('#fotoc1').change(function() {
			readImage(this, 'fotoc1_preview');
		});
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
			"url": "<?php echo site_url('realcount/ajax_list')?>",
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

	// btn filter
	$('#btn-filter').click(function(){ //button filter event click
		table.ajax.reload();  //just reload table
	});

	$('#btn-reset').click(function(){ //button reset event click
		$('#form-filter')[0].reset();
		table.ajax.reload();  //just reload table
	});

	});	

	function clearForm() {
        // Clear the file inputs
        $('#foto_plano').val(null);
        $('#fotoc1').val(null);

        // Hide the image previews
        $('#foto_plano_preview').hide();
        $('#fotoc1_preview').hide();

        // Clear other form fields
        $('#nama_rw').val('');
        $('#nama_tps').val('');
        $('#jumlah_suara').val('');
    }
	function readImage(input, previewId) {
		const previewElement = $(`#${previewId}`);
		previewElement.hide();

		if (input.files && input.files[0]) {
		const reader = new FileReader();

		reader.onload = function(e) {
			previewElement.attr('src', e.target.result);
			previewElement.show();
		}

		reader.readAsDataURL(input.files[0]);
		}
	}
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

	function add_realcount()
	{
	    save_method = 'add';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    $('#modal_form').modal('show'); // show bootstrap modal
	    $('.modal-title').text('Tambah Data'); // Set Title to Bootstrap modal title
	}

	function edit_realcount(id)
	{
	    save_method = 'update';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string


	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo site_url('realcount/ajax_edit')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
	        	
	            $('[name="id_realcount"]').val(data.id_realcount);
	            $('[name="nama_foto"]').val(data.nama_slider);
	            $('[name="status"]').val(data.status);
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
	        url = "<?php echo site_url('realcount/ajax_add')?>";
	    } else {
	        url = "<?php echo site_url('realcount/ajax_update')?>";
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
	

	function delete_realcount(id)
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
					url : "<?php echo site_url('realcount/ajax_delete')?>/"+id,
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

</script>

<!-- Bootstrap modal -->
<div class="modal" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Form Foto</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" value="" name="id_slider"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Foto Plano</label>
                            <div class="col-md-9">
                                <input id="foto_plano" name="foto_plano" class="form-control" type="file" accept="image/*">
                                <span class="help-block"></span>
                            </div>
                        </div>
						<div class="form-group">
							<label class="control-label col-md-3"></label>
							<div class="col-md-9">
								<img id="foto_plano_preview" src="#" alt="Preview" width="50%" style="display: none;" />
							</div>
						</div>
						<div class="form-group">
                            <label class="control-label col-md-3">Foto C1</label>
                            <div class="col-md-9">
                                <input id="fotoc1" name="fotoc1" class="form-control" type="file" accept="image/*">
                                <span class="help-block"></span>
                            </div>
                        </div>
						<div class="form-group">
							<label class="control-label col-md-3"></label>
							<div class="col-md-9">
								<img id="fotoc1_preview" src="#" alt="Preview" width="50%" style="display: none;"/>
							</div>
						</div>
                        <div class="form-group">
                            <label class="control-label col-md-3">RT</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_rt" id="nama_rw" class="form-control">
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="control-label col-md-3">TPS</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_tps" id="nama_tps" class="form-control">
                            </div>
                        </div>
                    
						<div class="form-group">
							<label class="control-label col-md-3">Jumlah Suara</label>
							<div class="col-sm-9">
								<input type="number" name="jumlah_suara" id="jumlah_suara" class="form-control">
							</div>
						</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="clearForm()">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->