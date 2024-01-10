-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jan 2024 pada 03.11
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppabaru`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `idakun` int(11) NOT NULL,
  `idlevel` int(11) NOT NULL,
  `iddepartemen` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `NRP` varchar(8) NOT NULL,
  `password` varchar(100) NOT NULL,
  `ttd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`idakun`, `idlevel`, `iddepartemen`, `nama`, `NRP`, `password`, `ttd`) VALUES
(1, 1, 1, 'Rizki Ramadhan', '22003265', '$2y$10$EXvWAbPfwk/RjhjMsW2vne1AB.DLnkqOINArmENvKl8K3MmAaM8hi', 'img659a66f802483_1704617720'),
(2, 9, 1, 'Agus Eka Prasetya', '19019548', '$2y$10$wFHVy0F0Ax0a7FG.5OtSnOG8/hqA4KyvsWwirpYw9ePeeA.mqVeRy', 'img659a6ef333180_1704619763'),
(3, 3, 19, 'Fidi Fitriadhi', '22004514', '$2y$10$3Iv2TGcxPuHUpzb1z8FMEe7WM.JgFXFMRm0TqB1AGvcSEfUwKLXeO', 'img659a6eade8b7b_1704619693'),
(4, 10, 1, 'Dina Hapizah', '048089', '$2y$10$A31ykXEO62osi5qnEnll4uQZ3/54tk/6vBtyy3a0uPyWuYQc/3mLe', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `departemen`
--

CREATE TABLE `departemen` (
  `iddepartemen` int(11) NOT NULL,
  `namadepartemen` varchar(50) NOT NULL,
  `divisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `departemen`
--

INSERT INTO `departemen` (`iddepartemen`, `namadepartemen`, `divisi`) VALUES
(1, 'Center Of Excellent', 'SS6'),
(2, 'Center Of Excellent', 'Analyst'),
(3, 'HCGA', 'HC'),
(4, 'HCGA', 'GA'),
(5, 'Center Of Excellent', 'CCR'),
(18, 'Center of Excellent', 'Enggineering'),
(19, 'Center Of Excellence', 'Dispatch');

-- --------------------------------------------------------

--
-- Struktur dari tabel `history`
--

CREATE TABLE `history` (
  `idhistory` int(11) NOT NULL,
  `idakun` int(11) NOT NULL,
  `id_permohonan` int(11) NOT NULL,
  `id_status_laporan` int(11) NOT NULL,
  `tgl_action` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `alasan` varchar(250) NOT NULL,
  `id_level_persetujuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `history`
--

INSERT INTO `history` (`idhistory`, `idakun`, `id_permohonan`, `id_status_laporan`, `tgl_action`, `alasan`, `id_level_persetujuan`) VALUES
(37, 2, 56, 2, '2024-01-08 08:13:00', 'set 1', 12),
(38, 3, 56, 4, '2024-01-08 08:14:01', 'Set 2', 21),
(39, 2, 54, 2, '2024-01-08 08:15:10', '1', 12),
(40, 3, 54, 4, '2024-01-08 08:31:12', '2', 21);

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `idlevel` int(11) NOT NULL,
  `level_k` enum('admin','group leader','section head','master') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`idlevel`, `level_k`) VALUES
(1, 'admin'),
(3, 'section head'),
(9, 'group leader'),
(10, 'master');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level_persetujuan`
--

CREATE TABLE `level_persetujuan` (
  `idlevelpersetujuan` int(11) NOT NULL,
  `level_persetujuan` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `level_persetujuan`
--

INSERT INTO `level_persetujuan` (`idlevelpersetujuan`, `level_persetujuan`) VALUES
(1, 'Menuggu GL'),
(2, 'Menunggu SH'),
(12, 'Disetujui GL'),
(13, 'Ditolak GL'),
(21, 'Disetujui SH'),
(22, 'Ditolak SH');

-- --------------------------------------------------------

--
-- Struktur dari tabel `list_item`
--

CREATE TABLE `list_item` (
  `id_item` int(11) NOT NULL,
  `id_permohonan` varchar(40) NOT NULL,
  `nama_barang` varchar(40) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `satuan` varchar(40) NOT NULL,
  `agenda` varchar(150) NOT NULL,
  `agenda_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `list_item`
--

INSERT INTO `list_item` (`id_item`, `id_permohonan`, `nama_barang`, `kuantitas`, `satuan`, `agenda`, `agenda_date`) VALUES
(14, '8', 'pensil', 10, 'Dus', 'seminar', '2024-01-03'),
(35, '18', 'makanan', 10, 'kotak', 'induksi', '2024-01-04'),
(36, '19', 'sandal', 10, 'kotak', 'bersih bersih', '2024-01-05'),
(37, '20', 'Air Mineral', 10, 'dus', 'induksi', '2024-01-05'),
(38, '21', 'buah', 10, 'kotak', 'induksi', '2024-01-05'),
(39, '22', 'Air Mineral', 10, 'dus', 'belajar', '2024-01-05'),
(40, '23', 'Mouse Logitech Wireless', 10, 'Unit', 'Stok Perlengkapan Kantor', '2024-01-07'),
(41, '23', 'Kursi Kerja Olympic', 12, 'Set', 'Stok Perlengkapan Kantor', '2024-01-07'),
(42, '24', 'Kursi Kerja Olympic', 12, 'Set', 'Stok Perlengkapan Kantor', '2024-01-09'),
(43, '25', 'Kursi Kerja Olympic', 12, 'Set', 'Stok Perlengkapan Kantor', '2024-01-08'),
(53, '54', 'Kursi Kerja Olympic', 12, 'Set', 'Stok Perlengkapan Kantor', '2024-01-01'),
(57, '56', 'Nasi Kotak', 10, 'kotak', 'Meeting Bulanan', '2024-01-09'),
(58, '56', 'Air Mineral', 12, 'Dus', 'Meeting Bulanan', '2024-01-07'),
(59, '56', 'Teh kotak', 12, 'Dus', 'Meeting Bulanan', '2024-01-09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permohonan`
--

CREATE TABLE `permohonan` (
  `id_permohonan` int(30) NOT NULL,
  `idakun` int(11) NOT NULL,
  `iddepartemen` int(11) NOT NULL,
  `no_surat` varchar(40) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `catatan` varchar(150) NOT NULL,
  `id_status_laporan` int(11) NOT NULL,
  `alasan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `permohonan`
--

INSERT INTO `permohonan` (`id_permohonan`, `idakun`, `iddepartemen`, `no_surat`, `created_date`, `catatan`, `id_status_laporan`, `alasan`) VALUES
(54, 1, 1, '54/HCGA/PPA-GRYA/RKB/I/2024', '2024-01-08 08:31:12', 'Diantar ke Main Office ubah ya', 4, '2'),
(56, 1, 1, '56/HCGA/PPA-GRYA/RKB/I/2024', '2024-01-08 08:14:01', 'Diantar ke Main Office update', 4, 'Set 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_laporan`
--

CREATE TABLE `status_laporan` (
  `id_status_laporan` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `status_laporan`
--

INSERT INTO `status_laporan` (`id_status_laporan`, `status`) VALUES
(1, 'Menunggu'),
(2, 'Disetujui'),
(3, 'Ditolak'),
(4, 'Complete');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`idakun`),
  ADD KEY `idlevel` (`idlevel`),
  ADD KEY `iddepartemen` (`iddepartemen`),
  ADD KEY `idlevel_2` (`idlevel`),
  ADD KEY `iddepartemen_2` (`iddepartemen`);

--
-- Indeks untuk tabel `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`iddepartemen`);

--
-- Indeks untuk tabel `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`idhistory`),
  ADD KEY `idakun` (`idakun`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`idlevel`);

--
-- Indeks untuk tabel `level_persetujuan`
--
ALTER TABLE `level_persetujuan`
  ADD PRIMARY KEY (`idlevelpersetujuan`);

--
-- Indeks untuk tabel `list_item`
--
ALTER TABLE `list_item`
  ADD PRIMARY KEY (`id_item`);

--
-- Indeks untuk tabel `permohonan`
--
ALTER TABLE `permohonan`
  ADD PRIMARY KEY (`id_permohonan`),
  ADD KEY `idakun` (`idakun`),
  ADD KEY `id_status_laporan` (`id_status_laporan`),
  ADD KEY `iddepartemen` (`iddepartemen`);

--
-- Indeks untuk tabel `status_laporan`
--
ALTER TABLE `status_laporan`
  ADD PRIMARY KEY (`id_status_laporan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `idakun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `departemen`
--
ALTER TABLE `departemen`
  MODIFY `iddepartemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `history`
--
ALTER TABLE `history`
  MODIFY `idhistory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `idlevel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `level_persetujuan`
--
ALTER TABLE `level_persetujuan`
  MODIFY `idlevelpersetujuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `list_item`
--
ALTER TABLE `list_item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `permohonan`
--
ALTER TABLE `permohonan`
  MODIFY `id_permohonan` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `status_laporan`
--
ALTER TABLE `status_laporan`
  MODIFY `id_status_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `akun_ibfk_1` FOREIGN KEY (`iddepartemen`) REFERENCES `departemen` (`iddepartemen`),
  ADD CONSTRAINT `akun_ibfk_2` FOREIGN KEY (`idlevel`) REFERENCES `level` (`idlevel`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
