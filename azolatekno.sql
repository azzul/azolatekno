# Host: localhost  (Version 5.5.5-10.4.32-MariaDB)
# Date: 2026-08-22 14:00:17
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "brand"
#

DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `id_brand` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(40) NOT NULL,
  `img_brand` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_brand`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Structure for table "cache"
#

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Structure for table "cache_locks"
#

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Structure for table "custom_content"
#

DROP TABLE IF EXISTS `custom_content`;
CREATE TABLE `custom_content` (
  `id_content` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(230) NOT NULL,
  `slug_content` varchar(210) NOT NULL,
  `short_desc` text NOT NULL,
  `isi` longtext NOT NULL,
  `keyword` text NOT NULL,
  `img_content` varchar(50) NOT NULL,
  `img_medium` varchar(50) NOT NULL,
  `img_small` varchar(50) NOT NULL,
  `kategori_konten` varchar(50) NOT NULL,
  `page_name` varchar(40) NOT NULL,
  `is_product` char(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_content`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Structure for table "etalase_kategori"
#

DROP TABLE IF EXISTS `etalase_kategori`;
CREATE TABLE `etalase_kategori` (
  `id_etalase` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_kategori` bigint(20) unsigned NOT NULL,
  `etalase` varchar(100) NOT NULL,
  `img_etalase` varchar(100) NOT NULL,
  `is_show` varchar(2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_etalase`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Structure for table "failed_jobs"
#

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Structure for table "galeri_produk"
#

DROP TABLE IF EXISTS `galeri_produk`;
CREATE TABLE `galeri_produk` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `kode_produk` char(30) NOT NULL,
  `src_image` text NOT NULL,
  `is_utama` char(2) NOT NULL,
  `desc_image` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=InnoDB AUTO_INCREMENT=1255 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Structure for table "harga"
#

DROP TABLE IF EXISTS `harga`;
CREATE TABLE `harga` (
  `id_harga` int(11) NOT NULL AUTO_INCREMENT,
  `kode_produk` char(30) NOT NULL,
  `kode_jharga` varchar(15) NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `diskon` decimal(4,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_harga`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Structure for table "jenis_harga"
#

DROP TABLE IF EXISTS `jenis_harga`;
CREATE TABLE `jenis_harga` (
  `id_jharga` int(2) NOT NULL AUTO_INCREMENT,
  `kode_jharga` varchar(15) NOT NULL,
  `jenis_harga` varchar(255) NOT NULL,
  `qty` decimal(10,2) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_jharga`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Structure for table "job_batches"
#

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Structure for table "jobs"
#

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Structure for table "kategori"
#

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id_kategori` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) NOT NULL,
  `img_kategori` varchar(255) NOT NULL,
  `slug_kategori` varchar(100) NOT NULL,
  `kode_ktgtipe` char(6) NOT NULL,
  `tipe_kategori` varchar(30) NOT NULL,
  `id_ukategori` int(5) DEFAULT NULL,
  `deskripsi_kategori` varchar(100) NOT NULL,
  `is_active` char(2) NOT NULL,
  `no_urut` int(3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kategori`),
  UNIQUE KEY `slug_kategori` (`slug_kategori`),
  KEY `kode_ktgtipe` (`kode_ktgtipe`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Structure for table "kategori_tipe"
#

DROP TABLE IF EXISTS `kategori_tipe`;
CREATE TABLE `kategori_tipe` (
  `id_ktgtipe` int(5) NOT NULL AUTO_INCREMENT,
  `kode_ktgtipe` char(6) NOT NULL,
  `tipe_kategori` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`kode_ktgtipe`),
  UNIQUE KEY `id_ktgtipe` (`id_ktgtipe`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Structure for table "kategori_utama"
#

DROP TABLE IF EXISTS `kategori_utama`;
CREATE TABLE `kategori_utama` (
  `id_ukategori` int(5) NOT NULL AUTO_INCREMENT,
  `kategori_utama` varchar(50) NOT NULL,
  `no_urut` int(3) NOT NULL,
  `is_active` char(3) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id_ukategori`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Structure for table "konten"
#

DROP TABLE IF EXISTS `konten`;
CREATE TABLE `konten` (
  `id_konten` int(11) NOT NULL AUTO_INCREMENT,
  `nama_konten` text NOT NULL,
  `judul` text NOT NULL,
  `konten` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_konten`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Structure for table "konten_etalase_kategori"
#

DROP TABLE IF EXISTS `konten_etalase_kategori`;
CREATE TABLE `konten_etalase_kategori` (
  `id_ekonten` int(11) NOT NULL AUTO_INCREMENT,
  `id_etalase` bigint(20) NOT NULL,
  `judul` text NOT NULL,
  `isi` text NOT NULL,
  `jenis_konten` varchar(30) NOT NULL,
  `img_konten` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_ekonten`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Structure for table "konten_home"
#

DROP TABLE IF EXISTS `konten_home`;
CREATE TABLE `konten_home` (
  `id_konten` int(11) NOT NULL AUTO_INCREMENT,
  `konten` text NOT NULL,
  `img_konten` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_konten`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Structure for table "konten_kategori"
#

DROP TABLE IF EXISTS `konten_kategori`;
CREATE TABLE `konten_kategori` (
  `id_konten` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` bigint(20) NOT NULL,
  `long_desc` text NOT NULL,
  `penggunaan` text NOT NULL,
  `perawatan` text NOT NULL,
  `img_konten` varchar(40) NOT NULL,
  `src_video` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_konten`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Structure for table "meta_tags"
#

DROP TABLE IF EXISTS `meta_tags`;
CREATE TABLE `meta_tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `og_title` varchar(255) DEFAULT NULL,
  `og_description` varchar(255) DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `meta_tags_page_unique` (`page`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Structure for table "migrations"
#

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Structure for table "parameter_variasi"
#

DROP TABLE IF EXISTS `parameter_variasi`;
CREATE TABLE `parameter_variasi` (
  `id_parameter` bigint(20) NOT NULL AUTO_INCREMENT,
  `parameter` varchar(70) NOT NULL,
  `id_kategori` bigint(20) NOT NULL,
  `is_required` char(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_parameter`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Structure for table "password_reset_tokens"
#

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Structure for table "produk"
#

DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk` (
  `id_produk` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_kategori` int(20) unsigned NOT NULL,
  `kode_produk` char(30) NOT NULL,
  `nama_produk` varchar(120) NOT NULL,
  `image_produk` varchar(50) NOT NULL,
  `spesifikasi` text NOT NULL,
  `long_desc` text DEFAULT NULL,
  `short_desc` varchar(120) NOT NULL,
  `slug_produk` varchar(255) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `is_available` char(2) NOT NULL,
  `judul_meta` varchar(150) NOT NULL,
  `desc_meta` varchar(250) NOT NULL,
  `keyword` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_produk`),
  UNIQUE KEY `kode_produk` (`kode_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Structure for table "promo_home"
#

DROP TABLE IF EXISTS `promo_home`;
CREATE TABLE `promo_home` (
  `id_homeprm` int(11) NOT NULL AUTO_INCREMENT,
  `promo_text` text NOT NULL,
  `promo_image` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_homeprm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Structure for table "sessions"
#

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Structure for table "settings"
#

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id_setting` int(11) NOT NULL AUTO_INCREMENT,
  `setting_name` char(20) NOT NULL,
  `status` char(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_setting`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Structure for table "stok"
#

DROP TABLE IF EXISTS `stok`;
CREATE TABLE `stok` (
  `id_stok` int(11) NOT NULL AUTO_INCREMENT,
  `sku` char(30) NOT NULL,
  `kode_produk` char(20) NOT NULL,
  `qty` decimal(6,2) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_stok`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Structure for table "toko"
#

DROP TABLE IF EXISTS `toko`;
CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `kode_toko` char(10) NOT NULL,
  `nama_toko` varchar(50) NOT NULL,
  `phone_toko` varchar(20) NOT NULL,
  `wa_toko` char(15) NOT NULL,
  `foto_toko` varchar(30) DEFAULT NULL,
  `alamat` text NOT NULL,
  `company` varchar(70) NOT NULL,
  `kota` varchar(70) NOT NULL,
  `provinsi` varchar(70) NOT NULL,
  `kode_pos` int(8) NOT NULL,
  `kota_terdekat` text NOT NULL,
  `latitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `link_gmaps` text NOT NULL,
  `iframe_gmaps` text NOT NULL,
  `nama_gmaps` text NOT NULL,
  `slug_toko` varchar(50) NOT NULL,
  `long_desc` text NOT NULL,
  PRIMARY KEY (`id_toko`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Structure for table "users"
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Structure for table "variasi_produk"
#

DROP TABLE IF EXISTS `variasi_produk`;
CREATE TABLE `variasi_produk` (
  `id_variasi` int(11) NOT NULL AUTO_INCREMENT,
  `kode_variasi` char(40) NOT NULL,
  `kode_produk` char(30) NOT NULL,
  `atribut` varchar(100) NOT NULL,
  `value` varchar(150) NOT NULL,
  `is_variasi_utama` char(3) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_variasi`),
  UNIQUE KEY `kode_variasi` (`kode_variasi`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Structure for table "warna"
#

DROP TABLE IF EXISTS `warna`;
CREATE TABLE `warna` (
  `id_warna` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_warna` char(20) NOT NULL,
  `nama_warna` varchar(120) NOT NULL,
  `color_name` varchar(120) NOT NULL,
  `hex_color` char(7) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_warna`),
  UNIQUE KEY `kode_warna` (`kode_warna`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
