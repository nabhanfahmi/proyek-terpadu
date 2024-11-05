<?php
$row = $db->get_row("SELECT * FROM wisata_tb WHERE id_wisata='$_GET[ID]'");
?>
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {
        opacity: 0.7;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content,
    #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {
        .modal-content {
            width: 100%;
        }
    }
</style>
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown"><?= $row->nama_wisata ?></h1>
    </div>
</div>
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                <div class="bg-light rounded p-5">
                    <h3>Lokasi: <?= $row->lokasi ?></h3>
                    <?= $row->keterangan ?>
                </div>
            </div>
            <div class="col-lg-8 wow fadeIn" data-wow-delay="0.5s">
                <div class="h-100">
                    <p>
                        <a href="?m=tempat_list" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-chevron-left"></span> Lihat semua tempat</a>
                        <a href="javascript:void(0)" onclick="showRoute()" class="btn btn-info btn-sm"> <span class="glyphicon glyphicon-search"></span> Tampilkan Rute </a>
                        <a href="?m=detail&ID=<?= $_GET['ID'] ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-list"></span> Rute Detail</a>
                    </p>
                    <div id="map" style="height: 500px;"></div>
                    <h3>Galeri</h3>
                    <div class="row">
                        <?php
                        $rows = $db->get_results("SELECT * FROM galeri_tb WHERE id_wisata='$_GET[ID]'");
                        foreach ($rows as $r) : ?>
                            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                <img id="myImg" src="assets/images/galeri/small_<?= $r->gambar ?>" alt="<?= strip_tags($r->ket_galeri) ?>" style="width:100%;max-width:300px">

                                <!-- The Modal -->
                                <div id="myModal" class="modal">
                                    <span class="close">&times;</span>
                                    <img class="modal-content" id="img01">
                                    <div id="caption"></div>
                                </div>

                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="image-gallery-title"></h4>
            </div>
            <div class="modal-body">
                <img id="image-gallery-image" class="img-responsive" src="">
            </div>
            <div class="modal-footer">

                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" id="show-previous-image">Previous</button>
                </div>

                <div class="col-md-8 text-justify" id="image-gallery-caption">
                    This text will be overwritten by jQuery
                </div>

                <div class="col-md-2">
                    <button type="button" id="show-next-image" class="btn btn-default">Next</button>
                </div>
            </div>
        </div>
    </div>
</div> -->
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function() {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }
</script>
<script>
    var origin_pos = {
        lat: default_lat,
        lng: default_lng
    };
    var dst_pos = {
        lat: <?= $row->lat ?>,
        lng: <?= $row->lng ?>
    };
    var errorRoute = false;
    var map_detail;
    var dragged = false;
    var directionsDisplay;
    var routeDisplayed = 0;

    //menampilkan map detail
    function tampilDetail() {


        map_detail = new google.maps.Map(document.getElementById('map'), {
            zoom: default_zoom,
            center: dst_pos
        });

        directionsDisplay = new google.maps.DirectionsRenderer({
            map: map_detail
        });

        addMarker(dst_pos, map_detail, '<?= $row->nama_wisata ?>');

        infoWindow = new google.maps.InfoWindow;

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };


                origin_pos = pos;

                infoWindow.setPosition(pos);
                infoWindow.setContent('Lokasi anda');
                infoWindow.open(map_detail);
                map_detail.setCenter(pos);
            }, function() {
                handleLocationError(true, infoWindow, map_detail.getCenter());
            });
        } else {
            handleLocationError(false, infoWindow, map_detail.getCenter());
        }
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
    }

    //menampilkan rute lokasi
    function showRoute() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        directionsDisplay.setMap(map_detail);
        calculateAndDisplayRoute(directionsService, directionsDisplay);
        console.log('Route displayed ' + ++routeDisplayed);
    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        directionsService.route({
            origin: origin_pos,
            destination: dst_pos,
            travelMode: 'DRIVING'
        }, function(response, status) {
            if (status === 'OK') {
                directionsDisplay.setDirections(response);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    }

    $(function() {
        tampilDetail();
    })

    $(document).ready(function() {

        loadGallery(true, 'a.thumbnail');

        //This function disables buttons when needed
        function disableButtons(counter_max, counter_current) {
            $('#show-previous-image, #show-next-image').show();
            if (counter_max == counter_current) {
                $('#show-next-image').hide();
            } else if (counter_current == 1) {
                $('#show-previous-image').hide();
            }
        }

        /**
         *
         * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
         * @param setClickAttr  Sets the attribute for the click handler.
         */

        function loadGallery(setIDs, setClickAttr) {
            var current_image,
                selector,
                counter = 0;

            $('#show-next-image, #show-previous-image').click(function() {
                if ($(this).attr('id') == 'show-previous-image') {
                    current_image--;
                } else {
                    current_image++;
                }

                selector = $('[data-image-id="' + current_image + '"]');
                updateGallery(selector);
            });

            function updateGallery(selector) {
                var $sel = selector;
                current_image = $sel.data('image-id');
                $('#image-gallery-caption').text($sel.data('caption'));
                $('#image-gallery-title').text($sel.data('title'));
                $('#image-gallery-image').attr('src', $sel.data('image'));
                disableButtons(counter, $sel.data('image-id'));
            }

            if (setIDs == true) {
                $('[data-image-id]').each(function() {
                    counter++;
                    $(this).attr('data-image-id', counter);
                });
            }
            $(setClickAttr).on('click', function() {
                updateGallery($(this));
            });
        }
    });
</script>