-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Nov 2024 pada 01.13
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sig`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri_tb`
--

CREATE TABLE `galeri_tb` (
  `id_galeri` int(11) NOT NULL,
  `id_wisata` int(11) NOT NULL,
  `nama_galeri` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `ket_galeri` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `galeri_tb`
--

INSERT INTO `galeri_tb` (`id_galeri`, `id_wisata`, `nama_galeri`, `gambar`, `ket_galeri`) VALUES
(3, 64, 'Curug Gombong', '9652gombong.png', '<p>wiih asik</p>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `options_tb`
--

CREATE TABLE `options_tb` (
  `option_name` varchar(16) NOT NULL,
  `option_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `options_tb`
--

INSERT INTO `options_tb` (`option_name`, `option_value`) VALUES
('default_lat', '-6.98290341808291'),
('default_lng', '109.80225137957177'),
('default_zoom', '10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_tb`
--

CREATE TABLE `user_tb` (
  `id_user` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user_tb`
--

INSERT INTO `user_tb` (`id_user`, `user`, `pass`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wisata_tb`
--

CREATE TABLE `wisata_tb` (
  `id_wisata` int(11) NOT NULL,
  `nama_wisata` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `kategori` varchar(50) NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `wisata_tb`
--

INSERT INTO `wisata_tb` (`id_wisata`, `nama_wisata`, `gambar`, `lat`, `lng`, `kategori`, `lokasi`, `keterangan`) VALUES
(61, 'Pantai Sigandu', '8347download.jpeg', -6.881255505696751, 109.75309327848986, 'Pantai', 'Desa Klidang Lor, Kec. Batang', '<p>Pantai Sigandu Luar Biasa!!!!</p>'),
(64, 'Curug Gombong', '5479gombong.png', -6.997184639781024, 109.86934403711874, 'Curug', 'Desa Gombong, Pecalungan', '<p>Air mengalir dari ketinggian sekitar 15 m di air terjun hutan yang populer di kalangan pendaki ini.</p>'),
(65, 'Perkebunan Pagilaran', '5564pg.png', -7.111018987590302, 109.8553371050965, 'Pegunungan', 'Ds. Keteleng, Blado Batang', '<p>Terdapat arena out bond, danau buatan, masjid, dan pabrik teh.</p>'),
(66, 'Curug Genting', '1482genting.png', -7.105515131596841, 109.8204552403044, 'Curug', 'Blado', '<p>Air terjun populer di lingkungan tropis berbatu yang diakses melalui jalur primitif dengan tangga.</p>');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `galeri_tb`
--
ALTER TABLE `galeri_tb`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indeks untuk tabel `options_tb`
--
ALTER TABLE `options_tb`
  ADD PRIMARY KEY (`option_name`);

--
-- Indeks untuk tabel `user_tb`
--
ALTER TABLE `user_tb`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `wisata_tb`
--
ALTER TABLE `wisata_tb`
  ADD PRIMARY KEY (`id_wisata`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `galeri_tb`
--
ALTER TABLE `galeri_tb`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_tb`
--
ALTER TABLE `user_tb`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `wisata_tb`
--
ALTER TABLE `wisata_tb`
  MODIFY `id_wisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
