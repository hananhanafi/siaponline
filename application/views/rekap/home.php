<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<!-- Default box -->
<div class="box">

    <div class="box-body">
        <div class="col-md-12">
            <center>
                <h3>Pencapaian Target</h3>
            <br />
            <br />
            
            <div class="table-responsive">
                <div class="col-md-12">
                    <table class="table table-hover table-condensed" id="table">

                        <thead>
                            <tr>
                                <th class="text-center bg-blue" style="width: 10%">No</th>
                                <th class="text-center bg-blue" style="width: 10%">Nama</th>
                                <th class="text-center bg-blue" style="width: 10%">Peran</th>
                                <th class="text-center bg-blue" style="width: 10%">Kecamatan</th>
                                <th class="text-center bg-blue" style="width: 10%">Kelurahan</th>
                                <th class="text-center bg-blue" style="width: 10%">RW</th>
                                <th class="text-center bg-blue" style="width: 10%">RT</th>
                                <th class="text-center bg-blue" style="width: 10%">TPS</th>
                                <th class="text-center bg-blue" style="width: 10%">Progres</th>
                                <th class="text-center bg-blue" style="width: 10%">%</th>
                                <?php
                                    if($this->session->userdata('id_role') == 1){
                                ?>
                                <th class="text-center bg-blue" style="width: 10%">Action</th>
                                <?php
                                    }
                                ?>
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
                                <?php
                                    if($this->session->userdata('id_role') == 1){
                                ?>
                                <th></th>
                                <?php
                                    }
                                ?>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            </center>
        </div>
    	</div>
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
                <h3 class="modal-title"> Form Target </h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                    <input type="hidden" value="" name="id"/> 

                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama</label>
                            <div class="col-md-9">

                                <input name="nama" class="form-control" type="text" disabled="">
                                <span class="help-block"></span>

                            </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Peran</label>
                            <div class="col-md-9">
                                <input name="role" class="form-control" type="text" disabled="">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Kecamatan</label>
                            <div class="col-sm-9">
                                <input name="kecamatan" class="form-control" type="text" disabled="">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Kelurahan</label>
                            <div class="col-sm-9">
                                <input name="kelurahan" class="form-control" type="text" disabled="">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">RW</label>
                            <div class="col-sm-9">
                                <input name="rw" class="form-control" type="text" disabled="">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">RT</label>
                            <div class="col-sm-9">
                                <input name="rt" class="form-control" type="text" disabled="">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">TPS</label>
                            <div class="col-sm-9">
                                <input name="tps_target" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="control-label col-md-3">Target</label>
                            <div class="col-sm-9">
                                <input type="number" name="target" id="target" class="form-control">
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

<!--Load chart js-->
<script type="text/javascript" src="<?php echo base_url().'assets/plugins/chartjs/Chart.min.js'?>"></script>
<script>
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
            "url": base_url+"rekap/ajax_list",
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


function edit_target(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('rekap/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id_target);
            $('[name="nama"]').val(data.first_name);
            $('[name="role"]').val(data.name);
            $('[name="kecamatan"]').val(data.nama_kec);
            $('[name="kelurahan"]').val(data.nama_desa);
            $('[name="rw"]').val(data.nama_rw);
            $('[name="rt"]').val(data.id_rt);
            $('[name="tps_target"]').val(data.tps_target);
            $('[name="target"]').val(data.target);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Target'); // Set title to Bootstrap modal title


            
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

    url = "<?php echo site_url('rekap/ajax_update')?>";

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



</script>