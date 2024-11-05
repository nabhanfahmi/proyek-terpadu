<?php
$row = $db->get_row("SELECT * FROM wisata_tb WHERE id_wisata='$_GET[ID]'");
?>
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Ubah Wisata</h1>
    </div>
</div>
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="bg-light rounded p-5">
                    <form method="post" action="?m=tempat_ubah&ID=<?= $row->id_wisata ?>" enctype="multipart/form-data">
                        <?php if ($_POST) include 'aksi.php' ?>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="name" class="mb-2">Nama Wisata</label>
                                <input class="form-control" type="text" name="nama_wisata" value="<?= $row->nama_wisata ?>" autocomplete="off" />
                            </div>
                            <div class="col-md-12">
                                <label>Gambar <span class="text-danger">*</span></label>
                                <input class="form-control" type="file" name="gambar" />
                                <p class="help-block">Kosongkan jika tidak mengubah gambar</p>
                                <img class="thumbnail" src="assets/images/tempat/small_<?= $row->gambar ?>" height="60" />
                            </div>
                            <div class="col-md-12">
                                <label>Latitude <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="lat" name="lat" value="<?= $row->lat ?>" />
                            </div>
                            <div class="col-md-12">
                                <label>Longitude <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="lng" name="lng" value="<?= $row->lng ?>" />
                            </div>
                            <div class="col-md-12">
                                <label>Kategori <span class="text-danger">*</span></label>
                                <select class="form-control" name="kategori">
                                    <option value="">Pilih Kategori</option>
                                    <option value="Curug">Curug</option>
                                    <option value="Pantai">Pantai</option>
                                    <option value="Pegunungan">Pegunungan</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label>Lokasi <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="lokasi" value="<?= $row->lokasi ?>" autocomplete="off" />
                            </div>
                            <div class="col-md-12]">
                                <label>Keterangan</label>
                                <textarea class="mce" style="height: 100px" name="keterangan"><?= $row->keterangan ?></textarea>
                            </div>
                            <div style="text-align: right;">
                                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                                <a class="btn btn-danger" href="?m=tempat"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="h-100">
                    <div id="map" style="height: 850px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var defaultCenter = {
        lat: <?= $row->lat * 1 ?>,
        lng: <?= $row->lng * 1 ?>
    };

    function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: <?= get_option('default_zoom') ?>,
            center: defaultCenter
        });

        var marker = new google.maps.Marker({
            position: defaultCenter,
            map: map,
            title: 'Click to zoom',
            draggable: true
        });


        marker.addListener('drag', handleEvent);
        marker.addListener('dragend', handleEvent);

        var infowindow = new google.maps.InfoWindow({
            content: '<h4>Drag untuk pindah lokasi</h4>'
        });

        infowindow.open(map, marker);
    }

    function handleEvent(event) {
        document.getElementById('lat').value = event.latLng.lat();
        document.getElementById('lng').value = event.latLng.lng();
    }

    $(function() {
        initMap();
    })
</script>