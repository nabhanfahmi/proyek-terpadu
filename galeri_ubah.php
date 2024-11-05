<?php
$row = $db->get_row("SELECT * FROM galeri_tb WHERE id_galeri='$_GET[ID]'");
?>
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Ubah Gambar</h1>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-12 wow fadeIn" data-wow-delay="0.1s">
                <div class="bg-light rounded p-5">
                    <form method="post" action="?m=galeri_ubah&ID=<?= $row->id_galeri ?>" enctype="multipart/form-data">
                        <?php if ($_POST) include 'aksi.php' ?>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label>Nama Wisata <span class="text-danger">*</span></label>
                                <select class="form-control" name="id_wisata">
                                    <?= get_tempat_option($row->id_wisata) ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label>Gambar</label>
                                <input class="form-control" type="file" name="gambar" />
                                <p class="help-block">Kosongkan jika tidak mengubah gambar</p>
                                <img class="thumbnail" src="assets/images/galeri/small_<?= $row->gambar ?>" height="60" />
                            </div>
                            <div class="col-md-12">
                                <label>Nama Galeri</label>
                                <input class="form-control" type="text" name="nama_galeri" value="<?= $row->nama_galeri ?>" />
                            </div>
                            <div class="col-md-12">
                                <label>Keterangan</label>
                                <textarea class="mce" name="ket_galeri"><?= $row->ket_galeri ?></textarea>
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