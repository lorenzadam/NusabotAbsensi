-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 01 Jul 2021 pada 18.08
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `nomor_induk` char(30) NOT NULL,
  `absen` datetime NOT NULL,
  `kategori` char(1) NOT NULL COMMENT '1=jam_masuk, 2=jam_pulang, 3=istirahat_mulai, 4=istirahat_selesai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `hari_kerja` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cabang_gedung`
--

INSERT INTO `cabang_gedung` (`id`, `lokasi`, `jam_masuk`, `jam_pulang`, `istirahat_mulai`, `istirahat_selesai`, `hari_kerja`) VALUES
(1, 'mainland', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '1,2,3,4,5,6,7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cuti`
--

CREATE TABLE `cuti` (
  `id` int(11) NOT NULL,
  `nomor_induk` char(30) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id` int(11) NOT NULL,
  `hak` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hak_akses`
--

INSERT INTO `hak_akses` (`id`, `hak`) VALUES
(0, 'nusabot'),
(1, 'admin'),
(2, 'general');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan_status`
--

CREATE TABLE `jabatan_status` (
  `id` int(11) NOT NULL,
  `jabatan_status` varchar(15) NOT NULL,
  `hak_akses` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jabatan_status`
--

INSERT INTO `jabatan_status` (`id`, `jabatan_status`, `hak_akses`) VALUES
(1, 'main', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `nomor_induk` char(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan_status` char(1) NOT NULL,
  `cabang_gedung` char(1) NOT NULL,
  `password` text NOT NULL,
  `aktif` char(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `cabang_gedung`
--
ALTER TABLE `cabang_gedung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jabatan_status`
--
ALTER TABLE `jabatan_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
