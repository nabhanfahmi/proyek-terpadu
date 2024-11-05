<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-1 text-white mb-3 animated slideInDown">Titik Lokasi Wisata</h1>
    </div>
</div>
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                <div class="bg-light rounded p-5">
                    <form class="form-inline" id="filter-form" action="" method="post">
                        <div class="form-group">
                            <label class="checkbox-inline" for="kategori_wisata">
                                <input type="checkbox" id="kategori_Curug" name="kategori[]" value="Curug"> Curug
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline" for="kategori_wisata">
                                <input type="checkbox" id="kategori_Pantai" name="kategori[]" value="Pantai"> Pantai
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline" for="kategori_wisata">
                                <input type="checkbox" id="kategori_Pegunungan" name="kategori[]" value="Pegunungan"> Pegunungan
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline" for="kategori_semua">
                                <input type="checkbox" id="kategori_semua" name="kategori[]" value="semua"> Tampilkan Semua
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="h-100">
                    <div id="map" style="height: 500px; margin-top: 20px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .checkbox-inline {
        margin-right: 10px;
        /* Sesuaikan jarak antar checkbox */
    }

    .info-window-image {
        max-width: 200px;
        height: auto;
    }

    .info-window-content {
        text-align: center;
    }
</style>
<script>
    var map_dekat;
    var markers = [];
    var currentInfowindow;
    var filterUsed = false;

    function inisialisasiPeta() {
        getCurLocation();

        map_dekat = new google.maps.Map(document.getElementById('map'), {
            zoom: <?= get_option('default_zoom') ?>,
            center: {
                lat: default_lat,
                lng: default_lng
            }
        });
    }

    function tampilkanMarker() {
        if (!filterUsed) {
            // Hanya tampilkan marker jika filter sudah digunakan
            return;
        }

        var data = <?= json_encode($db->get_results("SELECT * FROM wisata_tb")) ?>;
        var selectedKategori = [];
        var checkboxes = document.querySelectorAll('input[name="kategori[]"]:checked');
        for (var i = 0; i < checkboxes.length; i++) {
            selectedKategori.push(checkboxes[i].value);
        }

        if (selectedKategori.length === 0) {
            // Jika tidak ada filter yang dipilih, hapus semua marker
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            return;
        }

        var bounds = new google.maps.LatLngBounds();

        $.each(data, function(k, v) {
            if (selectedKategori.includes('semua') || selectedKategori.includes(v.kategori)) {
                var pos = {
                    lat: parseFloat(v.lat),
                    lng: parseFloat(v.lng)
                };

                var imageElement = '<img src="assets/images/tempat/small_' + v.gambar + '" class="info-window-image" />';

                var contentString = '<div class="info-window-content">' +
                    '<div>' + imageElement + '</div>' +
                    '<h3>' + v.nama_wisata + '</h3>' +
                    '<p><a href="?m=tempat_detail&ID=' + v.id_wisata + '" class="link_detail btn btn-primary">Lihat Detail</a></p>' +
                    '</div>';

                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                var icon = 'https://maps.google.com/mapfiles/ms/icons/green-dot.png'; // Ganti URL dengan ikon hijau

                var marker = new google.maps.Marker({
                    position: pos,
                    map: map_dekat,
                    animation: google.maps.Animation.DROP,
                    icon: icon
                });

                marker.addListener('click', function() {
                    if (currentInfowindow) {
                        currentInfowindow.close();
                    }
                    infowindow.open(map_dekat, marker);
                    currentInfowindow = infowindow;
                });

                markers.push(marker);
                bounds.extend(pos);
            }
        });

        map_dekat.fitBounds(bounds);
    }

    function getMarkerIcon(kategori) {
        var icon = '';

        switch (kategori) {
            case 'Curug':
                icon = 'https://maps.google.com/mapfiles/ms/icons/green-dot.png';
                break;
            case 'Pantai':
                icon = 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png';
                break;
            case 'pegunungan':
                icon = 'https://maps.google.com/mapfiles/ms/icons/yellow-dot.png';
                break;
            // case 'Perkebunan':
            //     icon = 'https://maps.google.com/mapfiles/ms/icons/purple-dot.png';
            //     break;
            // case 'Arung jeram':
            //     icon = 'https://maps.google.com/mapfiles/ms/icons/pink-dot.png';
                break;
            default:
                icon = 'https://maps.google.com/mapfiles/ms/icons/red-dot.png';
        }

        return icon;
    }

    $(document).ready(function() {
        inisialisasiPeta(); // Inisialisasi peta saat halaman dimuat pertama kali

        $('#filter-form').submit(function(e) {
            e.preventDefault();
            filterUsed = true; // Set filterUsed ke true saat filter digunakan
            // Hapus marker sebelum menampilkan yang baru
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            tampilkanMarker();
        });
    });
</script>