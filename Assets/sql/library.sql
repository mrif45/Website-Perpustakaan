SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nama_admin` varchar(100) DEFAULT NULL,
  `email_admin` varchar(120) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tgl_reg` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admin`(`id_admin`, `nama_admin`, `email_admin`, `username`, `password`, `tgl_reg`) VALUES
(1, 'Adam', 'adam@gmail.com', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'CURRENT_DATE()');

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nama_kategori`varchar(150) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `tgl_reg` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` DATETIME NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `status`, `tgl_reg`, `tgl_update`) VALUES
(1, 'Teknologi', 1, 'CURRENT_DATE()', 'CURRENT_DATE()');

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_kategori` int(11) NOT NULL,
  `nama_buku` varchar(255) DEFAULT NULL,
  `ISBN` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `tgl_reg` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `buku`(`id_buku`, `id_kategori`, `nama_buku`, `ISBN`, `harga`, `tgl_reg`, `tgl_update`) VALUES
(1, 1, 'PHP And MySql programming',  123123, 10, 'CURRENT_DATE()', 'CURRENT_DATE()');

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_buku` int(11) NOT NULL,
  `id_siswa` varchar(11) NOT NULL,
  `tgl_pinjam` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_kembali` DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) DEFAULT NULL,
  `denda` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `peminjaman` (`id`, `id_buku`, `id_siswa`, `tgl_pinjam`, `tgl_kembali`, `status`, `denda`) VALUES
(1, 1, 'ID001', 'CURRENT_DATE()', 'CURRENT_DATE()', 1, 5);

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_siswa` varchar(11) NOT NULL,
  `nama_siswa` varchar(120) DEFAULT NULL,
  `email_siswa` varchar(120) DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL,
  `no_telp` char(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `tgl_reg` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `siswa`(`id`, `id_siswa`, `nama_siswa`, `email_siswa`, `no_telp`, `password`, `status`, `tgl_reg`, `tgl_update`) VALUES
(1, 'ID001', 'dafa', 'dafa@gmail.com', '9865472555', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'CURRENT_DATE()', 'CURRENT_DATE()');

ALTER TABLE `buku`
  ADD UNIQUE KEY(id_kategori);

ALTER TABLE `peminjaman`
  ADD UNIQUE KEY(id_buku);
  ADD UNIQUE KEY(id_siswa);

COMMIT;