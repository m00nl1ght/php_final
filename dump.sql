-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               8.0.15 - MySQL Community Server - GPL
-- Операционная система:         Win64
-- HeidiSQL Версия:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица shop.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы shop.categories: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`) VALUES
	(2, 'Женщины'),
	(3, 'Мужчины'),
	(4, 'Дети'),
	(5, 'Аксессуары');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Дамп структуры для таблица shop.category_product
CREATE TABLE IF NOT EXISTS `category_product` (
  `category_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  KEY `FK_category_product_categories` (`category_id`),
  KEY `FK_category_product_products` (`product_id`),
  CONSTRAINT `FK_category_product_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `FK_category_product_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы shop.category_product: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `category_product` DISABLE KEYS */;
INSERT INTO `category_product` (`category_id`, `product_id`) VALUES
	(3, 2),
	(2, 2),
	(2, 27),
	(3, 27),
	(4, 27),
	(2, 1),
	(3, 6),
	(4, 6),
	(5, 6);
/*!40000 ALTER TABLE `category_product` ENABLE KEYS */;

-- Дамп структуры для таблица shop.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surname` varchar(50) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '0',
  `patronymic` varchar(50) NOT NULL DEFAULT '0',
  `city` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `home` varchar(50) DEFAULT NULL,
  `aprt` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL DEFAULT '0',
  `phone` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы shop.customers: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` (`id`, `surname`, `name`, `patronymic`, `city`, `street`, `home`, `aprt`, `email`, `phone`) VALUES
	(12, 'Смирнов', 'Павел', 'Владимирович', 'Москва', 'Пушкина', '23', '3', 'jhon@deo.com', '+7 987 6543210'),
	(13, 'Петров', 'Михаил', 'Владимирович', 'Москва', 'Пушкина', '32', '4', 'jhon@deo.com', '+7 987 6543210');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;

-- Дамп структуры для таблица shop.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` varchar(50) DEFAULT NULL,
  `delivery` varchar(50) DEFAULT NULL,
  `payment` varchar(50) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `comment` text,
  `status` varchar(50) DEFAULT NULL,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы shop.orders: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `price`, `delivery`, `payment`, `customer_id`, `comment`, `status`, `datetime`) VALUES
	(2, '10000', 'dev-yes', 'cash', 12, 'Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты. Вдали от всех живут они в буквенных домах на берегу.', 'completed', '2020-10-19 14:45:40'),
	(3, '8000', 'dev-yes', 'cash', 13, 'Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты. Вдали от всех живут они в буквенных домах на берегу.', 'new', '2020-10-19 14:45:38');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Дамп структуры для таблица shop.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '0',
  `img` varchar(255) NOT NULL DEFAULT '0',
  `new` tinyint(1) NOT NULL DEFAULT '0',
  `sale` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы shop.products: ~15 rows (приблизительно)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `name`, `price`, `img`, `new`, `sale`) VALUES
	(1, 'Платье со складкамии', 19992, '/resources/img/products/product-1.jpg', 0, 0),
	(2, 'Платье со складкам', 0, '/resources/img/products/product-3.jpg', 0, 1),
	(3, 'РПлатье со складками', 4999, '/resources/img/products/product-2.jpg', 0, 0),
	(4, 'Платье со складками', 2999, '/resources/img/products/product-4.jpg', 0, 0),
	(5, 'Платье со складками', 2999, '/resources/img/products/product-5.jpg', 0, 0),
	(6, 'Платье со складками', 5999, '/resources/img/products/product-6.jpg', 1, 0),
	(7, 'Платье со складками', 2999, '/resources/img/products/product-7.jpg', 1, 0),
	(8, 'Платье со складками', 2999, '/resources/img/products/product-8.jpg', 0, 1),
	(9, 'Платье со складками', 2999, '/resources/img/products/product-9.jpg', 1, 1),
	(22, 'Шляпа', 2999, '/resources/img/products/1604054394product-3.jpg', 1, 0),
	(23, 'Шляпа', 2999, '/resources/img/products/1604054540product-3.jpg', 1, 0),
	(24, 'Шляпа', 2999, '/resources/img/products/1604054572product-3.jpg', 1, 0),
	(25, 'Шляпа', 2999, '/resources/img/products/1604054618product-3.jpg', 1, 0),
	(26, 'Шляпа', 123, '/resources/img/products/1604054661product-8.jpg', 0, 1),
	(27, 'Шляпа', 123, '/resources/img/products/1604054755product-8.jpg', 0, 1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Дамп структуры для таблица shop.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы shop.roles: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`) VALUES
	(1, 'Оператор'),
	(2, 'Администратор');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Дамп структуры для таблица shop.role_user
CREATE TABLE IF NOT EXISTS `role_user` (
  `role_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  KEY `FK_role_user_roles` (`role_id`),
  KEY `FK_role_user_users` (`user_id`),
  CONSTRAINT `FK_role_user_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_role_user_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы shop.role_user: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` (`role_id`, `user_id`) VALUES
	(2, 1),
	(1, 1),
	(1, 2);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;

-- Дамп структуры для таблица shop.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `password` (`password`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы shop.users: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
	(1, '0', '1@1', '$2y$10$SK6cNODZa.LJQvnXbFrG7.f7jh.LJM1d5Sjuj3jdNcSr98ZdmIFPy'),
	(2, '0', '2@2', '$2y$10$hTqPIzenttQ/.2Ktaw25yu1omMDxqZUqT6eBKWGvmsYP5cAoV3Vau'),
	(3, '0', '3@3', '$2y$10$n0UtLKGGPw4OA2DqoBkFYuFrY4.K92azElhsY0i7kmivmHwQx1C5u');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
