<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Tambah Data Wisata</h1>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="bg-light rounded p-5">
                    <form method="post" action="?m=tempat_tambah" enctype="multipart/form-data">
                        <?php if ($_POST) include 'aksi.php'; ?>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="name" class="mb-2">Nama Wisata</label>
                                <input class="form-control" type="text" name="nama_wisata" value="<?= isset($_POST['nama_wisata']) ? $_POST['nama_wisata'] : ''; ?>" autocomplete="off" />
                            </div>
                            <div class="col-md-12">
                                <label>Gambar <span class="text-danger">*</span></label>
                                <input class="form-control" type="file" name="gambar" />
                            </div>
                            <div class="col-md-12">
                                <label>Latitude <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="lat" id="lat" value="<?= isset($_POST['lat']) ? $_POST['lat'] : ''; ?>" />
                            </div>
                            <div class="col-md-12">
                                <label>Longitude <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="lng" name="lng" value="<?= isset($_POST['lng']) ? $_POST['lng'] : ''; ?>" />
                            </div>
                            <div class="col-md-12">
                                <label>Kategori <span class="text-danger">*</span></label>
                                <select class="form-control" id="kategori" name="kategori">
                                    <option selected disabled>Pilih Kategori...</option>
                                    <option value="Curug">Curug</option>
                                    <option value="Pantai">Pantai</option>
                                    <option value="Pegunungan">Pegunungan</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label>Lokasi <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="lokasi" value="<?= isset($_POST['lokasi']) ? $_POST['lokasi'] : ''; ?>" autocomplete="off" />
                            </div>
                            <div class="col-md-12">
                                <label>Keterangan</label>
                                <textarea class="mce" style="height: 100px" name="keterangan"><?= isset($_POST['keterangan']) ? $_POST['keterangan'] : ''; ?></textarea>
                            </div>
                            <div style="text-align: right;">
                                <button class="btn btn-primary "><span class="glyphicon glyphicon-save"></span> Simpan</button>
                                <a class="btn btn-danger" href="?m=tempat"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="h-100">
                    <div id="map" style="height: 755px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var defaultCenter = {
        lat: 1.6647,
        lng: 125.0361
    };

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
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
    });
</script>