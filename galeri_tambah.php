<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Upload Galeri</h1>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-12 wow fadeIn" data-wow-delay="0.1s">
                <div class="bg-light rounded p-5">
                    <form method="post" action="?m=galeri_tambah" enctype="multipart/form-data">
                        <?php if ($_POST) include 'aksi.php' ?>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label>Nama Wisata<span class="text-danger">*</span></label>
                                <? function get_tempat_option($id_wisata)
                                {
                                }
                                ?>
                                <select class="form-control" name="id_wisata" id="id_wisata">
                                    <?= get_tempat_option($_POST['id_wisata']) ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label>Gambar <span class="text-danger">*</span></label>
                                <input class="form-control" type="file" name="gambar" />
                            </div>
                            <div class="col-md-12">
                                <label>Nama Galeri</label>
                                <input class="form-control" type="text" name="nama_galeri" value="<?= isset($_POST['nama_galeri']) ? $_POST['nama_galeri'] : '' ?>" autocomplete="off" />
                            </div>
                            <div class="col-md-12">
                                <label>Keterangan</label>
                                <textarea class="mce" type="text" name="ket_galeri" value="<?= isset($_POST['ket_galeri']) ? $_POST['ket_galeri'] : '' ?>" autocomplete="off" /></textarea>
                            </div>
                            <div style="text-align: right;">
                                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                                <a class="btn btn-danger" href="?m=galeri"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>