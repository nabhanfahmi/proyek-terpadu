<?php
require_once 'functions.php';

/** LOGIN */
if ($mod == 'login') {
    $user = esc_field($_POST['user']);
    $pass = esc_field($_POST['pass']);

    $row = $db->get_row("SELECT * FROM user_tb WHERE user='$user' AND pass='$pass'");
    if ($row) {
        $_SESSION['login'] = $row->user;
        redirect_js("index.php");
    } else {
        print_msg("Salah kombinasi username dan password.");
    }
} elseif ($mod == 'password') {
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $pass3 = $_POST['pass3'];

    $row = $db->get_row("SELECT * FROM user_tb WHERE user='$_SESSION[user]' AND pass='$pass1'");

    if ($pass1 == '' || $pass2 == '' || $pass3 == '')
        print_msg('Field bertanda * harus diisi.');
    elseif (!$row)
        print_msg('Password lama salah.');
    elseif ($pass2 != $pass3)
        print_msg('Password baru dan konfirmasi password baru tidak sama.');
    else {
        $db->query("UPDATE user_tb SET pass='$pass2' WHERE user='$_SESSION[user]'");
        print_msg('Password berhasil diubah.', 'success');
    }
} elseif ($act == 'logout') {
    unset($_SESSION['login']);
    header("location:index.php?m=login");
}

/** PAGE */
elseif ($mod == 'page_ubah') {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];

    if ($judul == '' || $isi == '')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_page SET judul='$judul', isi='$isi' WHERE nama_page='$_GET[nama]'");
        print_msg("Data tersimpan", 'success');
    }
}

/** PURA */
if ($mod == 'tempat_tambah') {
    $nama_wisata = $_POST['nama_wisata'];
    $gambar = $_FILES['gambar'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $kategori = $_POST['kategori'];
    $lokasi = $_POST['lokasi'];
    $keterangan = esc_field($_POST['keterangan']);

    if ($nama_wisata == '' || $gambar['name'] == '' || $lat == '' || $lng == '' || $kategori == '' || $lokasi == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $file_name = rand(1000, 9999) . parse_file_name($gambar['name']);
        $img = new SimpleImage($gambar['tmp_name']);
        if ($img->get_width() > 800)
            $img->fit_to_width(800);
        if ($img->get_height() > 600)
            $img->fit_to_height(600);
        $img->save('assets/images/tempat/' . $file_name);
        $img->thumbnail(180, 120);
        $img->save('assets/images/tempat/small_' . $file_name);

        $db->query("INSERT INTO wisata_tb (nama_wisata, gambar, lat, lng, kategori, lokasi, keterangan) 
                    VALUES ('$nama_wisata', '$file_name', '$lat', '$lng', '$kategori', '$lokasi', '$keterangan')");
        redirect_js("index.php?m=tempat");
    }
} elseif ($mod == 'tempat_ubah') {
    $nama_wisata = $_POST['nama_wisata'];
    $gambar = $_FILES['gambar'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $kategori = $_POST['kategori'];
    $lokasi = $_POST['lokasi'];
    $keterangan = esc_field($_POST['keterangan']);

    if ($nama_wisata == '' || $lat == '' || $lng == '' || $kategori == '' || $lokasi == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        if ($gambar['name'] != '') {
            hapus_gambar($_GET['ID']);

            $file_name = rand(1000, 9999) . parse_file_name($gambar['name']);
            $img = new SimpleImage($gambar['tmp_name']);
            if ($img->get_width() > 800)
                $img->fit_to_width(800);
            if ($img->get_height() > 600)
                $img->fit_to_height(600);
            $img->save('assets/images/tempat/' . $file_name);
            $img->thumbnail(180, 120);
            $img->save('assets/images/tempat/small_' . $file_name);

            $sql_gambar = ", gambar='$file_name'";
        }
        $db->query("UPDATE wisata_tb SET nama_wisata='$nama_wisata' $sql_gambar , lat='$lat', lng='$lng', kategori='$kategori', lokasi='$lokasi', keterangan='$keterangan' WHERE id_wisata='$_GET[ID]'");
        redirect_js("index.php?m=tempat");
    }
} elseif ($act == 'tempat_hapus') {
    hapus_gambar($_GET['ID']);
    $db->query("DELETE FROM wisata_tb WHERE id_wisata='$_GET[ID]'");
    header("location:index.php?m=tempat");
}

/** GAMBAR */
if ($mod == 'galeri_tambah') {
    $id_wisata = $_POST['id_wisata'];
    $gambar = $_FILES['gambar'];
    $nama_galeri = $_POST['nama_galeri'];
    $ket_galeri = $_POST['ket_galeri'];

    if ($id_wisata == '' || $gambar['name'] == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $file_name = rand(1000, 9999) . parse_file_name($gambar['name']);

        $img = new SimpleImage($gambar['tmp_name']);
        if ($img->get_width() > 800)
            $img->fit_to_width(800);
        if ($img->get_height() > 600)
            $img->fit_to_height(600);
        $img->save('assets/images/galeri/' . $file_name);
        $img->thumbnail(180, 120);
        $img->save('assets/images/galeri/small_' . $file_name);

        $db->query("INSERT INTO galeri_tb (id_wisata, gambar, nama_galeri, ket_galeri) 
                    VALUES('$id_wisata', '$file_name', '$nama_galeri', '$ket_galeri')");
        redirect_js("index.php?m=galeri");
    }
} elseif ($mod == 'galeri_ubah') {
    $id_wisata = $_POST['id_wisata'];
    $gambar = $_FILES['gambar'];
    $nama_galeri = $_POST['nama_galeri'];
    $ket_galeri = $_POST['ket_galeri'];

    if ($id_wisata == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        if ($gambar['tmp_name'] != '') {
            hapus_galeri($_GET['ID']);
            $file_name = rand(1000, 9999) . parse_file_name($gambar['name']);
            $img = new SimpleImage($gambar['tmp_name']);
            if ($img->get_width() > 800)
                $img->fit_to_width(800);
            if ($img->get_height() > 600)
                $img->fit_to_height(600);
            $img->save('assets/images/galeri/' . $file_name);
            $img->thumbnail(180, 120);
            $img->save('assets/images/galeri/small_' . $file_name);
            $sql_gambar = ", gambar='$file_name'";
        }
        $db->query("UPDATE galeri_tb SET id_wisata='$id_wisata', nama_galeri='$nama_galeri' $sql_gambar, ket_galeri='$ket_galeri' WHERE id_galeri='$_GET[ID]'");
        redirect_js("index.php?m=galeri");
    }
} elseif ($act == 'galeri_hapus') {
    hapus_galeri($_GET['ID']);
    $db->query("DELETE FROM galeri_tb WHERE id_galeri='$_GET[ID]'");
    header("location:index.php?m=galeri");
}
