-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Apr 2021 pada 09.47
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mapbanten`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bencana`
--

CREATE TABLE `bencana` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bencana` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota_id` int(11) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `satker_id` int(11) NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `januari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `februari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `maret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `april` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `mei` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `juni` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `juli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `agustus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `september` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `oktober` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `november` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `desember` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kota_id` int(11) DEFAULT NULL,
  `nama_kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `kota_id`, `nama_kecamatan`, `lang`, `lat`, `created_at`, `updated_at`) VALUES
(1, 6, 'Dungingi', '123.05010223', ' 0.55165565', NULL, NULL),
(2, 6, 'Kota Barat', '123.01776886', '0.5295251', NULL, NULL),
(3, 6, 'Kota Selatan', '123.04888153', '0.50167692', NULL, NULL),
(4, 6, 'Kota Tengah', '123.05962372', '0.55310476', NULL, NULL),
(5, 6, 'kota Timur', '123.08739471', '0.50886065', NULL, NULL),
(6, 6, 'Kota Utara', '123.07595062', '0.54055202', NULL, NULL),
(7, 5, 'Buntulia', '121.936409', '0.48158118', NULL, NULL),
(8, 5, 'Dengilo', '122.1211319', '0.52328467', NULL, NULL),
(9, 5, 'Duhiadaa', '121.92971802', '0.45546895', NULL, NULL),
(10, 5, 'Lemito', '121.58346558', '0.55310476', NULL, NULL),
(11, 5, 'Marisa', '121.95301056', '0.41560885', NULL, NULL),
(12, 5, 'Paguat', '122.00863647', '0.46464244', NULL, NULL),
(13, 5, 'Patilanggio', '121.87653351', '0.43923059', NULL, NULL),
(14, 5, 'Popayato', '121.41933441', '0.41356659', NULL, NULL),
(15, 5, 'Popayato Barat', '121.41375732', '0.48390093', NULL, NULL),
(16, 5, 'Popayato Timur', '121.51902771', '0.49044365', NULL, NULL),
(17, 5, 'Randangan', '121.84653473', '0.43187422', NULL, NULL),
(18, 5, 'Taluditi', '121.76754761', '0.59568733', NULL, NULL),
(19, 5, 'Wanggarasi', '121.66699982', '0.45539656', NULL, NULL),
(20, 1, 'Botumoito', '122.22509766', '0.43189502', NULL, NULL),
(21, 1, 'Dulupi', '122.44525909', '0.50176799', NULL, NULL),
(22, 1, 'Mananggu', '122.12153625', '0.40534505', NULL, NULL),
(23, 1, 'Paguyaman', '122.62888336', '0.53721511', NULL, NULL),
(24, 1, 'Paguyaman Pantai', '122.64356995', '0.47582132', NULL, NULL),
(25, 1, 'Tilamuta', '122.33207703', '0.46054277', NULL, NULL),
(26, 1, 'Wonosari', '122.51499176', '0.64098096', NULL, NULL),
(27, 2, 'Bone', '123.46321106', '0.32962993', NULL, NULL),
(28, 2, 'Bone Pantai', '123.24007416', '0.35599536', NULL, NULL),
(29, 2, 'Bone Raya', '123.37091827', '0.41022825', NULL, NULL),
(30, 2, 'Botupingge', '123.11595154', '0.5271042', NULL, NULL),
(31, 2, 'Bulango Selatan', '123.09107971', '0.58361405', NULL, NULL),
(32, 2, 'Bulango Timur', '123.07815552', '0.59867299', NULL, NULL),
(33, 2, 'Bulango Ulu', '123.17336273', '0.62038153', NULL, NULL),
(34, 2, 'Bulango Utara', '123.06511688', '0.61107916', NULL, NULL),
(35, 2, 'Bulawa', '123.2793808', '0.32251042', NULL, NULL),
(36, 2, 'Kabila', '123.11595154', '0.5271042', NULL, NULL),
(37, 2, 'Kabila Bone', '123.157547', '0.40334749', NULL, NULL),
(38, 2, 'Suwawa', '123.12899017', '0.52596396', NULL, NULL),
(39, 2, 'Suwawa Selatan', '123.21722412', '0.50638556', NULL, NULL),
(40, 2, 'Suwawa Tengah', '123.15319061', '0.54626584', NULL, NULL),
(41, 2, 'Suwawa Timur', '123.46521759', '0.63181627', NULL, NULL),
(42, 2, 'Tapa', '123.07823181', '0.60333228', NULL, NULL),
(43, 2, 'Tilongkabila', '123.13386536', '0.54880899', NULL, NULL),
(44, 7, 'Danau Limboto', '123.01784515', '0.56959265', NULL, NULL),
(45, 3, 'Asparaga', '122.32762146', '0.77432066', NULL, NULL),
(46, 3, 'Batudaa', '123.00801849', '0.527412', NULL, NULL),
(47, 3, 'Batudaa Pantai', '122.89089966', '0.48815575', NULL, NULL),
(48, 3, 'Biluhu', '122.73339081', '0.48515612', NULL, NULL),
(49, 3, 'Boliyohuto', '122.69412994', '0.47369626', NULL, NULL),
(50, 3, 'Bongomeme', '122.8874054', '0.56645232', NULL, NULL),
(51, 3, 'Limboto', '122.97245789', '0.58858371', NULL, NULL),
(52, 3, 'Limboto Barat', '122.92314911', '0.61107594', NULL, NULL),
(53, 3, 'Mootilango', '122.66173553', '0.6353212', NULL, NULL),
(54, 3, 'Pulubala', '122.82498169', '0.65856165', NULL, NULL),
(55, 3, 'Tabongo', '122.94651794', '0.60165232', NULL, NULL),
(56, 3, 'Telaga', '123.03940582', '0.68567461', NULL, NULL),
(57, 3, 'Telaga Biru', '123.02966309', '0.59081537', NULL, NULL),
(58, 3, 'Telaga Jaya', '123.02323151', '0.57595795', NULL, NULL),
(59, 3, 'Tibawa', '122.85308075', '0.60655892', NULL, NULL),
(60, 3, 'Tilango', '123.03032684', '0.54964089', NULL, NULL),
(61, 3, 'Tolangohula', '122.56425476', '0.69536901', NULL, NULL),
(62, 4, 'Anggrek', '122.66241455', '1.00302541', NULL, NULL),
(63, 4, 'Atinggola', '123.13378906', '0.88284707', NULL, NULL),
(64, 4, 'Gentuma Raya', '123.03847504', '0.95126516', NULL, NULL),
(65, 4, 'Kwandang', '122.89351654', '0.85264701', NULL, NULL),
(66, 4, 'Sumalata', '122.63720703', '0.99430984', NULL, NULL),
(67, 4, 'Tolinggula', '122.02112579', '0.88668597', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konflik`
--

CREATE TABLE `konflik` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deskripsi_konflik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `konflik`
--

INSERT INTO `konflik` (`id`, `deskripsi_konflik`, `created_at`, `updated_at`) VALUES
(3, 'Tawuran', '2020-07-09 00:18:28', '2020-07-09 23:33:17'),
(5, 'Kepadatan penduduk', '2020-07-09 23:31:31', '2020-07-09 23:32:03'),
(6, 'kekumuhan', '2020-07-09 23:33:36', '2020-07-09 23:33:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota`
--

CREATE TABLE `kota` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kota`
--

INSERT INTO `kota` (`id`, `nama_kota`, `created_at`, `updated_at`) VALUES
(1, 'Kabupaten Boalemo', NULL, NULL),
(2, 'Kabupaten Bone Bolango', NULL, NULL),
(3, 'Kabupaten Gorontalo', NULL, NULL),
(4, 'Kabupaten Gorontalo Utara', NULL, NULL),
(5, 'Kabupaten Pohuwato', NULL, NULL),
(6, 'Kota Gorontalo', NULL, NULL),
(7, 'Danau Limboto', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lsm`
--

CREATE TABLE `lsm` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deskripsi_lsm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lsm`
--

INSERT INTO `lsm` (`id`, `deskripsi_lsm`, `created_at`, `updated_at`) VALUES
(1, 'LSM', '2020-07-10 00:04:42', '2020-07-10 00:04:42'),
(2, 'ORMAS', '2020-07-10 00:05:51', '2020-07-10 00:05:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_07_02_072654_create_kecamatan_table', 1),
(5, '2020_07_08_034125_create_kota_table', 2),
(6, '2020_07_09_032452_create_konflik_table', 3),
(7, '2020_07_09_032744_create_radikalisme_table', 4),
(8, '2020_07_09_032837_create_lsm_table', 4),
(9, '2020_07_13_094422_create_petakonflik_table', 5),
(10, '2020_07_20_030509_create_petaradikalisme_table', 6),
(11, '2020_07_20_063419_create_petalsm_table', 7),
(12, '2020_07_20_074153_create_pakem_table', 8),
(13, '2020_07_21_022349_create_pengawasanasing_table', 9),
(14, '2020_09_10_041406_create_test_table', 10),
(15, '2021_02_25_061033_create_paslon_table', 11),
(16, '2021_02_25_080940_create_suarapilkada_table', 12),
(17, '2021_02_26_033923_create_parpol_table', 13),
(18, '2021_02_26_071019_create_suaraparpol_table', 14),
(19, '2021_03_17_021600_create_vaksinasi_table', 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pakem`
--

CREATE TABLE `pakem` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `satker_id` int(11) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `bulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pimpinan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_pengikut` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bentuk` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_organisasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_kesbangpol` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_badanhukum` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pakem`
--

INSERT INTO `pakem` (`id`, `satker_id`, `kecamatan_id`, `bulan`, `nama_pimpinan`, `alamat`, `jumlah_pengikut`, `bentuk`, `status_organisasi`, `nomor_kesbangpol`, `nomor_badanhukum`, `tahun`, `judul`, `keterangan`, `created_at`, `updated_at`) VALUES
(2, 1, 4, '03', '', '', '', '', '', '', '', '2021', 'dsfdsrfdrst', 'serfserfesrf', '2021-04-13 23:10:37', '2021-04-13 23:10:37'),
(3, 1, 2, '03', 'sgftstaedr', 'dretgegfergtyre', 'tfertretg', 'redtgfdretre', 'Pusat', 'tgaretgret', 'ertergfre', '2021', 'cvbcgbhcgdfg', 'dgxdrxtgdrtgfregregtaertgyhuaet5esty56hr6yt5t6', '2021-04-13 23:10:52', '2021-04-15 01:38:59'),
(4, 1, 5, '02', 'rdtrdtdr', 'fseesr', '45', 'fser', 'Pusat', 'fesrfesrretrtgrety5ryrtyhrtut', 'sefesr', '2021', 'acdawdawe', 'daweawerdawe', '2021-04-13 23:53:25', '2021-04-14 21:28:51'),
(5, 1, 36, '04', 'aadawdeawd', 'dawawdeawd', 'awedawdaw', 'awdawdaw', 'Pusat', 'dawdeaw', 'adawdaweaw', '2021', 'adaweawd', 'dawdeawdawdawedawdaw', '2021-04-15 20:59:12', '2021-04-15 20:59:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `parpol`
--

CREATE TABLE `parpol` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_urut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_parpol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_parpol` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satker_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `paslon`
--

CREATE TABLE `paslon` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `periode_pemilu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satker_id` int(11) NOT NULL DEFAULT 1,
  `no_urut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_paslon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wakil_paslon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `partai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_paslon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengawasanasing`
--

CREATE TABLE `pengawasanasing` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `satker_id` int(11) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `bulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kebangsaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maksud_tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_mulai` date NOT NULL,
  `lama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `petakonflik`
--

CREATE TABLE `petakonflik` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `satker_id` int(11) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `bulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konflik_id` int(11) NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `petalsm`
--

CREATE TABLE `petalsm` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `satker_id` int(11) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `bulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lsm_id` int(11) NOT NULL,
  `nama_lsm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengurus` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruanglingkup` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kedudukan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_berdiri` date NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `petalsm`
--

INSERT INTO `petalsm` (`id`, `satker_id`, `kecamatan_id`, `bulan`, `tahun`, `lsm_id`, `nama_lsm`, `alamat`, `pengurus`, `ruanglingkup`, `kedudukan`, `tgl_berdiri`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '04', '2021', 1, 'afaerftrtghdthytfy', 'rtfyhtryrjgtmmtyutytytytytytytytytytytytytytytytytytytytytytytytytytytydhjjth', 'rgsyrthurtyhsrh', 'fASERERSRESR', 'tfhtfyhdth', '2021-02-05', 'rtgknsB OGImhfaesvoiuofuwoechfchfchfoi', '2021-04-15 19:36:46', '2021-04-15 19:36:46'),
(2, 1, 3, '04', '2021', 2, 'czzsdfzsczs', 'ssd fdsvfvdfvghfdfhfhfbbgfbh', 'gfbhgfhfhfhtyxt', 'dsfSRESRESR', 'fdfvdvgf', '2020-01-01', 'dghdghzsfnjfghngdyjggujuyguyuuyuytutyutyutyuyt', '2021-04-15 19:37:55', '2021-04-15 19:37:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petaradikalisme`
--

CREATE TABLE `petaradikalisme` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `satker_id` int(11) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `bulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `radikalisme_id` int(11) NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `radikalisme`
--

CREATE TABLE `radikalisme` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deskripsi_radikalisme` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `satker`
--

CREATE TABLE `satker` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_satker` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_satker` int(11) NOT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `satker`
--

INSERT INTO `satker` (`id`, `nama_satker`, `level_satker`, `lat`, `lang`, `created_at`, `updated_at`) VALUES
(1, 'Kejati Gorontalo', 0, '0.8344142', '111.7443094', '2019-09-24 11:04:51', '2019-09-27 10:37:08'),
(59, 'Kejari Kota Gorontalo', 1, NULL, NULL, '2021-03-09 09:58:11', NULL),
(60, 'Kejari Kab Gorontalo', 1, NULL, NULL, '2021-03-09 09:58:11', NULL),
(61, 'Kejari Bowe Bolango', 1, NULL, NULL, '2021-03-09 09:58:11', NULL),
(62, 'Kejari Gorontalo Utara', 1, NULL, NULL, '2021-03-09 10:01:36', NULL),
(63, 'Kejari Boalemo', 1, NULL, NULL, '2021-03-09 10:01:36', NULL),
(64, 'Kejari Pohuwatu', 1, NULL, NULL, '2021-03-09 10:01:36', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `suaraparpol`
--

CREATE TABLE `suaraparpol` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parpol_id` int(11) NOT NULL,
  `periode_pemilu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_suara` int(11) NOT NULL,
  `satker_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `suarapilkada`
--

CREATE TABLE `suarapilkada` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paslon_id` int(11) NOT NULL,
  `periode_pemilu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_suara` int(11) NOT NULL,
  `satker_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `test`
--

CREATE TABLE `test` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `test`
--

INSERT INTO `test` (`id`, `nama`, `note`, `created_at`, `updated_at`) VALUES
(1, 'Restu Hasanah', 'Jr. Imam Bonjol No. 747, Madiun 69879, KalUt', NULL, NULL),
(2, 'Unjani Pertiwi S.Kom', 'Ds. Suryo No. 378, Madiun 79414, DKI', NULL, NULL),
(3, 'Prabawa Rajata', 'Ki. Tambun No. 279, Palopo 36773, MalUt', NULL, NULL),
(4, 'Johan Dabukke', 'Ki. Sugiyopranoto No. 186, Administrasi Jakarta Pusat 13208, KepR', NULL, NULL),
(5, 'Latika Halimah', 'Jr. Katamso No. 418, Padangsidempuan 99355, Papua', NULL, NULL),
(6, 'Galang Iswahyudi', 'Jln. K.H. Wahid Hasyim (Kopo) No. 62, Parepare 30151, Jambi', NULL, NULL),
(7, 'Unjani Pudjiastuti S.Kom', 'Jr. Sam Ratulangi No. 912, Gunungsitoli 11886, KalBar', NULL, NULL),
(8, 'Halim Suwarno', 'Ki. Madiun No. 454, Palembang 29726, KalUt', NULL, NULL),
(9, 'Hadi Saputra', 'Ki. Asia Afrika No. 428, Administrasi Jakarta Pusat 14455, DIY', NULL, NULL),
(10, 'Heru Dabukke', 'Ds. Gotong Royong No. 536, Jayapura 95752, Banten', NULL, NULL),
(11, 'Uli Oktaviani S.E.I', 'Psr. Sam Ratulangi No. 275, Jambi 39580, Papua', NULL, NULL),
(12, 'Julia Puspita M.M.', 'Dk. Basoka No. 57, Balikpapan 92707, BaBel', NULL, NULL),
(13, 'Radika Jono Budiyanto M.Pd', 'Ki. Cikapayang No. 202, Bima 88826, DIY', NULL, NULL),
(14, 'Balapati Yusuf Pratama M.Ak', 'Ds. Gajah No. 774, Medan 18198, JaTim', NULL, NULL),
(15, 'Cinthia Padma Halimah M.TI.', 'Jr. Dago No. 940, Pangkal Pinang 40699, BaBel', NULL, NULL),
(16, 'Bella Purwanti', 'Ds. Adisumarmo No. 989, Semarang 30000, Bengkulu', NULL, NULL),
(17, 'Kusuma Kanda Winarno', 'Gg. Panjaitan No. 732, Mojokerto 38229, JaBar', NULL, NULL),
(18, 'Lantar Sihombing', 'Jln. Gatot Subroto No. 48, Bekasi 82200, Gorontalo', NULL, NULL),
(19, 'Amelia Andriani S.E.', 'Jr. Bata Putih No. 52, Cirebon 81157, KalUt', NULL, NULL),
(20, 'Heru Yahya Prasasta', 'Jr. Gajah No. 325, Tebing Tinggi 58323, KalTim', NULL, NULL),
(21, 'Gasti Lala Rahimah S.I.Kom', 'Ds. Baiduri No. 774, Gunungsitoli 76637, KalUt', NULL, NULL),
(22, 'Caket Dalimin Pradipta S.Ked', 'Kpg. Abdullah No. 907, Cirebon 12168, SulUt', NULL, NULL),
(23, 'Kajen Warji Firgantoro S.IP', 'Gg. Raya Ujungberung No. 677, Tangerang Selatan 94031, SumUt', NULL, NULL),
(24, 'Ajimat Tampubolon', 'Kpg. Pattimura No. 219, Lhokseumawe 34574, SumBar', NULL, NULL),
(25, 'Hasan Jatmiko Gunarto', 'Jr. Baladewa No. 678, Singkawang 50388, NTB', NULL, NULL),
(26, 'Ana Hesti Mardhiyah S.Pt', 'Dk. Sugiyopranoto No. 448, Ambon 74991, NTT', NULL, NULL),
(27, 'Bella Latika Pratiwi', 'Dk. R.E. Martadinata No. 809, Kupang 49611, Aceh', NULL, NULL),
(28, 'Usyi Permata', 'Gg. Wahid Hasyim No. 450, Administrasi Jakarta Utara 34520, Bali', NULL, NULL),
(29, 'Putri Yulianti', 'Jr. Samanhudi No. 801, Sawahlunto 95758, Aceh', NULL, NULL),
(30, 'Jindra Megantara', 'Jr. Achmad Yani No. 591, Semarang 31443, SulBar', NULL, NULL),
(31, 'Budi Kuswoyo', 'Psr. Bakau No. 378, Ambon 70467, KalBar', NULL, NULL),
(32, 'Kamila Padmi Pudjiastuti', 'Jr. Bambu No. 571, Pariaman 95206, KalTeng', NULL, NULL),
(33, 'Mitra Sihotang S.Pt', 'Kpg. Cut Nyak Dien No. 611, Tangerang 32550, DKI', NULL, NULL),
(34, 'Sari Riyanti', 'Ki. M.T. Haryono No. 613, Pekalongan 80299, PapBar', NULL, NULL),
(35, 'Ajeng Yuni Mandasari', 'Dk. Rajawali Barat No. 666, Tegal 23158, Gorontalo', NULL, NULL),
(36, 'Eli Ina Fujiati S.Pd', 'Jln. Raden No. 560, Surakarta 54715, Aceh', NULL, NULL),
(37, 'Lutfan Rosman Hidayanto S.Farm', 'Ds. Wahid No. 910, Cimahi 85017, SulSel', NULL, NULL),
(38, 'Queen Suartini S.E.', 'Gg. Ki Hajar Dewantara No. 191, Dumai 96294, SulUt', NULL, NULL),
(39, 'Bakti Damanik S.Kom', 'Gg. Barasak No. 415, Malang 20277, SulTra', NULL, NULL),
(40, 'Maimunah Kamila Zulaika', 'Gg. Supono No. 49, Bukittinggi 29608, Banten', NULL, NULL),
(41, 'Ian Samosir', 'Ki. Gatot Subroto No. 412, Tanjungbalai 25049, SulBar', NULL, NULL),
(42, 'Azalea Pertiwi S.Pt', 'Ki. Jend. Sudirman No. 706, Tanjungbalai 69026, KepR', NULL, NULL),
(43, 'Kacung Dabukke', 'Ds. Rajawali Timur No. 287, Tangerang Selatan 38730, KalTeng', NULL, NULL),
(44, 'Jono Marpaung', 'Psr. Tangkuban Perahu No. 342, Madiun 55770, DIY', NULL, NULL),
(45, 'Asmianto Nasrullah Tamba S.H.', 'Jr. Suryo Pranoto No. 525, Palembang 96732, Gorontalo', NULL, NULL),
(46, 'Vicky Latika Riyanti S.Psi', 'Ki. Gremet No. 5, Bogor 63931, JaBar', NULL, NULL),
(47, 'Maida Safitri', 'Gg. Cut Nyak Dien No. 106, Cirebon 93999, KalBar', NULL, NULL),
(48, 'Kartika Yulianti M.Ak', 'Jr. Sunaryo No. 625, Bima 62928, SulTeng', NULL, NULL),
(49, 'Vega Winarno S.Sos', 'Ds. Moch. Yamin No. 579, Sukabumi 89631, NTT', NULL, NULL),
(50, 'Balamantri Kamal Hutagalung S.T.', 'Ds. Sunaryo No. 892, Sabang 90894, NTB', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota_id` int(20) NOT NULL,
  `satker_id` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `kota_id`, `satker_id`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admingorontalo', 'ilhamlp3i.sda@gmail.com', 0, 1, NULL, '$2y$10$u/ZH6oQuL6yr4UUwf4Na.uIoBWda46rV2ueHYd59dpGpSSUd/gOC.', 1, NULL, '2020-07-08 00:14:00', '2021-04-05 03:34:27'),
(5, 'admin', 'oktavianaayua', 'ilpii@gmail.com', 2, 60, NULL, '$2y$10$7sRLpV/Y5b2flOBRRTrsaOKt7t41ee4s/g/NVfCQoiJBA8VzKFHe.', 3, NULL, '2021-03-17 19:52:05', '2021-03-17 19:52:05'),
(6, 'admin', 'ilham1136', 'adminelpis@sapabadung.com', 1, 63, NULL, '$2y$10$nuEInWV0GQSFBNq/w3INcutSdOxPVEHMGwxJwulcHBt120nSU0IMS', 3, NULL, '2021-04-15 01:06:16', '2021-04-15 01:06:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vaksinasi`
--

CREATE TABLE `vaksinasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vaksinasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota_id` int(11) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `satker_id` int(11) NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `januari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `februari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `maret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `april` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `mei` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `juni` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `juli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `agustus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `september` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `oktober` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `november` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `desember` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bencana`
--
ALTER TABLE `bencana`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `konflik`
--
ALTER TABLE `konflik`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `lsm`
--
ALTER TABLE `lsm`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pakem`
--
ALTER TABLE `pakem`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `parpol`
--
ALTER TABLE `parpol`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `paslon`
--
ALTER TABLE `paslon`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pengawasanasing`
--
ALTER TABLE `pengawasanasing`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `petakonflik`
--
ALTER TABLE `petakonflik`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `petalsm`
--
ALTER TABLE `petalsm`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `petaradikalisme`
--
ALTER TABLE `petaradikalisme`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `radikalisme`
--
ALTER TABLE `radikalisme`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `satker`
--
ALTER TABLE `satker`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `suaraparpol`
--
ALTER TABLE `suaraparpol`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `suarapilkada`
--
ALTER TABLE `suarapilkada`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `vaksinasi`
--
ALTER TABLE `vaksinasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bencana`
--
ALTER TABLE `bencana`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `konflik`
--
ALTER TABLE `konflik`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kota`
--
ALTER TABLE `kota`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `lsm`
--
ALTER TABLE `lsm`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `pakem`
--
ALTER TABLE `pakem`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `parpol`
--
ALTER TABLE `parpol`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `paslon`
--
ALTER TABLE `paslon`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengawasanasing`
--
ALTER TABLE `pengawasanasing`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `petakonflik`
--
ALTER TABLE `petakonflik`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `petalsm`
--
ALTER TABLE `petalsm`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `petaradikalisme`
--
ALTER TABLE `petaradikalisme`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `radikalisme`
--
ALTER TABLE `radikalisme`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `satker`
--
ALTER TABLE `satker`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `suaraparpol`
--
ALTER TABLE `suaraparpol`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `suarapilkada`
--
ALTER TABLE `suarapilkada`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `test`
--
ALTER TABLE `test`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `vaksinasi`
--
ALTER TABLE `vaksinasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
