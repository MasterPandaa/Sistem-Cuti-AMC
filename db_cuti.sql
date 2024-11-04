-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Okt 2024 pada 07.17
-- Versi server: 10.4.16-MariaDB
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cuti`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cuti`
--

CREATE TABLE `cuti` (
  `id_cuti` varchar(30) NOT NULL,
  `id_user` varchar(256) NOT NULL,
  `alasan` text NOT NULL,
  `tgl_diajukan` date NOT NULL,
  `mulai` date NOT NULL,
  `berakhir` date NOT NULL,
  `id_status_cuti` int(12) NOT NULL,
  `perihal_cuti` varchar(100) NOT NULL,
  `alasan_verifikasi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cuti`
--

INSERT INTO `cuti` (`id_cuti`, `id_user`, `alasan`, `tgl_diajukan`, `mulai`, `berakhir`, `id_status_cuti`, `perihal_cuti`, `alasan_verifikasi`) VALUES
('cuti-060ae', 'c551fc8847d29dc25a23db5d2cdb941b', 'Cuti Sakit SAkit', '2022-08-06', '2022-08-04', '2022-08-17', 2, 'Cuti Sakit', 'YEs'),
('cuti-714f0', '592d06bdc0ee778dab4e01d55ba8b14c', 'Karena ibu saya sakit', '2022-06-15', '2022-06-12', '2022-06-30', 1, 'Cuti Libur', NULL),
('cuti-99215', 'ebeeaf891bcf293ec607f50475648ddc', 'menemani ibu saya yang sakit, sekarang beliau masih berada dirumah sakit dan butuh saya temani selama seminggu.', '2022-06-06', '2022-06-06', '2022-06-15', 2, 'berobat', NULL),
('cuti-ede81', 'dce802a5e29e9ccabc144dfb6a37abbb', 'Liburan ke lampung', '2022-06-21', '2022-06-21', '2022-06-21', 2, 'Cuti Libur', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_cuti`
--

CREATE TABLE `jenis_cuti` (
  `id` int(11) NOT NULL,
  `jenis_cuti` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_cuti`
--

INSERT INTO `jenis_cuti` (`id`, `jenis_cuti`) VALUES
(1, 'Cuti Tahunan'),
(2, 'Cuti Besar'),
(3, 'Cuti Melahirkan'),
(4, 'Cuti Ibadah'),
(5, 'Cuti Alasan Penting'),
(6, 'Cuti Diluar Tanggungan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_kelamin`
--

CREATE TABLE `jenis_kelamin` (
  `id_jenis_kelamin` int(11) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_kelamin`
--

INSERT INTO `jenis_kelamin` (`id_jenis_kelamin`, `jenis_kelamin`) VALUES
(1, 'Laki-Laki'),
(2, 'Perempuan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_cuti`
--

CREATE TABLE `status_cuti` (
  `id_status_cuti` int(11) NOT NULL,
  `status_cuti` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `status_cuti`
--

INSERT INTO `status_cuti` (`id_status_cuti`, `status_cuti`) VALUES
(1, 'Menunggu Konfirmasi'),
(2, 'Izin Cuti Diterima'),
(3, 'Izin Cuti Ditolak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit`
--

CREATE TABLE `unit` (
  `id_unit` int(11) NOT NULL,
  `nama_unit` varchar(30) NOT NULL,
  `tipe_unit` enum('Medis','Non-medis') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `unit`
--

INSERT INTO `unit` (`id_unit`, `nama_unit`, `tipe_unit`) VALUES
(1, 'Inst. Rekam Medis', 'Medis'),
(2, 'Inst. Kesehatan Lingkungan', 'Medis'),
(3, 'Inst. Radiologi', 'Medis'),
(4, 'Inst. Laboratorium', 'Medis'),
(5, 'Inst. Farmasi', 'Medis'),
(6, 'Inst. Gizi', 'Medis'),
(7, 'Inst. CSSD', 'Non-medis'),
(8, 'Inst. Gawat Darurat', 'Medis'),
(9, 'Inst. Bedah Sentral', 'Medis'),
(10, 'Inst. Rawat Inap', 'Medis'),
(11, 'Inst. Rawat Jalan', 'Medis'),
(12, 'Inst. Kamar Bersalin & Ba', 'Medis'),
(13, 'Inst. ICU & NICU', 'Medis'),
(14, 'Humas & Marketing', 'Non-medis'),
(15, 'IT & SIMRS', 'Non-medis'),
(16, 'SDI', 'Non-medis'),
(17, 'Keuangan', 'Non-medis'),
(18, 'Umum & Aset', 'Non-medis'),
(19, 'IPSRS', 'Non-medis');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` varchar(256) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_user_level` int(11) NOT NULL,
  `id_user_detail` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `id_user_level`, `id_user_detail`) VALUES
('5b2f15c525baec657efd2c5b1c96cf67', '1807041406030002', 'amc123', 'iniluthfi2@gmail.com', 1, '5b2f15c525baec657efd2c5b1c96cf67'),
('886badc023e824dc1895a614e4609f18', '1806030303030004', 'amc123', '', 1, '886badc023e824dc1895a614e4609f18'),
('9891f912d7522ff9e4cd581656ee0f48', 'admin_grace', '12345', 'grace.herlia64@gmail.com', 3, '9891f912d7522ff9e4cd581656ee0f48'),
('98eb4077470a60a0fe0f7b9d01755557', 'admin', 'admin123', 'ika@gmail.com', 2, '98eb4077470a60a0fe0f7b9d01755557'),
('f5972fbf4ef53843c1e12c3ae99e5005', 'super_admin', 'super_admin', 'kresna123@gmail.com', 3, 'f5972fbf4ef53843c1e12c3ae99e5005');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_detail`
--

CREATE TABLE `user_detail` (
  `id_user_detail` varchar(256) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `id_jenis_kelamin` int(12) DEFAULT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `no_bpjs` varchar(20) DEFAULT NULL,
  `no_bpjs_tk` varchar(20) DEFAULT NULL,
  `alamat_ktp` text DEFAULT NULL,
  `alamat_domisili` text DEFAULT NULL,
  `wa_aktif` varchar(20) DEFAULT NULL,
  `wa_kerabat` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `asal_pt` varchar(100) DEFAULT NULL,
  `no_ijazah` varchar(50) DEFAULT NULL,
  `tanggal_lulus` date DEFAULT NULL,
  `profesi_str` varchar(100) DEFAULT NULL,
  `no_str` varchar(50) DEFAULT NULL,
  `tanggal_terbit_str` date DEFAULT NULL,
  `masa_berlaku_str` date DEFAULT NULL,
  `no_sip` varchar(50) DEFAULT NULL,
  `tanggal_terbit_sip` date DEFAULT NULL,
  `masa_berlaku_sip` date DEFAULT NULL,
  `nama_faskes_sip` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_detail`
--

INSERT INTO `user_detail` (`id_user_detail`, `nama_lengkap`, `id_unit`, `tempat_lahir`, `tanggal_lahir`, `id_jenis_kelamin`, `nik`, `no_bpjs`, `no_bpjs_tk`, `alamat_ktp`, `alamat_domisili`, `wa_aktif`, `wa_kerabat`, `email`, `asal_pt`, `no_ijazah`, `tanggal_lulus`, `profesi_str`, `no_str`, `tanggal_terbit_str`, `masa_berlaku_str`, `no_sip`, `tanggal_terbit_sip`, `masa_berlaku_sip`, `nama_faskes_sip`, `status`) VALUES
('5b2f15c525baec657efd2c5b1c96cf67', 'Luthfi Abdillah', 1, 'Pekalongan', '2002-06-14', 1, '1807041406030002', '', '', 'Jln. Batanghari, Gg. Makam, Dusun IV RT.025/RW.008\r\nPekalongan', 'Jln. Batanghari, Gg. Makam, Dusun IV RT.025/RW.008\r\nPekalongan', '0895640311157', '087712341234', 'iniluthfi2@gmail.com', '', '', '0000-00-00', 'Dokter', '123123123213', '2009-02-06', '2026-03-02', '1234123412', '2010-06-14', '2029-06-14', 'RSU AMC Muhammadiyah Yogyakarta', 'aktif'),
('886badc023e824dc1895a614e4609f18', 'Luthfi Abdillah 2', 1, '', '0000-00-00', 1, '1806030303030004', '', '', 'Jln. Batanghari, Gg. Makam, Dusun IV RT.025/RW.008\r\nPekalongan', 'Jln. Batanghari, Gg. Makam, Dusun IV RT.025/RW.008\r\nPekalongan', '', '', '', '', '', '0000-00-00', '', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', 'RSU AMC Muhammadiyah Yogyakarta', 'aktif'),
('9891f912d7522ff9e4cd581656ee0f48', 'Super Admin 2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'grace.herlia64@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('98eb4077470a60a0fe0f7b9d01755557', 'Admin', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ika@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('f5972fbf4ef53843c1e12c3ae99e5005', 'Super Admin', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kresna123@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_level`
--

CREATE TABLE `user_level` (
  `id_user_level` int(11) NOT NULL,
  `user_level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_level`
--

INSERT INTO `user_level` (`id_user_level`, `user_level`) VALUES
(1, 'pegawai'),
(2, 'admin'),
(3, 'super admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id_cuti`);

--
-- Indeks untuk tabel `jenis_cuti`
--
ALTER TABLE `jenis_cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  ADD PRIMARY KEY (`id_jenis_kelamin`);

--
-- Indeks untuk tabel `status_cuti`
--
ALTER TABLE `status_cuti`
  ADD PRIMARY KEY (`id_status_cuti`);

--
-- Indeks untuk tabel `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`id_user_detail`);

--
-- Indeks untuk tabel `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id_user_level`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jenis_cuti`
--
ALTER TABLE `jenis_cuti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  MODIFY `id_jenis_kelamin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `status_cuti`
--
ALTER TABLE `status_cuti`
  MODIFY `id_status_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `unit`
--
ALTER TABLE `unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
