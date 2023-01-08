-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2023 at 08:57 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_users`
--

CREATE TABLE `address_users` (
  `id_address` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `address` varchar(128) NOT NULL,
  `city` varchar(64) NOT NULL,
  `province` varchar(64) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address_users`
--

INSERT INTO `address_users` (`id_address`, `title`, `address`, `city`, `province`, `postcode`, `phone_number`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Home', 'Jl. Kiuju No.36 RT. 03/RW. 03 Kaujon Kidul', 'Serang', 'Banten', '42116', '085156066785', 4, '2023-01-01 16:47:42', '2023-01-01 18:05:44'),
(3, 'University', 'Jalan Jendral Sudirman No. 30 Panancangan Cipocok Jaya, Sumurpecung', 'Serang', 'Banten', '42118', '085156066784', 4, '2023-01-01 18:07:17', '2023-01-01 18:09:34'),
(4, 'Office', 'Jl. Universitas Serang Raya', 'Serang', 'Banten', '42111', '7063552100', 5, '2023-01-03 12:30:17', '2023-01-03 12:30:17'),
(5, 'rumah', 'jl kisahal', 'serang', 'banten', '42116', '085161232131', 6, '2023-01-04 11:26:43', '2023-01-04 11:26:43');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id_cart` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `size` int(42) NOT NULL,
  `quantity` int(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id_cart`, `user_id`, `product_id`, `color_id`, `size`, `quantity`, `created_at`, `updated_at`) VALUES
(14, 4, 1, 1, 42, 1, '2023-01-04 09:08:27', '2023-01-04 09:08:27');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `category_name` varchar(128) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Lifestyle', '2023-01-01 01:53:26', '2023-01-01 01:53:26'),
(2, 'Running', '2023-01-01 01:53:26', '2023-01-01 01:53:26'),
(3, 'Basketball', '2023-01-01 01:53:26', '2023-01-01 01:53:26'),
(4, 'Football', '2023-01-01 01:53:26', '2023-01-01 01:53:26'),
(5, 'Gym & Training', '2023-01-01 01:53:27', '2023-01-01 01:53:27');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(16, '2022-12-19-054915', 'App\\Database\\Migrations\\Users', 'default', 'App', 1672512766, 1),
(17, '2022-12-19-055607', 'App\\Database\\Migrations\\Admins', 'default', 'App', 1672512766, 1),
(18, '2022-12-19-055746', 'App\\Database\\Migrations\\Categories', 'default', 'App', 1672512767, 1),
(19, '2022-12-19-055747', 'App\\Database\\Migrations\\ProductColors', 'default', 'App', 1672512767, 1),
(20, '2022-12-19-060059', 'App\\Database\\Migrations\\Products', 'default', 'App', 1672512768, 1),
(21, '2022-12-19-060931', 'App\\Database\\Migrations\\ProductSizes', 'default', 'App', 1672512768, 1),
(22, '2022-12-20-202611', 'App\\Database\\Migrations\\Carts', 'default', 'App', 1672512768, 1),
(23, '2022-12-31-180306', 'App\\Database\\Migrations\\AddressUsers', 'default', 'App', 1672512769, 1),
(24, '2023-01-01-061222', 'App\\Database\\Migrations\\Transactions', 'default', 'App', 1672512770, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `photo` varchar(128) NOT NULL,
  `sold` int(128) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `product_name`, `description`, `price`, `photo`, `sold`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Air Force 1 x UNDEFEATED', 'Corrupti sunt et sed asperiores consequatur qui. Aut et omnis quos atque consequatur tenetur cum vel. Dicta explicabo nulla repudiandae. Sint adipisci deleniti sed qui aut ratione.', 1830714, '1.png', 2, 1, '2023-01-01 01:54:06', '2023-01-04 11:31:07'),
(2, 'Air Jordan 2 Retro Low Titan', 'Fuga dolore alias repellendus quam veritatis. In et maiores aliquam. Magnam voluptatem officiis ut distinctio. Ex non non ratione fugiat enim dolor animi.', 1122346, '2.png', 0, 1, '2023-01-01 01:54:06', '2023-01-01 01:54:06'),
(3, 'Air Jordan 5 x DJ Khaled', 'Maiores dolor quis ipsa laboriosam. Velit dolorum aliquid voluptas molestiae officia perferendis. Aperiam veritatis eaque quis ex est repudiandae suscipit.', 1380398, '3.png', 0, 1, '2023-01-01 01:54:06', '2023-01-01 01:54:06'),
(4, 'Nike Air Force 1 Low SP x UNDERCOVER', 'Recusandae et consequatur debitis molestias numquam dolore amet hic. Suscipit voluptate hic aperiam corporis quia non enim. Vel reiciendis vero enim saepe dolorem eaque in.', 1425854, '4.png', 0, 1, '2023-01-01 01:54:06', '2023-01-01 01:54:06'),
(5, 'Nike x Kasina Air Max 1 SP', 'Ipsa ut doloremque modi ipsum molestiae consequatur soluta aut. Ullam modi et ipsum exercitationem perspiciatis. Dignissimos ab itaque iste a.', 1915845, '5.png', 0, 1, '2023-01-01 01:54:06', '2023-01-01 01:54:06'),
(6, 'Nike Air Zoom Pegasus 38', 'Sunt omnis illo ut aut qui possimus voluptatem libero. Veritatis autem velit dolor quasi consequuntur id. Amet temporibus nemo quibusdam odit excepturi aut est.', 1328129, '1.png', 2, 2, '2023-01-01 01:54:06', '2023-01-04 11:31:07'),
(7, 'Nike Free Run 5.0', 'Dicta magni ut quia officia perferendis voluptas vel. Vel quo ut iure aut optio suscipit expedita. Quia optio perferendis nam qui et. Numquam amet voluptatem praesentium temporibus beatae omnis.', 1394971, '2.png', 0, 2, '2023-01-01 01:54:07', '2023-01-01 01:54:07'),
(8, 'Nike Pegasus Trail 3', 'Cumque illum est nesciunt soluta fugit. Possimus maxime laboriosam cupiditate a aut. Qui doloribus iusto sint rerum voluptate. Voluptatibus beatae explicabo qui dolor.', 1411780, '3.png', 0, 2, '2023-01-01 01:54:07', '2023-01-01 01:54:07'),
(9, 'Nike Zoom Fly 5 Premium', 'Ducimus beatae odio eaque odit. Sint aut voluptates illum non architecto quaerat eveniet. Ea aut et consectetur officia vitae quia nihil et. Dolorem sit commodi incidunt omnis.', 1061143, '4.png', 0, 2, '2023-01-01 01:54:07', '2023-01-01 01:54:07'),
(10, 'Nike ZoomX Streakfly', 'Suscipit voluptatem aut minima. Adipisci fugit facilis aspernatur voluptatem ullam est. Doloremque maiores aspernatur est quasi molestiae odio magnam.', 1842693, '5.png', 0, 2, '2023-01-01 01:54:07', '2023-01-01 01:54:07'),
(11, 'Jordan Stay Loyal 2', 'Autem eum sint aspernatur. Et saepe cum nulla tenetur ratione. Maiores facilis qui quae inventore.', 1162779, '1.png', 0, 3, '2023-01-01 01:54:07', '2023-01-01 01:54:07'),
(12, 'Kyrie Flytrap 6 EP', 'Quidem deleniti aliquid iste suscipit eum possimus omnis. Accusamus nihil quia aspernatur sed reiciendis ut.', 1450214, '2.png', 0, 3, '2023-01-01 01:54:07', '2023-01-01 01:54:07'),
(13, 'leBron 19 Low EP', 'Non est et in cupiditate consequuntur esse. Explicabo nostrum ipsum fugiat vero non. Blanditiis ipsa mollitia in enim ut consequatur.', 1236521, '3.png', 0, 3, '2023-01-01 01:54:07', '2023-01-01 01:54:07'),
(14, 'Luka 1 Next Nature PF', 'Quia placeat distinctio blanditiis velit ut placeat. Ut non nisi recusandae cupiditate natus sunt facilis ea.', 1602171, '4.png', 0, 3, '2023-01-01 01:54:07', '2023-01-01 01:54:07'),
(15, 'Nike Air Deldon Lyme', 'Sed delectus deleniti numquam. Qui non tempora minima sint voluptatem fugit. Qui possimus laudantium qui qui debitis sed.', 1000603, '5.png', 0, 3, '2023-01-01 01:54:07', '2023-01-01 01:54:07'),
(16, 'Nike Phantom GT2 Elite FG', 'Assumenda ut rerum et quibusdam voluptatem. Delectus consequuntur eligendi illum consequuntur quis qui. Aspernatur tenetur eum ratione ex.', 1310033, '1.png', 0, 4, '2023-01-01 01:54:07', '2023-01-01 01:54:07'),
(17, 'Nike Zoom Mercurial Superfly 9 Academy FG', 'Dolores magnam recusandae et quis aut eaque ad. Aut soluta iste molestias. Dolor error dicta rerum debitis reiciendis.', 1657243, '2.png', 0, 4, '2023-01-01 01:54:07', '2023-01-01 01:54:07'),
(18, 'Nike Zoom Mercurial Superfly 9 Elite KM FG', 'Quia magnam assumenda amet inventore accusamus corrupti. Et id et quia sequi. Vel velit nihil nihil sunt blanditiis corporis. Repellat incidunt soluta cupiditate facilis id.', 1910418, '3.png', 0, 4, '2023-01-01 01:54:07', '2023-01-01 01:54:07'),
(19, 'Nike Zoom Mercurial Vapor 15 Elite CR7 FG', 'Explicabo vel sit qui dolores tempore molestiae quibusdam distinctio. Consequatur minus dolorum deserunt sit. Suscipit dolorem culpa tenetur dolores.', 1533726, '4.png', 0, 4, '2023-01-01 01:54:07', '2023-01-01 01:54:07'),
(20, 'Nike Zoom Mercurial Vapor 15 Elite FG', 'Quo suscipit atque quae consequatur rerum nam. Rerum voluptas quibusdam animi magnam eum.', 1826118, '5.png', 0, 4, '2023-01-01 01:54:07', '2023-01-01 01:54:07'),
(21, 'Nike Air Max Alpha Trainer 4', 'Modi aut temporibus asperiores in quasi sit. Saepe in deleniti blanditiis fugit animi. Magnam excepturi ea facere. Sapiente consequatur voluptas blanditiis facilis autem cum dolores.', 1264973, '1.png', 0, 5, '2023-01-01 01:54:07', '2023-01-01 01:54:07'),
(22, 'Nike Defy All Day', 'In delectus cumque magni. Voluptatum sit iste ut vel. Asperiores sint repellat minima autem doloremque.', 1878340, '2.png', 0, 5, '2023-01-01 01:54:07', '2023-01-01 01:54:07'),
(23, 'Nike Free Metcon 4 AMP', 'Dolores maxime aut quasi sed qui quo voluptatem. Assumenda itaque cumque architecto reprehenderit dolore. Facere iusto quis accusantium blanditiis atque.', 1834890, '3.png', 0, 5, '2023-01-01 01:54:07', '2023-01-01 01:54:07'),
(24, 'Nike Metcon 7', 'Numquam consectetur eos ab architecto autem eligendi. Animi rerum id eum qui beatae quo sint vero. Asperiores voluptas aut aliquid veritatis odio odio consequatur.', 1398841, '4.png', 0, 5, '2023-01-01 01:54:07', '2023-01-01 01:54:07'),
(25, 'Nike SuperRep Go 3 Next Nature Flyknit', 'Officia dolore sed aliquam fugit velit cum reprehenderit. Ut perferendis at laudantium. Quo ipsa natus assumenda eveniet.', 1265064, '5.png', 0, 5, '2023-01-01 01:54:08', '2023-01-01 01:54:08'),
(26, 'Air Street', 'apa aja', 50000, '1672807286_adca59bf62740c118d30.jpg', 0, 1, '2023-01-03 22:41:26', '2023-01-03 22:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE `product_colors` (
  `id_product_color` int(11) NOT NULL,
  `color` varchar(64) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_colors`
--

INSERT INTO `product_colors` (`id_product_color`, `color`, `created_at`, `updated_at`) VALUES
(1, 'Black', '2023-01-01 01:53:39', '2023-01-01 01:53:39'),
(2, 'Red', '2023-01-01 01:53:39', '2023-01-01 01:53:39'),
(3, 'Blue', '2023-01-01 01:53:39', '2023-01-01 01:53:39');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id_product_size` int(11) NOT NULL,
  `size35` int(100) NOT NULL,
  `size36` int(100) NOT NULL,
  `size37` int(100) NOT NULL,
  `size38` int(100) NOT NULL,
  `size39` int(100) NOT NULL,
  `size40` int(100) NOT NULL,
  `size41` int(100) NOT NULL,
  `size42` int(100) NOT NULL,
  `color_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id_product_size`, `size35`, `size36`, `size37`, `size38`, `size39`, `size40`, `size41`, `size42`, `color_id`, `product_id`, `created_at`, `updated_at`) VALUES
(2, 0, 0, 28, 51, 84, 71, 50, 87, 1, 1, '2023-01-01 01:54:11', '2023-01-04 11:31:07'),
(3, 65, 51, 87, 82, 61, 57, 92, 92, 2, 1, '2023-01-01 01:54:11', '2023-01-01 01:54:11'),
(4, 79, 68, 24, 12, 66, 31, 99, 71, 3, 1, '2023-01-01 01:54:11', '2023-01-01 01:54:11'),
(5, 72, 12, 34, 42, 17, 62, 41, 2, 1, 2, '2023-01-01 01:54:11', '2023-01-01 01:54:11'),
(6, 15, 11, 36, 37, 26, 47, 63, 4, 2, 2, '2023-01-01 01:54:11', '2023-01-01 01:54:11'),
(7, 37, 84, 64, 75, 20, 92, 12, 25, 3, 2, '2023-01-01 01:54:11', '2023-01-01 01:54:11'),
(8, 1, 33, 45, 86, 64, 22, 19, 90, 1, 3, '2023-01-01 01:54:11', '2023-01-01 01:54:11'),
(9, 37, 3, 41, 19, 20, 80, 78, 21, 2, 3, '2023-01-01 01:54:11', '2023-01-01 01:54:11'),
(10, 85, 98, 70, 93, 17, 10, 93, 26, 3, 3, '2023-01-01 01:54:11', '2023-01-01 01:54:11'),
(11, 96, 25, 46, 15, 85, 32, 67, 48, 1, 4, '2023-01-01 01:54:11', '2023-01-01 01:54:11'),
(12, 5, 28, 32, 55, 41, 34, 90, 25, 2, 4, '2023-01-01 01:54:11', '2023-01-01 01:54:11'),
(13, 7, 75, 78, 15, 77, 21, 52, 66, 3, 4, '2023-01-01 01:54:11', '2023-01-01 01:54:11'),
(14, 17, 35, 48, 57, 66, 68, 36, 20, 1, 5, '2023-01-01 01:54:12', '2023-01-01 01:54:12'),
(15, 95, 85, 29, 96, 28, 72, 85, 6, 2, 5, '2023-01-01 01:54:12', '2023-01-01 01:54:12'),
(16, 12, 26, 85, 69, 90, 38, 42, 76, 3, 5, '2023-01-01 01:54:12', '2023-01-01 01:54:12'),
(17, 66, 66, 61, 68, 16, 91, 89, 72, 1, 6, '2023-01-01 01:54:12', '2023-01-01 01:54:12'),
(18, 32, 32, 100, 50, 72, 34, 87, 86, 2, 6, '2023-01-01 01:54:12', '2023-01-04 11:31:07'),
(19, 1, 27, 6, 98, 48, 65, 53, 1, 3, 6, '2023-01-01 01:54:12', '2023-01-01 01:54:12'),
(20, 66, 64, 20, 8, 37, 78, 92, 67, 1, 7, '2023-01-01 01:54:12', '2023-01-01 01:54:12'),
(21, 23, 74, 29, 55, 13, 14, 47, 55, 2, 7, '2023-01-01 01:54:12', '2023-01-01 01:54:12'),
(22, 83, 43, 25, 57, 61, 27, 47, 89, 3, 7, '2023-01-01 01:54:12', '2023-01-01 01:54:12'),
(23, 30, 33, 87, 96, 67, 5, 45, 95, 1, 8, '2023-01-01 01:54:12', '2023-01-01 01:54:12'),
(24, 86, 13, 90, 67, 29, 50, 78, 91, 2, 8, '2023-01-01 01:54:12', '2023-01-01 01:54:12'),
(25, 51, 78, 91, 64, 96, 45, 33, 9, 3, 8, '2023-01-01 01:54:12', '2023-01-01 01:54:12'),
(26, 22, 40, 42, 28, 75, 31, 59, 0, 1, 9, '2023-01-01 01:54:12', '2023-01-04 08:40:38'),
(27, 99, 36, 42, 97, 22, 11, 37, 2, 2, 9, '2023-01-01 01:54:12', '2023-01-01 01:54:12'),
(28, 63, 57, 86, 47, 62, 50, 60, 38, 3, 9, '2023-01-01 01:54:12', '2023-01-01 01:54:12'),
(29, 65, 26, 24, 34, 40, 36, 73, 23, 1, 10, '2023-01-01 01:54:12', '2023-01-01 01:54:12'),
(30, 8, 70, 39, 42, 85, 63, 49, 18, 2, 10, '2023-01-01 01:54:12', '2023-01-01 01:54:12'),
(31, 62, 66, 15, 20, 9, 50, 44, 49, 3, 10, '2023-01-01 01:54:12', '2023-01-01 01:54:12'),
(32, 57, 76, 71, 80, 98, 67, 8, 86, 1, 11, '2023-01-01 01:54:12', '2023-01-01 01:54:12'),
(33, 35, 36, 86, 33, 6, 51, 41, 23, 2, 11, '2023-01-01 01:54:13', '2023-01-01 01:54:13'),
(34, 41, 61, 15, 74, 18, 57, 54, 82, 3, 11, '2023-01-01 01:54:13', '2023-01-01 01:54:13'),
(35, 17, 82, 88, 27, 58, 54, 71, 91, 1, 12, '2023-01-01 01:54:13', '2023-01-01 01:54:13'),
(36, 47, 33, 97, 26, 53, 27, 73, 12, 2, 12, '2023-01-01 01:54:13', '2023-01-01 01:54:13'),
(37, 96, 44, 37, 17, 67, 60, 25, 35, 3, 12, '2023-01-01 01:54:13', '2023-01-01 01:54:13'),
(38, 86, 23, 82, 9, 39, 66, 88, 32, 1, 13, '2023-01-01 01:54:13', '2023-01-01 01:54:13'),
(39, 36, 28, 39, 32, 73, 78, 53, 37, 2, 13, '2023-01-01 01:54:13', '2023-01-01 01:54:13'),
(40, 35, 1, 51, 27, 10, 59, 84, 74, 3, 13, '2023-01-01 01:54:13', '2023-01-01 01:54:13'),
(41, 38, 97, 84, 5, 62, 6, 71, 62, 1, 14, '2023-01-01 01:54:13', '2023-01-01 01:54:13'),
(42, 77, 2, 10, 68, 90, 25, 9, 42, 2, 14, '2023-01-01 01:54:13', '2023-01-01 01:54:13'),
(43, 56, 10, 41, 27, 82, 41, 50, 77, 3, 14, '2023-01-01 01:54:13', '2023-01-01 01:54:13'),
(44, 46, 60, 4, 29, 94, 88, 80, 18, 1, 15, '2023-01-01 01:54:13', '2023-01-01 01:54:13'),
(45, 30, 52, 77, 56, 61, 67, 21, 29, 2, 15, '2023-01-01 01:54:13', '2023-01-01 01:54:13'),
(46, 91, 6, 59, 76, 97, 87, 14, 73, 3, 15, '2023-01-01 01:54:13', '2023-01-01 01:54:13'),
(47, 91, 99, 6, 88, 68, 74, 58, 82, 1, 16, '2023-01-01 01:54:14', '2023-01-01 01:54:14'),
(48, 30, 78, 18, 94, 18, 12, 99, 55, 2, 16, '2023-01-01 01:54:14', '2023-01-01 01:54:14'),
(49, 27, 11, 14, 60, 80, 57, 50, 16, 3, 16, '2023-01-01 01:54:14', '2023-01-01 01:54:14'),
(50, 55, 38, 88, 58, 71, 66, 70, 1, 1, 17, '2023-01-01 01:54:14', '2023-01-01 01:54:14'),
(51, 20, 10, 51, 64, 29, 40, 65, 62, 2, 17, '2023-01-01 01:54:14', '2023-01-01 01:54:14'),
(52, 22, 15, 79, 18, 40, 93, 34, 70, 3, 17, '2023-01-01 01:54:14', '2023-01-01 01:54:14'),
(53, 39, 14, 72, 4, 56, 60, 81, 88, 1, 18, '2023-01-01 01:54:14', '2023-01-01 01:54:14'),
(54, 15, 44, 63, 72, 68, 77, 16, 98, 2, 18, '2023-01-01 01:54:14', '2023-01-01 01:54:14'),
(55, 3, 29, 66, 36, 17, 20, 74, 12, 3, 18, '2023-01-01 01:54:14', '2023-01-01 01:54:14'),
(56, 38, 15, 21, 11, 25, 82, 81, 82, 1, 19, '2023-01-01 01:54:14', '2023-01-01 01:54:14'),
(57, 18, 38, 69, 41, 50, 72, 71, 34, 2, 19, '2023-01-01 01:54:14', '2023-01-01 01:54:14'),
(58, 66, 33, 38, 78, 20, 32, 26, 90, 3, 19, '2023-01-01 01:54:14', '2023-01-01 01:54:14'),
(59, 95, 10, 65, 44, 5, 8, 84, 80, 1, 20, '2023-01-01 01:54:14', '2023-01-01 01:54:14'),
(60, 6, 5, 23, 35, 22, 29, 66, 93, 2, 20, '2023-01-01 01:54:14', '2023-01-01 01:54:14'),
(61, 4, 33, 28, 75, 48, 71, 35, 16, 3, 20, '2023-01-01 01:54:14', '2023-01-01 01:54:14'),
(62, 67, 70, 65, 11, 2, 78, 62, 17, 1, 21, '2023-01-01 01:54:14', '2023-01-01 01:54:14'),
(63, 88, 85, 1, 51, 31, 21, 91, 51, 2, 21, '2023-01-01 01:54:14', '2023-01-01 01:54:14'),
(64, 60, 11, 51, 21, 79, 55, 42, 87, 3, 21, '2023-01-01 01:54:15', '2023-01-01 01:54:15'),
(65, 95, 18, 6, 16, 80, 89, 30, 36, 1, 22, '2023-01-01 01:54:15', '2023-01-01 01:54:15'),
(66, 68, 28, 34, 63, 71, 41, 91, 11, 2, 22, '2023-01-01 01:54:15', '2023-01-01 01:54:15'),
(67, 2, 93, 35, 26, 62, 79, 75, 98, 3, 22, '2023-01-01 01:54:15', '2023-01-01 01:54:15'),
(68, 15, 51, 76, 90, 29, 59, 12, 33, 1, 23, '2023-01-01 01:54:15', '2023-01-01 01:54:15'),
(69, 41, 25, 81, 27, 30, 39, 76, 20, 2, 23, '2023-01-01 01:54:15', '2023-01-01 01:54:15'),
(70, 35, 31, 6, 31, 42, 39, 14, 73, 3, 23, '2023-01-01 01:54:15', '2023-01-01 01:54:15'),
(71, 42, 94, 39, 5, 68, 9, 42, 62, 1, 24, '2023-01-01 01:54:15', '2023-01-01 01:54:15'),
(72, 7, 77, 37, 63, 69, 21, 8, 93, 2, 24, '2023-01-01 01:54:15', '2023-01-01 01:54:15'),
(73, 57, 93, 90, 56, 91, 97, 95, 31, 3, 24, '2023-01-01 01:54:15', '2023-01-01 01:54:15'),
(74, 79, 71, 16, 88, 99, 42, 87, 30, 1, 25, '2023-01-01 01:54:15', '2023-01-01 01:54:15'),
(75, 58, 47, 8, 65, 96, 10, 97, 73, 2, 25, '2023-01-01 01:54:15', '2023-01-01 01:54:15'),
(76, 5, 46, 9, 8, 74, 68, 28, 9, 3, 25, '2023-01-01 01:54:15', '2023-01-01 01:54:15'),
(77, 10, 10, 10, 10, 10, 10, 10, 10, 2, 26, '2023-01-03 22:44:29', '2023-01-03 22:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id_transaction` int(11) NOT NULL,
  `quantity` int(100) NOT NULL,
  `size` int(42) NOT NULL,
  `order_notes` varchar(256) NOT NULL,
  `status` varchar(5) NOT NULL,
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `order_id` varchar(128) DEFAULT NULL,
  `snap_token` varchar(256) DEFAULT NULL,
  `payment_deadline` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id_transaction`, `quantity`, `size`, `order_notes`, `status`, `address_id`, `user_id`, `product_id`, `color_id`, `order_id`, `snap_token`, `payment_deadline`, `created_at`, `updated_at`) VALUES
(1, 1, 39, '', '0', 2, 4, 4, 2, NULL, NULL, NULL, '2023-01-01 19:42:03', '2023-01-02 18:18:16'),
(2, 2, 41, '', '4', 3, 4, 3, 1, NULL, NULL, NULL, '2023-01-02 02:34:17', '2023-01-03 08:10:11'),
(3, 1, 42, '', '4', 3, 4, 6, 3, NULL, NULL, NULL, '2023-01-02 02:34:17', '2023-01-03 08:10:11'),
(4, 1, 41, '', '0', 3, 4, 5, 1, NULL, NULL, NULL, '2023-01-02 03:15:19', '2023-01-02 18:18:06'),
(7, 1, 41, '', '0', 2, 4, 2, 1, NULL, NULL, NULL, '2023-01-03 04:50:22', '2023-01-03 04:51:19'),
(8, 1, 42, '', '4', 2, 4, 8, 1, NULL, NULL, NULL, '2023-01-03 04:52:30', '2023-01-03 07:33:06'),
(9, 1, 42, '', '4', 2, 4, 9, 1, NULL, NULL, NULL, '2023-01-03 05:14:57', '2023-01-04 08:40:38'),
(10, 3, 37, '', '1', 4, 5, 10, 3, NULL, NULL, NULL, '2023-01-03 12:31:14', '2023-01-03 12:31:14'),
(11, 1, 35, 'Secepatnya yah', '4', 2, 4, 1, 1, NULL, NULL, NULL, '2023-01-04 08:44:49', '2023-01-04 08:53:00'),
(12, 1, 36, 'Secepatnya ya gan', '4', 2, 4, 1, 1, NULL, NULL, NULL, '2023-01-04 08:59:13', '2023-01-04 09:00:08'),
(13, 1, 37, 'Secepatnya ya gan', '4', 2, 4, 1, 1, NULL, NULL, NULL, '2023-01-04 09:01:39', '2023-01-04 09:07:25'),
(14, 1, 38, '', '4', 5, 6, 1, 1, NULL, NULL, NULL, '2023-01-04 11:27:36', '2023-01-04 11:31:07'),
(15, 2, 41, '', '4', 5, 6, 6, 2, NULL, NULL, NULL, '2023-01-04 11:27:36', '2023-01-04 11:31:07'),
(16, 1, 40, '', '3', 5, 6, 2, 1, NULL, NULL, NULL, '2023-01-04 11:32:02', '2023-01-04 11:33:21'),
(17, 1, 40, '', '1', 5, 6, 3, 2, NULL, NULL, NULL, '2023-01-04 11:34:33', '2023-01-04 11:34:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `user_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `user_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Braden Luettgen', 'pcrist@hotmail.com', '$2y$10$7VQ2OSCry63sqA5a3hvs6.PdhwHmihw79Z9NRihg1AyRaRZ2lPOM6', '2023-01-01 01:52:58', '2023-01-01 01:52:58'),
(2, 'Rico Kilback IV', 'lakin.jennie@yahoo.com', '$2y$10$zRRAAjPGzSsdxgWG1CPyFOAdbcPjRJMRz.VmDwsNrr7NnLydoHHuW', '2023-01-01 01:52:58', '2023-01-01 01:52:58'),
(3, 'Adela Hermann', 'kuvalis.myriam@langworth.com', '$2y$10$9e7euVcH9sdNNJlbl8H1luUDE/pINZneiVs0kKqIWG.CwDoEYFcbi', '2023-01-01 01:52:58', '2023-01-01 01:52:58'),
(4, 'Rizka Marifatul Awaliah', 'rizkamrftl@gmail.com', '$2y$10$izlmW7PKRd8vEsvN3Oq5F..aziBiU7r1sfq08lEbFEHJcWfV/9VYy', '2023-01-01 01:57:50', '2023-01-01 01:57:50'),
(5, 'ujang', 'ujang@mail.com', '$2y$10$FamqiIQXJLaQpW1hfiQemuQWQg8PZEwuhcfVm63ozXK5c/xylOT/S', '2023-01-03 12:27:14', '2023-01-03 12:27:14'),
(6, 'novandi', 'novandi@gmail.com', '$2y$10$OngdP0eSOlsgNa2mQ23mVeaASZr3tehY0buZqmKADyuKNIBq.Ir1C', '2023-01-04 11:22:46', '2023-01-04 11:22:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_users`
--
ALTER TABLE `address_users`
  ADD PRIMARY KEY (`id_address`),
  ADD KEY `address_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_color_id_foreign` (`color_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id_product_color`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id_product_size`),
  ADD KEY `product_sizes_product_id_foreign` (`product_id`),
  ADD KEY `product_sizes_color_id_foreign` (`color_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `transactions_address_id_foreign` (`address_id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_product_id_foreign` (`product_id`),
  ADD KEY `transactions_color_id_foreign` (`color_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address_users`
--
ALTER TABLE `address_users`
  MODIFY `id_address` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id_product_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id_product_size` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address_users`
--
ALTER TABLE `address_users`
  ADD CONSTRAINT `address_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `product_colors` (`id_product_color`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `product_colors` (`id_product_color`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_sizes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `address_users` (`id_address`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `product_colors` (`id_product_color`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
