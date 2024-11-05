<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown">List Daftar Wisata</h1>
    </div>
</div>
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-12 wow fadeIn" data-wow-delay="0.1s">
                <div class="bg-light rounded p-5">
                    <form>
                        <input type="hidden" name="m" value="tempat" />
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?= $_GET['q'] ?>" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-refresh"></span> Reload</button>
                                    <a class="btn btn-primary" href="?m=tempat_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="bg-primary text-white">
                                        <tr class="nw">
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama Wisata</th>
                                            <th>Lat</th>
                                            <th>Lng</th>
                                            <th>Kategori</th>
                                            <th>Lokasi</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $q = esc_field($_GET['q']);

                                    $sql = "SELECT * 
            FROM wisata_tb p
            WHERE nama_wisata LIKE '%$q%' 
            ORDER BY id_wisata";
                                    $rows = $db->get_results($sql);

                                    foreach ($rows as $row) : ?>
                                        <tr>
                                            <td><?= ++$no ?></td>
                                            <td><img class="thumbnail" height="60" src="assets/images/tempat/small_<?= $row->gambar ?>" /></td>
                                            <td><?= $row->nama_wisata ?></td>
                                            <td><?= $row->lat ?></td>
                                            <td><?= $row->lng ?></td>
                                            <td><?= $row->kategori ?></td>
                                            <td><?= $row->lokasi ?></td>
                                            <td class="nw">
                                                <a class="btn btn-xs btn-warning mb-1 text-white" href="?m=tempat_ubah&ID=<?= $row->id_wisata ?>">Edit</a>
                                                <a class="btn btn-xs btn-danger" href="aksi.php?act=tempat_hapus&ID=<?= $row->id_wisata ?>" onclick="return confirm('Hapus data?')">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach;    ?>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>