<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="<?php echo base_url('assets/select2/select2.min.css'); ?>" rel="stylesheet" />
    
    <script type="text/javascript" language="javascript" src="<?php echo base_url('assets/jquery-1.11.3.js'); ?>"></script>
    <script src="<?php echo base_url('assets/select2/select2.min.js'); ?>"></script>

    <script>
        function removeOptions(selectbox){
            var i;
            for(i = selectbox.options.length - 1 ; i >= 0 ; i--)
            {
                selectbox.remove(i);
            }
        }
    </script>
</head>
<body>

    <!-- Provinsi -->
    <div align="center">
        <?php echo form_label('Provinsi', 'provinsi') ?>
        <div>
            <?php
                $atribut_Prov = 'class="dropProv" style="width:300 px"';
                echo form_dropdown('Provinsi', $namaProvinsi, '', $atribut_Prov);
            ?>
        </div>
        <script>
            $(document).ready(function () {
                $(".dropProv").select2({
                    placeholder: "Pilih Provinsi"
                });
            });
        </script>
    </div>
    
    <!-- Kota -->
    <div align="center">        
        <?php echo form_label('Kota / Kabupaten', 'kota') ?>
        <div>
           <?php
                $atribut_kota = 'class="dropKota" id="kotaid" style="width:300 px"';
                echo form_dropdown('Kota', $namaKota, '', $atribut_kota);
            ?>
        </div>
        <script>
            $(document).ready(function () {
                $(".dropKota").select2({
                    placeholder: "Pilih Kota"
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $(".dropProv").on("change", function(){
                    var idProv = $(this).val();
                    var baseUrl = '<?php echo base_url(); ?>daerah/ajax_get_kota/'+idProv;
                    var kota = [];
                    removeOptions(document.getElementById("kotaid"));
                    $.ajax({
                        url: baseUrl,
                        dataType: 'json',
                        success: function(datas){
                            var kota = $.map(datas, function (obj) {
                                obj.id = obj.id || obj.id_kab;
                                obj.text = obj.text || obj.nama;
                                return obj;
                            });
                            $(".dropKota").select2({
                                placeholder: "Pilih Kota",
                                data: kota
                            });
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert("error");
                        }
                    });
                });
            });
        </script>
    </div>

    <!-- Kecamatan -->
    <div align="center">        
        <?php echo form_label('Kecamatan', 'kecamatan')?>
        <div>
            <?php
                $atribut_kecamatan = 'class="dropKecamatan" id="kecid" style="width:300 px"';
                echo form_dropdown('Kecamatan', $namaKecamatan, '', $atribut_kecamatan);
            ?>
        </div>

        <script>
            $(document).ready(function () {
                $(".dropKecamatan").select2({
                    placeholder: "Pilih Kecamatan"
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                $(".dropKota").on("change", function(){
                    var idKota = $(this).val();
                    var baseUrl = '<?php echo base_url(); ?>daerah/ajax_get_kec/'+idKota;
                    var kec = [];
                    removeOptions(document.getElementById("kecid"));
                    console.log(idKota);
                    $.ajax({
                        url: baseUrl,
                        dataType: 'json',
                        success: function(datas){
                            console.log(datas);
                            var kec = $.map(datas, function (obj) {
                                obj.id = obj.id || obj.id_kec; // replace pk with your identifier
                                obj.text = obj.text || obj.nama
                                return obj;
                            });
                            $(".dropKecamatan").select2({
                                placeholder: "Pilih Kecamatan",
                                data: kec
                            });
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert("error");
                        }
                    });
                });
            });
        </script>
    </div>
</body>
</html>