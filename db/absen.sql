-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 15 Nov 2024 pada 05.34
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absen`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `nomor_induk` char(30) NOT NULL,
  `absen` datetime NOT NULL,
  `absen_maks` datetime NOT NULL,
  `kategori` char(1) DEFAULT NULL COMMENT '1=jam_masuk, 2=istirahat_mulai, 3=istirahat_selesai, 4=pulang',
  `idmesin` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id`, `nomor_induk`, `absen`, `absen_maks`, `kategori`, `idmesin`) VALUES
(49, '12228402', '2024-11-13 08:26:17', '2024-11-13 16:26:17', '1', '1'),
(50, '12228418', '2024-11-13 08:26:59', '2024-11-13 16:26:59', '', '1'),
(51, '12228418', '2024-11-14 02:27:36', '2024-11-14 10:27:36', '', '1'),
(52, '12228402', '2024-11-14 03:34:30', '2024-11-14 11:34:30', '1', '1'),
(53, '12228402', '2024-11-14 03:34:53', '2024-11-14 11:34:53', '1', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cabang_gedung`
--

CREATE TABLE `cabang_gedung` (
  `id` int(11) NOT NULL,
  `lokasi` text NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_pulang` time NOT NULL,
  `istirahat_mulai` time NOT NULL,
  `istirahat_selesai` time NOT NULL,
  `hari_libur` char(15) NOT NULL,
  `zona_waktu` char(1) NOT NULL,
  `aktif` char(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cabang_gedung`
--

INSERT INTO `cabang_gedung` (`id`, `lokasi`, `jam_masuk`, `jam_pulang`, `istirahat_mulai`, `istirahat_selesai`, `hari_libur`, `zona_waktu`, `aktif`) VALUES
(0, 'mainland', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '1,2,3,4,5,6,7', '1', '1'),
(1, 'penggung', '00:00:00', '08:00:00', '02:35:00', '03:36:00', '0,6', '1', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cuti`
--

CREATE TABLE `cuti` (
  `id` int(11) NOT NULL,
  `nomor_induk` char(30) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `denda`
--

CREATE TABLE `denda` (
  `id` int(11) NOT NULL,
  `per_menit` int(1) NOT NULL,
  `rupiah_pertama` decimal(10,0) NOT NULL,
  `rupiah_selanjutnya` decimal(10,0) NOT NULL,
  `prioritas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `denda`
--

INSERT INTO `denda` (`id`, `per_menit`, `rupiah_pertama`, `rupiah_selanjutnya`, `prioritas`) VALUES
(1, 1, 10000, 1000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id` int(11) NOT NULL,
  `hak` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hak_akses`
--

INSERT INTO `hak_akses` (`id`, `hak`) VALUES
(0, 'nusabot'),
(1, 'Full'),
(2, 'General');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan_status`
--

CREATE TABLE `jabatan_status` (
  `id` int(11) NOT NULL,
  `jabatan_status` varchar(15) NOT NULL,
  `hak_akses` char(1) NOT NULL,
  `aktif` char(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jabatan_status`
--

INSERT INTO `jabatan_status` (`id`, `jabatan_status`, `hak_akses`, `aktif`) VALUES
(1, 'main', '0', '1'),
(2, 'Direktur', '1', '1'),
(3, 'HRD', '1', '1'),
(5, 'Office Boy', '2', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `libur_khusus`
--

CREATE TABLE `libur_khusus` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `nomor_induk` char(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tag` varchar(50) NOT NULL,
  `jabatan_status` char(1) NOT NULL,
  `cabang_gedung` char(1) NOT NULL,
  `password` text NOT NULL,
  `aktif` char(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`nomor_induk`, `nama`, `tag`, `jabatan_status`, `cabang_gedung`, `password`, `aktif`) VALUES
('0', 'Nusabot.id', '', '0', '0', '2dcca9cf0a56e9f1cd2141d6df458f62', '1'),
('1', 'abin', 'abin', '5', '1', 'c4ca4238a0b923820dcc509a6f75849b', '0'),
('12228402', 'Yan', '3577438329', '2', '1', 'c3a92251d8c64ca74ba88069d7cc6b2c', '1'),
('12228418', 'fifi', '3069959139', '2', '1', '2a372a408d5d7f2ddc30142b9fdc2563', '1'),
('2', 'ijal', '2863188851', '3', '1', 'c81e728d9d4c2f636f067f89cc14862c', '1'),
('5', 'ewing', '0241136899', '2', '1', 'e4da3b7fbbce2345d7772b0674a318d5', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cabang_gedung`
--
ALTER TABLE `cabang_gedung`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jabatan_status`
--
ALTER TABLE `jabatan_status`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `libur_khusus`
--
ALTER TABLE `libur_khusus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`nomor_induk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `cabang_gedung`
--
ALTER TABLE `cabang_gedung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `denda`
--
ALTER TABLE `denda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jabatan_status`
--
ALTER TABLE `jabatan_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `libur_khusus`
--
ALTER TABLE `libur_khusus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
