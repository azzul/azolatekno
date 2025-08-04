-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2025 at 10:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `azolatekno`
--

-- --------------------------------------------------------

--
-- Table structure for table `meta_tags`
--

CREATE TABLE `meta_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `og_title` varchar(255) DEFAULT NULL,
  `og_description` varchar(255) DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meta_tags`
--

INSERT INTO `meta_tags` (`id`, `page`, `title`, `description`, `keywords`, `og_title`, `og_description`, `og_image`, `created_at`, `updated_at`) VALUES
(1, 'index', 'Azolatekno: Jasa Pembuatan Website, SEO & Integrasi AI Profesional', 'Azolatekno adalah perusahaan teknologi sejak 2018 yang menyediakan layanan pembuatan website, SEO Top Google, integrasi AI, dan kursus online bersertifikat.', 'jasa pembuatan website, jasa SEO profesional, integrasi AI bisnis, kursus AI online, jasa digital terpercaya, azolatekno', 'Pembuatan Web, SEO & AI - Azolatekno', 'Bersama Azolatekno, kembangkan bisnis Anda dengan website profesional, SEO Page One, dan teknologi AI modern.', 'img/azolatekno-share.jpg', '2025-08-04 08:54:40', '2025-08-04 08:54:40'),
(2, 'pricelist', 'Harga Layanan Website, SEO & AI - Paket Hemat & Profesional | Azolatekno', 'Lihat daftar harga jasa pembuatan website, layanan SEO bulanan, integrasi AI, dan kursus AI di Azolatekno. Mulai dari Rp 500 ribuan.', 'harga jasa pembuatan website, paket SEO murah, biaya integrasi AI, daftar harga kursus AI, azolatekno pricelist', 'Daftar Harga Layanan - Azolatekno', 'Cek harga pembuatan website, SEO Top Google, dan layanan AI terpercaya untuk bisnis digital Anda.', 'img/azolatekno-share.jpg', '2025-08-04 08:54:40', '2025-08-04 08:54:40'),
(3, 'testimonial', 'Testimoni Klien Azolatekno: Website Page 1 Google & Layanan AI Profesional', 'Baca ulasan asli dari klien Azolatekno yang sukses tampil di halaman pertama Google dan menikmati layanan teknologi terbaik.', 'testimoni jasa SEO, review pembuatan website, testimoni integrasi AI, ulasan azolatekno, pengalaman kursus AI', 'Review & Testimoni Klien - Azolatekno', 'Testimoni nyata dari klien kami yang puas dengan layanan web development, SEO, dan AI dari Azolatekno.', 'img/azolatekno-share.jpg', '2025-08-04 08:54:40', '2025-08-04 08:54:40'),
(4, 'layanan', 'Jasa Website, SEO, Kursus & Integrasi AI Terpercaya | Azolatekno', 'Azolatekno menawarkan solusi digital mulai dari jasa pembuatan website, SEO bulanan, integrasi AI, hingga kursus AI. Cocok untuk bisnis modern.', 'layanan digital indonesia, jasa SEO terbaik, pembuatan web murah, kursus AI online, integrasi AI untuk bisnis', 'Layanan Digital Terintegrasi - Azolatekno', 'Azolatekno siap mendampingi bisnis Anda melalui layanan teknologi masa kini: Website, SEO, AI, dan Kursus Online.', 'img/azolatekno-share.jpg', '2025-08-04 08:54:40', '2025-08-04 08:54:40'),
(5, 'privacy-policy', 'Kebijakan Privasi Layanan Digital & AI - Azolatekno', 'Baca bagaimana Azolatekno menjaga keamanan data Anda saat menggunakan layanan pembuatan website, SEO, dan AI.', 'kebijakan privasi web digital, keamanan data pelanggan, privasi layanan teknologi, privasi pengguna kursus AI', 'Kebijakan Privasi - Azolatekno', 'Privasi Anda adalah prioritas kami. Azolatekno menjaga data Anda dengan standar tertinggi untuk semua layanan digital.', 'img/azolatekno-share.jpg', '2025-08-04 08:54:40', '2025-08-04 08:54:40'),
(6, 'terms-conditions', 'Syarat & Ketentuan Layanan Website, SEO & AI | Azolatekno', 'Pelajari syarat layanan pembuatan web, SEO, dan AI dari Azolatekno. Semua layanan dilakukan dengan transparansi dan profesionalitas.', 'syarat jasa website, ketentuan layanan SEO, aturan integrasi AI, syarat penggunaan kursus online', 'Syarat & Ketentuan - Azolatekno', 'Azolatekno memberikan layanan digital dengan aturan transparan untuk kenyamanan dan kejelasan klien.', 'img/azolatekno-share.jpg', '2025-08-04 08:54:40', '2025-08-04 08:54:40'),
(7, 'license-info', 'Legalitas & Portofolio Azolatekno - Jasa Teknologi Tepercaya Sejak 2018', 'Azolatekno adalah penyedia layanan teknologi dengan klien resmi, project legal, dan kredibilitas tinggi sejak tahun 2018.', 'legalitas perusahaan digital, izin usaha jasa teknologi, legal AI indonesia, portofolio website SEO', 'Legalitas Usaha - Azolatekno', 'Azolatekno telah dipercaya sejak 2018 dengan legalitas resmi dan rekam jejak klien nasional.', 'img/azolatekno-share.jpg', '2025-08-04 08:54:40', '2025-08-04 08:54:40'),
(8, 'about-us', 'Tentang Azolatekno: Partner Digital & AI Sejak 2018', 'Azolatekno telah membantu banyak bisnis masuk halaman 1 Google dengan layanan website, SEO, AI dan kursus yang inovatif dan terpercaya.', 'tentang azolatekno, jasa teknologi terpercaya, penyedia kursus AI indonesia, agensi SEO terbaik, profil perusahaan digital', 'Kenali Azolatekno - Partner Teknologi Anda', 'Berdiri sejak 2018, Azolatekno hadir sebagai solusi digital masa kini: dari web development hingga AI integrasi.', 'img/azolatekno-share.jpg', '2025-08-04 08:54:40', '2025-08-04 08:54:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meta_tags`
--
ALTER TABLE `meta_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `meta_tags_page_unique` (`page`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meta_tags`
--
ALTER TABLE `meta_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
