<style type="text/css">
    .mySlides {display:none;}
    .w3-badge {cursor:pointer}
    .w3-badge {height:26px;width:26px;padding:0}
</style>
<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<!-- Default box -->
<div class="box">

    <div class="box-body">
        <div class="panel panel-primary">
            <div class="panel-body">
                <span class="pull-right">
                </span>
                <?php 
                echo '<h4 class="text-muted"><b>Rekapitulasi Hasil Pemilihan</b></h4>';
                ?>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <form id="form-filter" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kecamatan</label>
                        <div class="col-sm-4">
                            <select id="filter_id_kec" name="filter_id_kec" class="form-control" onchange="perbaruiPilihanKelurahan()">
                               <option value="">-- Pilih Kecamatan --</option>
                               <?php
                               foreach($kecamatan as $kec){
                                 echo "<option value='".$kec->id_kec."'>".$kec->nama_kec."</option>";
                               }
                               ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="group-kelurahan">
                        <label class="col-sm-2 control-label">Kelurahan</label>
                        <div class="col-sm-4">
                            <select id="filter_id_kel" name="filter_id_kel" class="form-control"  onchange="perbaruiPilihanRW()">
                               <option value="">-- Pilih Kelurahan --</option>
                               <?php
                               foreach($desa as $ds){
                                 echo "<option value='".$ds->id_desa."'>".$ds->nama_desa."</option>";
                               }
                               ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="group-rw">
                        <label class="col-sm-2 control-label">RW</label>
                        <div class="col-sm-4">
                            <select id="filter_id_rw" name="filter_id_rw" class="form-control"  onchange="perbaruiPilihanTPS()">
                               <option value="">-- Pilih RW --</option>
                               <?php
                               foreach($rw as $r){
                                 echo "<option value='".$r->id_rw."'>".$r->nama_rw."</option>";
                               }
                               ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="group-tps">
                        <label for="lbl_tps" class="col-sm-2 control-label">TPS</label>
                        <div class="col-sm-4">

                            <select id="filter_id_tps" name="filter_id_tps" class="form-control" >
                               <option value="">-- Pilih TPS --</option>
                               <?php
                               foreach($tps as $t){
                                 echo "<option value='".$t->id."'>".$t->nama_tps."</option>";
                               }
                               ?>
                            </select>
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
        <div class="row mySlides">
            <div class="col-md-12 text-center">
                <h3>Grafik Perolehan Suara</h3>
                <span id="title1"></span>
                <div>
                    <canvas id="canvassatu1" ></canvas>
                </div>
            </div>
    	</div>

        <div class="row mySlides">
            <div class="col-md-12 text-center">
                <h3>Grafik Perolehan Suara</h3>
                <span id="title2"></span>
                <div>
                    <canvas id="canvassatu2" ></canvas>
                </div>
            </div>
        </div>

        <div class="row mySlides">
            <div class="col-md-12 text-center">
                <h3>Grafik Perolehan Suara</h3>
                <span id="title3"></span>
                <div>
                    <canvas id="canvassatu3" ></canvas>
                </div>
            </div>
        </div>

        <div class="row mySlides">
            <div class="col-md-12 text-center">
                <h3>Grafik Perolehan Suara</h3>
                <span id="title4"></span>
                <div>
                    <canvas id="canvassatu4" ></canvas>
                </div>
            </div>
        </div>

        <div class="w3-center">
          <div class="w3-section">
            <button class="w3-button w3-light-grey" onclick="plusDivs(-1)">❮ Sebelumnya</button>
            <button class="w3-button w3-light-grey" onclick="plusDivs(1)">Selanjutnya ❯</button>
          </div>
          <button class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></button> 
          <button class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></button> 
          <button class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></button> 
          <button class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(4)"></button> 
        </div>
    </div><!-- /.box-body -->
    <div class="box-footer">
        &nbsp;
    </div><!-- /.box-footer-->
</div><!-- /.box -->


<!--Load chart js-->
<script type="text/javascript" src="<?php echo base_url().'assets/plugins/chartjs/Chart.min.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/plugins/chartjs/utils.js'?>"></script>
<script>

    let currN = 0;
    let currChart = '';
    const group = [];
    group[1] = "groupkecamatan";
    group[2] = "groupkelurahan";
    group[3] = "grouprw";
    group[4] = "grouptps";

    const title = [];
    title[1] = "Kecamatan";
    title[2] = "Kelurahan";
    title[3] = "RW";
    title[4] = "TPS";

    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
       showDivs(slideIndex += n);
    }

    function currentDiv(n) {
      showDivs(slideIndex = n);
    }


    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        if (n > x.length) {slideIndex = 1}
        if (n < 1) {slideIndex = x.length}
        for (i = 0; i < x.length; i++) {
          x[i].style.display = "none";  
        } 
        for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" w3-white", "");
        }
        x[slideIndex-1].style.display = "block";  
        dots[slideIndex-1].className += " w3-white";

        var color = Chart.helpers.color;
        var ctx = document.getElementById("canvassatu"+n).getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: '',// <?php // echo json_encode($merk);?>,
                datasets: [{
                    data: '',
                    },
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                legend: {
                    display: false // Menyembunyikan legend (termasuk label dataset)
                },
                

            }
        });
        $("#title"+n).html(title[n]);
        updateLabels(n, myChart);
    }
    
    // Function to generate random colors
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    function resetFilter() {
        $('#form-filter')[0].reset();
        updateLabels(currN, currChart);
    }
    function filterChart() {
        updateLabels(currN, currChart);
    }

    function updateLabels(n, myChart) {
        var selectedValue = group[n];


        var filterkel = document.getElementById("group-kelurahan");
        var filterrw = document.getElementById("group-rw");
        var filtertps = document.getElementById("group-tps");
        // Update the labels based on the selected filter group
        switch (selectedValue) {
            case "groupwilayah":
                var chrt = get_chart(selectedValue, function(data) {
                    // Handle the data
                    console.log("Data received:", data.label);
                    myChart.data.labels = data.label; // Replace with your labels
                    var dynamicColors = [];
                    for (var i = 0; i < data.label.length; i++) {
                        dynamicColors.push(getRandomColor());

                        myChart.data.datasets[0].backgroundColor = dynamicColors;
                        myChart.data.datasets[0].borderColor = dynamicColors;
                    }
                    myChart.data.datasets[0].data = data.data; // Replace with your data// Update the chart after setting the data
                    myChart.update();
                }, function(error) {
                    // Handle the error
                    console.error('Error:', error);
                });
                break;
            case "groupkecamatan":
                filterkel.style.display = "none";
                filterrw.style.display = "none";
                filtertps.style.display = "none";
                var chrt = get_chart(selectedValue, function(data) {
                    // Handle the data
                    console.log("Data received:", data.label);
                    myChart.data.labels = data.label; // Replace with your labels
                    var dynamicColors = [];
                    for (var i = 0; i < data.label.length; i++) {
                        dynamicColors.push(getRandomColor());

                        myChart.data.datasets[0].backgroundColor = dynamicColors;
                        myChart.data.datasets[0].borderColor = dynamicColors;
                    }
                    myChart.data.datasets[0].data = data.data; // Replace with your data// Update the chart after setting the data
                    myChart.update();
                }, function(error) {
                    // Handle the error
                    console.error('Error:', error);
                });
                break;
            case "groupkelurahan":
                filterkel.style.display = "";
                filterrw.style.display = "none";
                filtertps.style.display = "none";
                var chrt = get_chart(selectedValue, function(data) {
                    // Handle the data
                    console.log("Data received:", data.label);
                    myChart.data.labels = data.label; // Replace with your labels
                    var dynamicColors = [];
                    for (var i = 0; i < data.label.length; i++) {
                        dynamicColors.push(getRandomColor());

                        myChart.data.datasets[0].backgroundColor = dynamicColors;
                        myChart.data.datasets[0].borderColor = dynamicColors;
                    }
                    myChart.data.datasets[0].data = data.data; // Replace with your data// Update the chart after setting the data
                    myChart.update();
                }, function(error) {
                    // Handle the error
                    console.error('Error:', error);
                });
                break;
            case "grouprw":
                filterkel.style.display = "";
                filterrw.style.display = "";
                filtertps.style.display = "none";
                var chrt = get_chart(selectedValue, function(data) {
                    // Handle the data
                    console.log("Data received:", data.label);
                    myChart.data.labels = data.label; // Replace with your labels
                    var dynamicColors = [];
                    for (var i = 0; i < data.label.length; i++) {
                        dynamicColors.push(getRandomColor());

                        myChart.data.datasets[0].backgroundColor = dynamicColors;
                        myChart.data.datasets[0].borderColor = dynamicColors;
                    }
                    myChart.data.datasets[0].data = data.data; // Replace with your data// Update the chart after setting the data
                    myChart.update();
                }, function(error) {
                    // Handle the error
                    console.error('Error:', error);
                });
                break;
            case "grouptps":
                filterkel.style.display = "";
                filterrw.style.display = "";
                filtertps.style.display = "";
                var chrt = get_chart(selectedValue, function(data) {
                    // Handle the data
                    console.log("Data received:", data.label);
                    myChart.data.labels = data.label; // Replace with your labels
                    var dynamicColors = [];
                    for (var i = 0; i < data.label.length; i++) {
                        dynamicColors.push(getRandomColor());

                        myChart.data.datasets[0].backgroundColor = dynamicColors;
                        myChart.data.datasets[0].borderColor = dynamicColors;
                    }
                    myChart.data.datasets[0].data = data.data; // Replace with your data// Update the chart after setting the data
                    myChart.update();
                }, function(error) {
                    // Handle the error
                    console.error('Error:', error);
                });
                break;
        }

        // Update the chart with the new labels
        myChart.update();

        currN = n;
        currChart = myChart;
    }

    function get_chart(group, successCallback, errorCallback) {
        var groupchart = group;
        var filter_id_kec = document.getElementById('filter_id_kec');
        var filter_id_kel = document.getElementById('filter_id_kel');
        var filter_id_rw = document.getElementById('filter_id_rw');
        var filter_id_tps = document.getElementById('filter_id_tps');
        var formData = new FormData();
        if (filter_id_kec) {
            formData.append('filter_id_kec', filter_id_kec.value);
        }
        if (filter_id_kel) {
            formData.append('filter_id_kel', filter_id_kel.value);
        }
        if (filter_id_rw) {
            formData.append('filter_id_rw', filter_id_rw.value);
        }
        if (filter_id_tps) {
            formData.append('filter_id_tps', filter_id_tps.value);
        }
        formData.append('group', groupchart);
        var url = "<?php echo site_url('rekaphasil/get_chart')?>";
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {
                successCallback(data);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                errorCallback(errorThrown);
            }
        });
    }


    function perbaruiPilihanKelurahan() {
        var dropdownKecamatan = document.getElementById('filter_id_kec');
        var dropdownKelurahan = document.getElementById('filter_id_kel');
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
        var dropdownKelurahan = document.getElementById('filter_id_kel');
        var dropdownRW = document.getElementById('filter_id_rw');
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

    function perbaruiPilihanTPS() {
        var dropdownRW = document.getElementById('filter_id_rw');
        var dropdownTPS = document.getElementById('filter_id_tps');
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

    // Add an event listener to the dropdown to trigger the updateLabels() function
    var filterGroupDropdown = document.getElementById("btn-filter");
    filterGroupDropdown.addEventListener("click", filterChart);
    var filterReset = document.getElementById("btn-reset");
    filterReset.addEventListener("click", resetFilter);


</script>