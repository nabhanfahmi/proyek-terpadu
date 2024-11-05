    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Galeri Wisata</h1>
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
                                        <a class="btn btn-primary" href="?m=galeri_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
                                    </div>
                                </div>
                        </form>
                        <div class="oxa">
                            <table class="table table-bordered table-hover table-striped">
                                <thead class="bg-primary text-white">
                                    <tr class="nw">
                                        <th>No</th>
                                        <th>Nama Wisata</th>
                                        <th>Gambar</th>
                                        <th>Nama Galeri</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <?php
                                $q = esc_field($_GET['q']);
                                $pg = new Paging();
                                $limit = 25;
                                $offset = $pg->get_offset($limit, $_GET['page']);

                                $rows = $db->get_results("SELECT g.*, t.nama_wisata 
            FROM galeri_tb g INNER JOIN wisata_tb t ON t.id_wisata=g.id_wisata
            WHERE nama_wisata LIKE '%$q%' ORDER BY nama_wisata LIMIT $offset, $limit");

                                $no = $offset;

                                $jumrec = $db->get_var("SELECT COUNT(*) 
            FROM galeri_tb g INNER JOIN wisata_tb t ON t.id_wisata=g.id_wisata 
            WHERE nama_wisata LIKE '%$q%'");

                                foreach ($rows as $row) :
                                ?>
                                    <tr>
                                        <td><?= ++$no ?></td>
                                        <td><?= $row->nama_wisata ?></td>
                                        <td><img class="thumbnail" src="assets/images/galeri/small_<?= $row->gambar ?>" height="60" /></td>
                                        <td><?= $row->nama_galeri ?></td>
                                        <td class="nw">
                                            <a class="btn btn-xs btn-warning text-white " href="?m=galeri_ubah&ID=<?= $row->id_galeri ?>">Edit</a>
                                            <a class="btn btn-xs btn-danger" href="aksi.php?act=galeri_hapus&ID=<?= $row->id_galeri ?>" onclick="return confirm('Hapus data?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach;    ?>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <ul class="pagination"><?= $pg->show("m=galeri&q=$_GET[q]&page=", $jumrec, $limit, $_GET['page']) ?></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>