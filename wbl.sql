-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jun 2024 pada 08.52
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wbl`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getPelanggan` (IN `namapelanggan` VARCHAR(100))   BEGIN
 SELECT p.NAMA_PELANGGAN, b.ID_BOOKING, b.JUMLAH_TIKET, b.TOTAL_HARGA, b.TANGGAL_PEMESANAN FROM pelanggan p JOIN booking b ON p.NIK = b.NIK WHERE p.NAMA_PELANGGAN LIKE CONCAT ("%", namapelanggan, "%");
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapusAdmin` (IN `kode` INT)   BEGIN
    DELETE FROM admin_wbl WHERE ID_ADMIN = kode;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapusDataTiket` (IN `kode` INT)   BEGIN
    DELETE FROM kriteria_tiket WHERE ID_TIKET = kode;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapusPelanggan` (IN `kode` VARCHAR(16))   BEGIN
    DELETE FROM pelanggan WHERE NIK = kode;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapusTransaksi` (IN `kode` INT)   BEGIN
    DELETE FROM booking WHERE ID_BOOKING = kode;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertToAdmin` (IN `NAMA_ADMIN` VARCHAR(50), IN `USERNAME` VARCHAR(20), IN `PASSWORD` VARCHAR(10))   BEGIN 
 INSERT INTO admin_wbl(NAMA_ADMIN, USERNAME, PASSW0RD)
 VALUES (NAMA_ADMIN, USERNAME, PASSWORD);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertToBooking` (IN `NIK` VARCHAR(16), IN `ID_ADMIN` INT, IN `ID_TIKET` INT, IN `JUMLAH_TIKET` INT, IN `TOTAL_HARGA` DECIMAL(10,2), IN `TANGGAL_BOOKING` DATE, IN `TANGGAL_PEMESANAN` DATE)   BEGIN
    INSERT INTO booking (NIK, ID_ADMIN, ID_TIKET, JUMLAH_TIKET, TOTAL_HARGA, TANGGAL_BOOKING, TANGGAL_PEMESANAN)
    VALUES (NIK, ID_ADMIN, ID_TIKET, JUMLAH_TIKET, TOTAL_HARGA, TANGGAL_BOOKING, TANGGAL_PEMESANAN);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertToKriteriaTiket` (IN `NAMA_TIKET` VARCHAR(50), IN `KETERANGAN` TEXT, IN `HARGA` DECIMAL(10,2))   BEGIN 
 INSERT INTO kriteria_tiket(`NAMA_TIKET`,`KETERANGAN`,`HARGA`)
 VALUES (NAMA_TIKET, KETERANGAN, HARGA);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertToPelanggan` (IN `NIK` VARCHAR(16), IN `NAMA_PELANGGAN` VARCHAR(50), IN `JENIS_KELAMIN` VARCHAR(1))   BEGIN
    INSERT INTO pelanggan (NIK, NAMA_PELANGGAN, JENIS_KELAMIN)
    VALUES (NIK, NAMA_PELANGGAN, JENIS_KELAMIN);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilkanTransaksi` (IN `tanggal_pemesanan` DATE)   BEGIN
    SELECT b.ID_BOOKING, p.NIK, p.NAMA_PELANGGAN, kt.NAMA_TIKET, b.JUMLAH_TIKET, b.TOTAL_HARGA
    FROM booking b
    INNER JOIN pelanggan p ON b.NIK = p.NIK
    INNER JOIN kriteria_tiket kt ON b.ID_TIKET = kt.ID_TIKET
    WHERE DATE(b.TANGGAL_PEMESANAN) = tanggal_pemesanan;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `TotalHargaTiket` (IN `harga_asli` DECIMAL(10,2), IN `tgl_pemesanan` DATE, IN `jumlahtiket` INT(10))   BEGIN
    DECLARE hari VARCHAR(20);
    DECLARE harga_final DECIMAL(10, 2);

    SET hari = DAYNAME(tgl_pemesanan);

    IF hari = 'Saturday' OR hari = 'Sunday' THEN
        SET harga_final = harga_asli;
    ELSE
        SET harga_final = harga_asli * 0.8;
    END IF;

    SELECT harga_final AS Harga_Akhir;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `transaksiHargaTertinggi` ()   BEGIN
    DECLARE total_transaksi INT DEFAULT 0;
    DECLARE i INT DEFAULT 0;
    DECLARE offset INT DEFAULT 0;

    -- Hitung total transaksi
    SELECT COUNT(*) INTO total_transaksi FROM booking;

    -- Buat tabel sementara untuk menyimpan hasil sementara
    DROP TEMPORARY TABLE IF EXISTS Temp_Transaksi;

    CREATE TEMPORARY TABLE Temp_Transaksi (
        NIK VARCHAR(16),
        ID_ADMIN INT,
        ID_TIKET INT,
        JUMLAH_TIKET INT,
        TOTAL_HARGA DECIMAL(10, 2),
        TANGGAL_BOOKING DATE,
        TANGGAL_PEMESANAN DATE
    );

    -- Loop untuk memasukkan data ke tabel sementara
    WHILE i < total_transaksi DO
        SET @nik = NULL;
        SET @id_admin = NULL;
        SET @id_tiket = NULL;
        SET @jumlah_tiket = NULL;
        SET @total_harga = NULL;
        SET @tanggal_booking = NULL;
        SET @tanggal_pemesanan = NULL;

        SELECT NIK, ID_ADMIN, ID_TIKET, JUMLAH_TIKET, TOTAL_HARGA, TANGGAL_BOOKING, TANGGAL_PEMESANAN
        INTO @nik, @id_admin, @id_tiket, @jumlah_tiket, @total_harga, @tanggal_booking, @tanggal_pemesanan
        FROM booking
        ORDER BY TOTAL_HARGA DESC LIMIT offset, 1;

        INSERT INTO Temp_Transaksi (NIK, ID_ADMIN, ID_TIKET, JUMLAH_TIKET, TOTAL_HARGA, TANGGAL_BOOKING, TANGGAL_PEMESANAN)
        VALUES (@nik, @id_admin, @id_tiket, @jumlah_tiket, @total_harga, @tanggal_booking, @tanggal_pemesanan);

        SET i = i + 1;
        SET offset = offset + 1;
    END WHILE;

    -- Pilih hasil dari tabel sementara
    SELECT * FROM Temp_Transaksi;

    -- Hapus tabel sementara
    DROP TEMPORARY TABLE IF EXISTS Temp_Transaksi;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateAdmin` (IN `kode` INT(10), IN `NAMA_ADMIN` VARCHAR(100), IN `USERNAME` VARCHAR(50), IN `PASS` VARCHAR(10))   BEGIN
    UPDATE admin_wbl 
    SET NAMA_ADMIN = NAMA_ADMIN, USERNAME = USERNAME, PASSW0RD = PASS
    WHERE ID_ADMIN = kode;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdatePelanggan` (IN `kode` VARCHAR(16), IN `NAMA_PELANGGAN` VARCHAR(100), IN `JENIS_KELAMIN` VARCHAR(1))   BEGIN
    UPDATE pelanggan
    SET NAMA_PELANGGAN = NAMA_PELANGGAN, JENIS_KELAMIN = JENIS_KELAMIN
    WHERE NIK = kode;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateTiket` (IN `kode` INT(10), IN `NAMA_TIKET` VARCHAR(100), IN `KETERANGAN` TEXT, IN `HARGA` DECIMAL(10,2))   BEGIN
    UPDATE kriteria_tiket 
    SET NAMA_TIKET = NAMA_TIKET, KETERANGAN = KETERANGAN, HARGA = HARGA 
    WHERE ID_TIKET = kode;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateTransaksi` (IN `kode` INT, IN `nik` VARCHAR(16), IN `id_admin` INT, IN `id_tiket` INT, IN `jumlah_tiket` INT, IN `tanggal_booking` DATE)   BEGIN
    UPDATE booking
    SET NIK = nik, 
        ID_ADMIN = id_admin, 
        ID_TIKET = id_tiket, 
        JUMLAH_TIKET = jumlah_tiket, 
        TANGGAL_BOOKING = tanggal_booking
    WHERE ID_BOOKING = kode;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_wbl`
--

CREATE TABLE `admin_wbl` (
  `ID_ADMIN` int(10) NOT NULL,
  `NAMA_ADMIN` varchar(50) DEFAULT NULL,
  `USERNAME` varchar(20) DEFAULT NULL,
  `PASSW0RD` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin_wbl`
--

INSERT INTO `admin_wbl` (`ID_ADMIN`, `NAMA_ADMIN`, `USERNAME`, `PASSW0RD`) VALUES
(0, 'SHAFIRA ZUKHRUFATUZ ZAHRA', 'SHAA', 'Acha123'),
(3, 'a', 'a', '1234');

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `ID_BOOKING` int(10) NOT NULL,
  `NIK` varchar(16) DEFAULT NULL,
  `ID_ADMIN` int(10) DEFAULT NULL,
  `ID_TIKET` int(10) DEFAULT NULL,
  `JUMLAH_TIKET` int(10) DEFAULT NULL,
  `TOTAL_HARGA` decimal(10,2) DEFAULT NULL,
  `TANGGAL_BOOKING` date DEFAULT NULL,
  `TANGGAL_PEMESANAN` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `booking`
--

INSERT INTO `booking` (`ID_BOOKING`, `NIK`, `ID_ADMIN`, `ID_TIKET`, `JUMLAH_TIKET`, `TOTAL_HARGA`, `TANGGAL_BOOKING`, `TANGGAL_PEMESANAN`) VALUES
(4, '1234567890123876', 0, 2, 1, 116000.00, '2024-06-20', '2024-06-11'),
(5, '1234567890123876', 0, 2, 2, 220000.00, '2024-06-20', '2024-06-12'),
(6, '1234567890123876', 0, 2, 2, 220000.00, '2024-06-20', '2024-06-12'),
(7, '1234567890123876', 0, 0, 2, 96000.00, '2024-06-14', '2024-06-12'),
(8, '1234567890123876', 0, 2, 2, 220000.00, '2024-06-20', '2024-06-12'),
(9, '1234567890123876', 0, 2, 2, 220000.00, '2024-06-20', '2024-06-10'),
(10, '1234567890123876', 0, 0, 1, 48000.00, '2024-08-14', '2024-06-12'),
(11, '1234567890123876', 0, 0, 2, 96000.00, '2024-06-14', '2024-06-12'),
(15, '1234567890123876', 0, 0, 1, 60000.00, '2024-06-15', '2024-06-13'),
(16, '1234567890123876', 0, 0, 1, 48000.00, '2024-06-14', '2024-06-13');

--
-- Trigger `booking`
--
DELIMITER $$
CREATE TRIGGER `in_total_harga_booking` BEFORE INSERT ON `booking` FOR EACH ROW BEGIN
    DECLARE harga_tiket DECIMAL(10,2);
    DECLARE total_harga DECIMAL(10,2);
    DECLARE hari_booking VARCHAR(10);
    
    SELECT HARGA INTO harga_tiket 
    FROM kriteria_tiket 
    WHERE ID_TIKET = NEW.ID_TIKET;
    
    SET hari_booking = DAYNAME(NEW.TANGGAL_BOOKING);
    
    IF (hari_booking IN ('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday')) THEN
        SET total_harga = harga_tiket * NEW.JUMLAH_TIKET * 0.8;
    ELSE
        SET total_harga = harga_tiket * NEW.JUMLAH_TIKET;
    END IF;
    
    SET NEW.TOTAL_HARGA = total_harga;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `sistem_booking` BEFORE INSERT ON `booking` FOR EACH ROW BEGIN
	IF NEW.TANGGAL_PEMESANAN > NEW.TANGGAL_BOOKING THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'tanggal booking tidak boleh lebih awal dari tanggal pemesanan';
	END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_total_harga_booking` BEFORE UPDATE ON `booking` FOR EACH ROW BEGIN
    DECLARE harga_tiket DECIMAL(10,2);
    DECLARE total_harga DECIMAL(10,2);
    DECLARE hari_booking VARCHAR(10);
    
    SELECT HARGA INTO harga_tiket 
    FROM kriteria_tiket 
    WHERE ID_TIKET = NEW.ID_TIKET;
    
    SET hari_booking = DAYNAME(NEW.TANGGAL_BOOKING);
    
    IF (hari_booking IN ('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday')) THEN
        SET total_harga = harga_tiket * NEW.JUMLAH_TIKET * 0.8;
    ELSE
        SET total_harga = harga_tiket * NEW.JUMLAH_TIKET;
    END IF;
    
    SET NEW.TOTAL_HARGA = total_harga;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updbooking` BEFORE UPDATE ON `booking` FOR EACH ROW BEGIN
	IF NEW.TANGGAL_PEMESANAN > NEW.TANGGAL_BOOKING THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'tanggal booking tidak boleh lebih awal dari tanggal pemesanan';
	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `detailbooking`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `detailbooking` (
`ID_BOOKING` int(10)
,`NAMA_PELANGGAN` varchar(100)
,`JENIS_KELAMIN` varchar(1)
,`NAMA_ADMIN` varchar(50)
,`NAMA_TIKET` varchar(20)
,`JUMLAH_TIKET` int(10)
,`TOTAL_HARGA` decimal(10,2)
,`TANGGAL_BOOKING` date
,`TANGGAL_PEMESANAN` date
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria_tiket`
--

CREATE TABLE `kriteria_tiket` (
  `ID_TIKET` int(10) NOT NULL,
  `NAMA_TIKET` varchar(20) DEFAULT NULL,
  `KETERANGAN` text DEFAULT NULL,
  `HARGA` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kriteria_tiket`
--

INSERT INTO `kriteria_tiket` (`ID_TIKET`, `NAMA_TIKET`, `KETERANGAN`, `HARGA`) VALUES
(0, 'Tiket Entrance WBL', 'Include tiket masuk dan gratis akses 22 wahana serta fasilitas di Wisata Bahari Lamongan. Selain 22 wahana tersebut, pengunjung harus membeli tiket terpisah.', 60000.00),
(1, 'Paket WBL', 'Include tiket masuk dan gratis akses 52 wahana di Wisata Bahari Lamongan. Namun, tidak termasuk wahana berbayar.', 110000.00),
(2, 'TERUSAN WBL+MZG', 'Include akses ke tigas destinasi wisata sekaligus, yakni Wisata Bahari Lamongan, Maharani Zoo, dan Goa Maharani. Jadi, pengunjung bisa menikmati 51 wahana serta fasilitas di tiga destinasi wisata tersebut.', 145000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `NIK` varchar(16) NOT NULL,
  `NAMA_PELANGGAN` varchar(100) DEFAULT NULL,
  `JENIS_KELAMIN` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`NIK`, `NAMA_PELANGGAN`, `JENIS_KELAMIN`) VALUES
('1234567890123876', 'Grisha', 'L');

--
-- Trigger `pelanggan`
--
DELIMITER $$
CREATE TRIGGER `cek_panjang_nik` BEFORE INSERT ON `pelanggan` FOR EACH ROW BEGIN
    IF CHAR_LENGTH(new.NIK) <> 16 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'error: panjang nik harus 16';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `deletePelanggan` BEFORE DELETE ON `pelanggan` FOR EACH ROW BEGIN
    DELETE FROM booking WHERE NIK = OLD.NIK;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `pendapatanmacamtiket`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `pendapatanmacamtiket` (
`NAMA_TIKET` varchar(20)
,`total_bayar` decimal(32,2)
,`jumlah_tiket_terjual` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `tiket`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `tiket` (
`ID_TIKET` int(10)
,`TIKET` varchar(20)
,`DESKRIPSI` text
,`PRICE` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vw_admin`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vw_admin` (
`ID` int(10)
,`NAMA` varchar(50)
,`USERNAME` varchar(20)
,`PASSW0RD` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vw_pelanggan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vw_pelanggan` (
`NIK_PELANGGAN` varchar(16)
,`NAMA` varchar(100)
,`JENIS_KELAMIN` varchar(1)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `detailbooking`
--
DROP TABLE IF EXISTS `detailbooking`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detailbooking`  AS SELECT `b`.`ID_BOOKING` AS `ID_BOOKING`, `p`.`NAMA_PELANGGAN` AS `NAMA_PELANGGAN`, `p`.`JENIS_KELAMIN` AS `JENIS_KELAMIN`, `a`.`NAMA_ADMIN` AS `NAMA_ADMIN`, `kt`.`NAMA_TIKET` AS `NAMA_TIKET`, `b`.`JUMLAH_TIKET` AS `JUMLAH_TIKET`, `b`.`TOTAL_HARGA` AS `TOTAL_HARGA`, `b`.`TANGGAL_BOOKING` AS `TANGGAL_BOOKING`, `b`.`TANGGAL_PEMESANAN` AS `TANGGAL_PEMESANAN` FROM (((`booking` `b` join `pelanggan` `p` on(`b`.`NIK` = `p`.`NIK`)) join `admin_wbl` `a` on(`b`.`ID_ADMIN` = `a`.`ID_ADMIN`)) join `kriteria_tiket` `kt` on(`b`.`ID_TIKET` = `kt`.`ID_TIKET`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `pendapatanmacamtiket`
--
DROP TABLE IF EXISTS `pendapatanmacamtiket`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pendapatanmacamtiket`  AS SELECT `k`.`NAMA_TIKET` AS `NAMA_TIKET`, sum(`b`.`TOTAL_HARGA`) AS `total_bayar`, sum(`b`.`JUMLAH_TIKET`) AS `jumlah_tiket_terjual` FROM (`booking` `b` join `kriteria_tiket` `k` on(`b`.`ID_TIKET` = `k`.`ID_TIKET`)) GROUP BY `k`.`NAMA_TIKET` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `tiket`
--
DROP TABLE IF EXISTS `tiket`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tiket`  AS SELECT `kriteria_tiket`.`ID_TIKET` AS `ID_TIKET`, `kriteria_tiket`.`NAMA_TIKET` AS `TIKET`, `kriteria_tiket`.`KETERANGAN` AS `DESKRIPSI`, `kriteria_tiket`.`HARGA` AS `PRICE` FROM `kriteria_tiket` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_admin`
--
DROP TABLE IF EXISTS `vw_admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_admin`  AS SELECT `admin_wbl`.`ID_ADMIN` AS `ID`, `admin_wbl`.`NAMA_ADMIN` AS `NAMA`, `admin_wbl`.`USERNAME` AS `USERNAME`, `admin_wbl`.`PASSW0RD` AS `PASSW0RD` FROM `admin_wbl` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_pelanggan`
--
DROP TABLE IF EXISTS `vw_pelanggan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_pelanggan`  AS SELECT `pelanggan`.`NIK` AS `NIK_PELANGGAN`, `pelanggan`.`NAMA_PELANGGAN` AS `NAMA`, `pelanggan`.`JENIS_KELAMIN` AS `JENIS_KELAMIN` FROM `pelanggan` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_wbl`
--
ALTER TABLE `admin_wbl`
  ADD PRIMARY KEY (`ID_ADMIN`);

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`ID_BOOKING`),
  ADD KEY `NIK` (`NIK`),
  ADD KEY `ID_ADMIN` (`ID_ADMIN`),
  ADD KEY `ID_TIKET` (`ID_TIKET`);

--
-- Indeks untuk tabel `kriteria_tiket`
--
ALTER TABLE `kriteria_tiket`
  ADD PRIMARY KEY (`ID_TIKET`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`NIK`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_wbl`
--
ALTER TABLE `admin_wbl`
  MODIFY `ID_ADMIN` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `booking`
--
ALTER TABLE `booking`
  MODIFY `ID_BOOKING` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `kriteria_tiket`
--
ALTER TABLE `kriteria_tiket`
  MODIFY `ID_TIKET` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`NIK`) REFERENCES `pelanggan` (`NIK`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin_wbl` (`ID_ADMIN`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`ID_TIKET`) REFERENCES `kriteria_tiket` (`ID_TIKET`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
