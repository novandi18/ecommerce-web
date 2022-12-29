-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2022 at 07:46 AM
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
  `size` int(42) NOT NULL,
  `color_id` int(11) NOT NULL,
  `quantity` int(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id_cart`, `user_id`, `product_id`, `size`, `color_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 5, 2, 38, 1, 1, '2022-12-27 20:37:48', '2022-12-27 20:37:48');

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
(1, 'Lifestyle', '2022-12-21 05:12:58', '2022-12-21 05:12:58'),
(2, 'Running', '2022-12-21 05:12:59', '2022-12-21 05:12:59'),
(3, 'Basketball', '2022-12-21 05:12:59', '2022-12-21 05:12:59'),
(4, 'Football', '2022-12-21 05:12:59', '2022-12-21 05:12:59'),
(5, 'Gym & Training', '2022-12-21 05:12:59', '2022-12-21 05:12:59');

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
(123, '2022-12-19-054915', 'App\\Database\\Migrations\\Users', 'default', 'App', 1671574130, 1),
(124, '2022-12-19-055607', 'App\\Database\\Migrations\\Admins', 'default', 'App', 1671574131, 1),
(125, '2022-12-19-055746', 'App\\Database\\Migrations\\Categories', 'default', 'App', 1671574131, 1),
(126, '2022-12-19-055747', 'App\\Database\\Migrations\\ProductColors', 'default', 'App', 1671574132, 1),
(127, '2022-12-19-060059', 'App\\Database\\Migrations\\Products', 'default', 'App', 1671574132, 1),
(128, '2022-12-19-060931', 'App\\Database\\Migrations\\ProductSizes', 'default', 'App', 1671574132, 1),
(129, '2022-12-19-061227', 'App\\Database\\Migrations\\Transactions', 'default', 'App', 1671574133, 1),
(130, '2022-12-20-202611', 'App\\Database\\Migrations\\Carts', 'default', 'App', 1671574133, 1);

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
  `sold` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `product_name`, `description`, `price`, `photo`, `sold`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Air Force 1 x UNDEFEATED', 'Non numquam ducimus eos molestias. Dolores ad nisi voluptas ipsum officia accusamus. Et voluptatum aut dolorem repudiandae. Totam et iusto sed facere fugit rem quidem omnis.', 1927832, '1.png', 0, 1, '2022-12-21 05:13:22', '2022-12-21 05:13:22'),
(2, 'Air Jordan 2 Retro Low Titan', 'Alias eos omnis laborum sed modi. Non voluptas aut iste molestiae commodi. Temporibus accusantium dolorum dicta qui optio qui. Voluptates impedit voluptatem molestiae corporis minus sed.', 1595411, '2.png', 0, 1, '2022-12-21 05:13:22', '2022-12-21 05:13:22'),
(3, 'Air Jordan 5 x DJ Khaled', 'Libero suscipit voluptatem ipsam repellendus. Et praesentium tempore iste veritatis. Ipsum et eos numquam voluptatum. Sunt non vitae id et.', 1572228, '3.png', 0, 1, '2022-12-21 05:13:22', '2022-12-21 05:13:22'),
(4, 'Nike Air Force 1 Low SP x UNDERCOVER', 'Nobis est voluptas voluptas necessitatibus et necessitatibus. Suscipit sit vitae voluptatem temporibus doloremque tempora quia perferendis. Praesentium quia quaerat quod. Facere quam possimus illum.', 1153405, '4.png', 0, 1, '2022-12-21 05:13:22', '2022-12-21 05:13:22'),
(5, 'Nike x Kasina Air Max 1 SP', 'Optio dolorem eum aperiam enim consequuntur dolor veritatis. Dicta eaque est quia omnis dolorum. Dolores nulla et dolorem odio sint aut deleniti.', 1358762, '5.png', 0, 1, '2022-12-21 05:13:22', '2022-12-21 05:13:22'),
(6, 'Nike Air Zoom Pegasus 38', 'Eos porro illo est aut. Est dolor soluta quis exercitationem eligendi nisi nobis esse. Accusantium illum corporis expedita soluta earum rerum fugit. Ipsum molestiae molestiae ab ad veritatis.', 1157514, '1.png', 0, 2, '2022-12-21 05:13:22', '2022-12-21 05:13:22'),
(7, 'Nike Free Run 5.0', 'Qui cupiditate ea veritatis. In dicta quos et ipsa.', 1713708, '2.png', 0, 2, '2022-12-21 05:13:22', '2022-12-21 05:13:22'),
(8, 'Nike Pegasus Trail 3', 'Aut aperiam qui aut rerum. Cum distinctio quisquam voluptatem qui exercitationem enim expedita. Molestiae tenetur dicta et odit et. Nesciunt iusto voluptates nam et sint architecto qui.', 1726883, '3.png', 0, 2, '2022-12-21 05:13:22', '2022-12-21 05:13:22'),
(9, 'Nike Zoom Fly 5 Premium', 'Quidem iusto voluptatem quibusdam earum explicabo voluptatem voluptatem. Inventore repellat ullam necessitatibus reprehenderit rerum cumque.', 1245905, '4.png', 0, 2, '2022-12-21 05:13:22', '2022-12-21 05:13:22'),
(10, 'Nike ZoomX Streakfly', 'Saepe ut non at aut omnis. Eaque recusandae ab occaecati quod tenetur. Quaerat dolor officia deleniti facere sunt.', 1658171, '5.png', 0, 2, '2022-12-21 05:13:22', '2022-12-21 05:13:22'),
(11, 'Jordan Stay Loyal 2', 'Rerum voluptas sunt blanditiis rerum. Omnis neque quia sunt qui. Ea at velit explicabo est culpa cumque.', 1221540, '1.png', 0, 3, '2022-12-21 05:13:22', '2022-12-21 05:13:22'),
(12, 'Kyrie Flytrap 6 EP', 'Fuga consequatur a sit. Sunt reprehenderit maiores nulla ducimus quasi ut quas.', 1695106, '2.png', 0, 3, '2022-12-21 05:13:22', '2022-12-21 05:13:22'),
(13, 'leBron 19 Low EP', 'Et et fugiat magnam dolores quas iusto deleniti aspernatur. Consequatur sit et eaque fugit sapiente aut. Sequi voluptas molestiae et fugit ut consequuntur rerum voluptas.', 1803029, '3.png', 0, 3, '2022-12-21 05:13:22', '2022-12-21 05:13:22'),
(14, 'Luka 1 Next Nature PF', 'Ab tempora incidunt quos odit illum deleniti aliquid. Sint velit velit quas culpa in quis a quasi. Eveniet quasi sit dolor voluptas quae.', 1110204, '4.png', 0, 3, '2022-12-21 05:13:22', '2022-12-21 05:13:22'),
(15, 'Nike Air Deldon Lyme', 'Velit doloribus sint voluptas eum temporibus molestias. Qui vel reprehenderit voluptas beatae quia.', 1426270, '5.png', 0, 3, '2022-12-21 05:13:22', '2022-12-21 05:13:22'),
(16, 'Nike Phantom GT2 Elite FG', 'Quae est rerum deleniti. Odio modi nihil blanditiis a. Veritatis a beatae voluptatem nam consequatur. Dolorum nam non dolore eos.', 1424012, '1.png', 0, 4, '2022-12-21 05:13:23', '2022-12-21 05:13:23'),
(17, 'Nike Zoom Mercurial Superfly 9 Academy FG', 'Dolores cumque ut praesentium laborum. Quam a blanditiis repellat ex nobis accusamus eum. Vel voluptas assumenda quaerat cum voluptates.', 1246222, '2.png', 0, 4, '2022-12-21 05:13:23', '2022-12-21 05:13:23'),
(18, 'Nike Zoom Mercurial Superfly 9 Elite KM FG', 'Et quia rerum alias. Hic voluptas nihil mollitia ut ut deleniti. Occaecati pariatur aut odit hic qui temporibus. Quod molestiae incidunt neque error nihil ex non.', 1004787, '3.png', 0, 4, '2022-12-21 05:13:23', '2022-12-21 05:13:23'),
(19, 'Nike Zoom Mercurial Vapor 15 Elite CR7 FG', 'Qui possimus sint aut fugiat necessitatibus et. Molestias quis ad sunt reprehenderit consequatur sed assumenda. Nobis voluptas quisquam necessitatibus odio soluta molestias.', 1063305, '4.png', 0, 4, '2022-12-21 05:13:23', '2022-12-21 05:13:23'),
(20, 'Nike Zoom Mercurial Vapor 15 Elite FG', 'Ut similique et voluptatem assumenda eveniet est rem. Quia voluptatem sit saepe laudantium esse. Repellat exercitationem voluptatibus repudiandae dolores nisi quis expedita.', 1026750, '5.png', 0, 4, '2022-12-21 05:13:23', '2022-12-21 05:13:23'),
(21, 'Nike Air Max Alpha Trainer 4', 'Sit rerum praesentium aliquid reiciendis et earum. Doloribus dicta doloremque ipsa tenetur non. Tenetur tempora et aut vel libero quae dicta quis.', 1721961, '1.png', 0, 5, '2022-12-21 05:13:23', '2022-12-21 05:13:23'),
(22, 'Nike Defy All Day', 'Omnis laborum modi ut ea aut autem sit. Quos perspiciatis exercitationem fugit quia expedita dolores. Minus at at recusandae voluptatem. Dolores eum tempora officiis quos non expedita quidem.', 1221674, '2.png', 0, 5, '2022-12-21 05:13:23', '2022-12-21 05:13:23'),
(23, 'Nike Free Metcon 4 AMP', 'Consequatur voluptatibus nesciunt repellendus enim. Fugiat quam illo et deleniti occaecati tempore aut. Quia voluptatum officia harum asperiores et omnis. Sunt sit consequuntur velit dolorem.', 1702123, '3.png', 0, 5, '2022-12-21 05:13:23', '2022-12-21 05:13:23'),
(24, 'Nike Metcon 7', 'Eos quia laudantium perspiciatis aut doloribus quia. Sunt dignissimos corporis asperiores harum eius. Aut nulla quis iure tenetur voluptas. Et sunt architecto sit officiis veniam enim harum.', 1972907, '4.png', 0, 5, '2022-12-21 05:13:23', '2022-12-21 05:13:23'),
(25, 'Nike SuperRep Go 3 Next Nature Flyknit', 'Consectetur voluptate est et sunt harum ut eius. Sunt adipisci quia repellendus. At nobis non ut laboriosam maxime laboriosam accusamus. Ratione cum voluptas et aut nemo asperiores voluptatum.', 1683922, '5.png', 0, 5, '2022-12-21 05:13:23', '2022-12-21 05:13:23');

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
(1, 'Black', '2022-12-21 05:13:13', '2022-12-21 05:13:13'),
(2, 'Red', '2022-12-21 05:13:13', '2022-12-21 05:13:13'),
(3, 'Blue', '2022-12-21 05:13:13', '2022-12-21 05:13:13');

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
(1, 13, 4, 16, 65, 17, 52, 27, 62, 1, 1, '2022-12-21 05:13:29', '2022-12-21 05:13:29'),
(2, 79, 54, 77, 51, 81, 72, 42, 92, 2, 1, '2022-12-21 05:13:30', '2022-12-21 05:13:30'),
(3, 8, 63, 55, 7, 57, 46, 70, 46, 3, 1, '2022-12-21 05:13:30', '2022-12-21 05:13:30'),
(4, 22, 26, 33, 56, 99, 46, 74, 81, 1, 2, '2022-12-21 05:13:30', '2022-12-21 05:13:30'),
(5, 48, 75, 17, 77, 38, 74, 91, 52, 2, 2, '2022-12-21 05:13:30', '2022-12-21 05:13:30'),
(6, 56, 72, 25, 87, 8, 54, 48, 80, 3, 2, '2022-12-21 05:13:30', '2022-12-21 05:13:30'),
(7, 12, 46, 73, 59, 89, 31, 76, 99, 1, 3, '2022-12-21 05:13:30', '2022-12-21 05:13:30'),
(8, 55, 22, 65, 50, 3, 49, 76, 79, 2, 3, '2022-12-21 05:13:30', '2022-12-21 05:13:30'),
(9, 96, 35, 36, 52, 36, 97, 2, 66, 3, 3, '2022-12-21 05:13:30', '2022-12-21 05:13:30'),
(10, 16, 65, 81, 13, 80, 14, 77, 77, 1, 4, '2022-12-21 05:13:30', '2022-12-21 05:13:30'),
(11, 92, 81, 29, 44, 95, 76, 56, 96, 2, 4, '2022-12-21 05:13:30', '2022-12-21 05:13:30'),
(12, 72, 34, 21, 55, 70, 38, 74, 79, 3, 4, '2022-12-21 05:13:30', '2022-12-21 05:13:30'),
(13, 99, 69, 86, 44, 4, 96, 55, 15, 1, 5, '2022-12-21 05:13:30', '2022-12-21 05:13:30'),
(14, 96, 7, 58, 58, 52, 34, 17, 42, 2, 5, '2022-12-21 05:13:30', '2022-12-21 05:13:30'),
(15, 71, 13, 67, 27, 44, 2, 91, 91, 3, 5, '2022-12-21 05:13:30', '2022-12-21 05:13:30'),
(16, 55, 57, 80, 40, 73, 67, 23, 54, 1, 6, '2022-12-21 05:13:30', '2022-12-21 05:13:30'),
(17, 2, 7, 57, 69, 78, 10, 34, 82, 2, 6, '2022-12-21 05:13:30', '2022-12-21 05:13:30'),
(18, 7, 88, 13, 50, 60, 8, 35, 70, 3, 6, '2022-12-21 05:13:31', '2022-12-21 05:13:31'),
(19, 85, 68, 32, 41, 13, 61, 19, 20, 1, 7, '2022-12-21 05:13:31', '2022-12-21 05:13:31'),
(20, 91, 3, 92, 11, 62, 67, 88, 96, 2, 7, '2022-12-21 05:13:31', '2022-12-21 05:13:31'),
(21, 73, 26, 38, 62, 89, 71, 79, 5, 3, 7, '2022-12-21 05:13:31', '2022-12-21 05:13:31'),
(22, 96, 83, 17, 37, 28, 79, 44, 59, 1, 8, '2022-12-21 05:13:31', '2022-12-21 05:13:31'),
(23, 8, 8, 55, 72, 59, 4, 85, 6, 2, 8, '2022-12-21 05:13:31', '2022-12-21 05:13:31'),
(24, 15, 0, 18, 6, 5, 93, 58, 38, 3, 8, '2022-12-21 05:13:31', '2022-12-27 01:25:14'),
(25, 27, 95, 62, 75, 11, 67, 65, 12, 1, 9, '2022-12-21 05:13:31', '2022-12-21 05:13:31'),
(26, 4, 12, 83, 42, 12, 2, 69, 40, 2, 9, '2022-12-21 05:13:31', '2022-12-21 05:13:31'),
(27, 32, 94, 10, 59, 26, 67, 51, 58, 3, 9, '2022-12-21 05:13:31', '2022-12-21 05:13:31'),
(28, 68, 93, 10, 72, 21, 68, 81, 62, 1, 10, '2022-12-21 05:13:31', '2022-12-21 05:13:31'),
(29, 73, 52, 50, 11, 29, 99, 82, 66, 2, 10, '2022-12-21 05:13:31', '2022-12-21 05:13:31'),
(30, 63, 66, 100, 87, 93, 50, 10, 71, 3, 10, '2022-12-21 05:13:31', '2022-12-21 05:13:31'),
(31, 38, 23, 89, 14, 90, 56, 59, 45, 1, 11, '2022-12-21 05:13:31', '2022-12-21 05:13:31'),
(32, 59, 46, 97, 70, 60, 2, 33, 38, 2, 11, '2022-12-21 05:13:31', '2022-12-21 05:13:31'),
(33, 55, 3, 84, 9, 98, 50, 46, 69, 3, 11, '2022-12-21 05:13:31', '2022-12-21 05:13:31'),
(34, 18, 46, 56, 56, 65, 76, 68, 42, 1, 12, '2022-12-21 05:13:31', '2022-12-21 05:13:31'),
(35, 31, 93, 7, 12, 56, 4, 21, 78, 2, 12, '2022-12-21 05:13:31', '2022-12-21 05:13:31'),
(36, 1, 43, 2, 17, 3, 95, 12, 91, 3, 12, '2022-12-21 05:13:32', '2022-12-21 05:13:32'),
(37, 15, 28, 15, 51, 43, 66, 68, 56, 1, 13, '2022-12-21 05:13:32', '2022-12-21 05:13:32'),
(38, 75, 41, 70, 15, 16, 3, 3, 72, 2, 13, '2022-12-21 05:13:32', '2022-12-21 05:13:32'),
(39, 55, 79, 5, 90, 63, 21, 53, 82, 3, 13, '2022-12-21 05:13:32', '2022-12-21 05:13:32'),
(40, 87, 95, 50, 77, 94, 5, 9, 85, 1, 14, '2022-12-21 05:13:32', '2022-12-21 05:13:32'),
(41, 98, 1, 79, 39, 20, 80, 25, 90, 2, 14, '2022-12-21 05:13:32', '2022-12-21 05:13:32'),
(42, 78, 67, 43, 14, 99, 93, 11, 82, 3, 14, '2022-12-21 05:13:32', '2022-12-21 05:13:32'),
(43, 29, 8, 23, 33, 87, 48, 15, 41, 1, 15, '2022-12-21 05:13:32', '2022-12-21 05:13:32'),
(44, 81, 76, 6, 94, 19, 96, 41, 64, 2, 15, '2022-12-21 05:13:32', '2022-12-21 05:13:32'),
(45, 13, 96, 70, 75, 30, 72, 44, 46, 3, 15, '2022-12-21 05:13:32', '2022-12-21 05:13:32'),
(46, 53, 41, 27, 57, 6, 29, 78, 19, 1, 16, '2022-12-21 05:13:32', '2022-12-21 05:13:32'),
(47, 96, 48, 88, 92, 5, 69, 37, 90, 2, 16, '2022-12-21 05:13:32', '2022-12-21 05:13:32'),
(48, 39, 28, 81, 72, 18, 7, 51, 75, 3, 16, '2022-12-21 05:13:32', '2022-12-21 05:13:32'),
(49, 58, 59, 64, 5, 18, 83, 43, 37, 1, 17, '2022-12-21 05:13:33', '2022-12-21 05:13:33'),
(50, 34, 44, 38, 1, 59, 30, 40, 17, 2, 17, '2022-12-21 05:13:33', '2022-12-21 05:13:33'),
(51, 56, 30, 64, 72, 69, 29, 87, 73, 3, 17, '2022-12-21 05:13:33', '2022-12-21 05:13:33'),
(52, 99, 47, 40, 54, 20, 50, 64, 18, 1, 18, '2022-12-21 05:13:33', '2022-12-21 05:13:33'),
(53, 52, 69, 77, 15, 14, 63, 74, 25, 2, 18, '2022-12-21 05:13:33', '2022-12-21 05:13:33'),
(54, 29, 12, 5, 87, 23, 10, 5, 10, 3, 18, '2022-12-21 05:13:33', '2022-12-21 05:13:33'),
(55, 76, 15, 74, 66, 46, 80, 60, 65, 1, 19, '2022-12-21 05:13:33', '2022-12-21 05:13:33'),
(56, 98, 17, 54, 100, 30, 78, 73, 17, 2, 19, '2022-12-21 05:13:33', '2022-12-21 05:13:33'),
(57, 27, 3, 33, 27, 39, 9, 22, 5, 3, 19, '2022-12-21 05:13:33', '2022-12-21 05:13:33'),
(58, 63, 13, 1, 6, 82, 72, 79, 58, 1, 20, '2022-12-21 05:13:33', '2022-12-21 05:13:33'),
(59, 11, 93, 11, 35, 1, 91, 3, 91, 2, 20, '2022-12-21 05:13:33', '2022-12-21 05:13:33'),
(60, 5, 84, 74, 37, 68, 85, 32, 46, 3, 20, '2022-12-21 05:13:33', '2022-12-21 05:13:33'),
(61, 18, 81, 56, 53, 76, 69, 3, 8, 1, 21, '2022-12-21 05:13:33', '2022-12-21 05:13:33'),
(62, 3, 57, 13, 77, 81, 56, 43, 13, 2, 21, '2022-12-21 05:13:33', '2022-12-21 05:13:33'),
(63, 58, 99, 35, 35, 27, 55, 64, 40, 3, 21, '2022-12-21 05:13:34', '2022-12-21 05:13:34'),
(64, 17, 94, 15, 13, 60, 31, 85, 65, 1, 22, '2022-12-21 05:13:34', '2022-12-21 05:13:34'),
(65, 84, 53, 44, 29, 29, 67, 60, 32, 2, 22, '2022-12-21 05:13:34', '2022-12-21 05:13:34'),
(66, 83, 84, 52, 42, 33, 22, 8, 87, 3, 22, '2022-12-21 05:13:34', '2022-12-21 05:13:34'),
(67, 99, 36, 57, 97, 95, 68, 86, 26, 1, 23, '2022-12-21 05:13:34', '2022-12-21 05:13:34'),
(68, 64, 5, 76, 67, 16, 81, 99, 93, 2, 23, '2022-12-21 05:13:34', '2022-12-21 05:13:34'),
(69, 59, 25, 71, 19, 49, 47, 68, 17, 3, 23, '2022-12-21 05:13:34', '2022-12-21 05:13:34'),
(70, 75, 2, 21, 72, 28, 43, 2, 70, 1, 24, '2022-12-21 05:13:34', '2022-12-21 05:13:34'),
(71, 22, 62, 70, 83, 67, 50, 73, 82, 2, 24, '2022-12-21 05:13:34', '2022-12-21 05:13:34'),
(72, 89, 10, 29, 45, 82, 53, 45, 53, 3, 24, '2022-12-21 05:13:34', '2022-12-21 05:13:34'),
(73, 94, 67, 46, 78, 64, 41, 6, 80, 1, 25, '2022-12-21 05:13:34', '2022-12-21 05:13:34'),
(74, 18, 41, 99, 90, 12, 71, 77, 38, 2, 25, '2022-12-21 05:13:34', '2022-12-21 05:13:34'),
(75, 22, 48, 33, 67, 63, 28, 67, 95, 3, 25, '2022-12-21 05:13:34', '2022-12-21 05:13:34');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id_transaction` int(11) NOT NULL,
  `quantity` int(100) NOT NULL,
  `size` int(42) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `user_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `phone_number` varchar(13) NOT NULL,
  `address` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `user_name`, `email`, `password`, `phone_number`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Cynthia Walsh', 'kirlin.herbert@yahoo.com', '$2y$10$3o7vjzLUrely3Vs2i0FPy.e4eVM2Yt6Rh5bjCL6oDPy7He//oe6aa', '309.986.9675', '7131 Zakary Hill\nFreemanstad, CO 13165-6989', '2022-12-21 05:12:44', '2022-12-21 05:12:44'),
(2, 'Reggie Hand DVM', 'marjory40@yahoo.com', '$2y$10$BqFfxtXtiWHOD9Km27hj1uLxaDdyjujH/5tRD66CN0MnlWfsAgMUq', '(931) 732-320', '86131 Schiller Lock Apt. 406\nNorth Hobart, NJ 51055', '2022-12-21 05:12:44', '2022-12-21 05:12:44'),
(3, 'Shyann Emard DVM', 'lisette12@hotmail.com', '$2y$10$xZcZEINhXiqPJVGplhR1BOzpzAWkX0CLzP1kMY3cqyal1xjGEfKBa', '706-355-2100', '9354 Medhurst Turnpike Apt. 961\nPort Ellabury, CO 46237', '2022-12-21 05:12:44', '2022-12-21 05:12:44'),
(5, 'Novandi Ramadhan', 'novandiramadhan80@gmail.com', '$2y$10$azgX/secsZwpW5oOudXIpucmq9pH5/2W9s27MQQsu7MMKTyxy563W', '085156066785', 'Jl. Kiuju No.36 RT. 03/RW. 03 Kaujon Kidul', '2022-12-22 22:02:07', '2022-12-23 10:59:48');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id_product_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id_product_size` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `transactions_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `product_colors` (`id_product_color`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
