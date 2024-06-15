drop database if exists ecourses;

Create database ecourses;

use ecourses;

Create table categories
(
    id int primary key auto_increment,
    name varchar(100) NOT NULL UNIQUE,
    status tinyint(1) DEFAULT '0',
    created_at date DEFAULT current_timestamp(),
    updated_at date null
);

Create table products
(
    id int primary key auto_increment,
    name varchar(100) NOT NULL UNIQUE,
    image varchar(100) NOT NULL,
    price float(10,2) NOT NULL,
    sale_price float(10,2) NOT NULL,
    category_id int NOT NULL,
    description text NOT NULL,
    status tinyint(1) DEFAULT '0',
    created_at date DEFAULT current_timestamp(),
    updated_at date null,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

Create table product_images
(
    id int primary key auto_increment,
    image varchar(100) NOT NULL,
    product_id int NOT NULL,
    status tinyint(1) DEFAULT '0',
    created_at date DEFAULT current_timestamp(),
    updated_at date null,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

Create table users
(
    id int primary key auto_increment,
    name varchar(100) NOT NULL,
    email varchar(100) NOT NULL UNIQUE,
    password varchar(200) NOT NULL,
    created_at date DEFAULT current_timestamp(),
    updated_at date null
);

Create table personal_access_tokens
(
    id int primary key auto_increment,
    name varchar(100) NOT NULL,
    email varchar(100) NOT NULL UNIQUE,
    password varchar(200) NOT NULL,
    created_at date DEFAULT current_timestamp(),
    updated_at date null
);


Create table banners
(
    id int primary key auto_increment,
    name varchar(100) NOT NULL UNIQUE,
    link varchar(100) NOT NULL DEFAULT '#',
    image varchar(100) NOT NULL,
    description varchar(255) NOT NULL,
    position varchar(100) DEFAULT 'top-banner',
    priority tinyint DEFAULT '0',
    status tinyint(1) DEFAULT '0',
    created_at date DEFAULT current_timestamp(),
    updated_at date null
);


Create table blogs
(
    id int primary key auto_increment,
    name varchar(100) NOT NULL UNIQUE,
    link varchar(100) NOT NULL DEFAULT '#',
    image varchar(100) NOT NULL,
    description varchar(255) NOT NULL,
    position varchar(100) DEFAULT 'top-banner',
    status tinyint(1) DEFAULT '0',
    created_at date DEFAULT current_timestamp(),
    updated_at date null
);


Create table customers
(
    id int primary key auto_increment,
    name varchar(100) NOT NULL,
    email varchar(100) NOT NULL UNIQUE,
    phone varchar(100) NOT NULL UNIQUE,
    address varchar(100) NULL,
    gender tinyint NOT NULL DEFAULT '0',
    password varchar(200) NOT NULL,
    email_verified_at date null,
    created_at date DEFAULT current_timestamp(),
    updated_at date null
);

Create table customer_reset_tokens
(
    email varchar(100) primary key,
    token varchar(100) NOT NULL UNIQUE,
    created_at date DEFAULT current_timestamp(),
    updated_at date null
);

Create table comments
(
    id int primary key auto_increment,
    customer_id int NOT NULL,
    product_id int NOT NULL,
    comment text,
    created_at date DEFAULT current_timestamp(),
    updated_at date null,
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

Create table favorites
(
    id int primary key auto_increment,
    customer_id int NOT NULL,
    product_id int NOT NULL,
    created_at date DEFAULT current_timestamp(),
    updated_at date null,
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

Create table carts
(
    customer_id int NOT NULL,
    product_id int NOT NULL,
    price float(10,2) not null,
    quantity int not null,
    primary key (customer_id, product_id),
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

Create table orders
(
    id int primary key auto_increment,
    name varchar(100) NULL,
    email varchar(100) NULL,
    phone varchar(100) NULL,
    address varchar(100) NULL,
    token varchar(50) NULL,
    customer_id int NOT NULL,
    status tinyint(1) DEFAULT '0',
    created_at date DEFAULT current_timestamp(),
    updated_at date null,
    FOREIGN KEY (customer_id) REFERENCES customers(id)
);

Create table order_details
(
    order_id int NOT NULL,
    product_id int NOT NULL,
    quantity tinyint NOT NULL,
    price float(10,3) NOT NULL,
    primary key (order_id, product_id),
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);
CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2024_06_01_075429_create_schedules_table', 1);
CREATE TABLE `schedules` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Tiêu đề lịch hẹn',
  `schedule_date` date DEFAULT NULL COMMENT 'ngày lịch hẹn',
  `contents` text COLLATE utf8mb4_unicode_ci COMMENT 'Nội dung lịch hẹn',
  `status` tinyint DEFAULT NULL COMMENT 'Trạng thái lịch hẹn',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `title`, `schedule_date`, `contents`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Schedule ngày nào', '2024-06-12', '<p>Schedule ngày nào  ádasdasd</p>', 2, '2024-06-01 02:14:39', '2024-06-01 02:20:11'),
(3, 'lịch hẹn ngày 1444', '2024-06-19', '<p>lịch hẹn ngày 1444<br></p>', 1, '2024-06-01 02:19:32', '2024-06-01 02:19:32'),
(4, 'Hẹn họp ngày 02/06', '2024-06-02', '<p>Mô tả về ngày hẹn gì dsfdsfsdf</p><p><br></p><p><br></p>', 1, '2024-06-01 02:48:28', '2024-06-01 02:48:38');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_users`
--

CREATE TABLE `schedule_users` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL COMMENT 'id người dùng',
  `schedule_id` int UNSIGNED NOT NULL COMMENT 'id lịch hẹn',
  `status` tinyint DEFAULT NULL COMMENT 'Trạng thái đăng ký lịch hẹn',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedule_users`
--

INSERT INTO `schedule_users` (`id`, `user_id`, `schedule_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '2024-06-01 09:44:29', '2024-06-01 09:44:29'),
(2, 1, 3, 1, '2024-06-01 09:44:52', '2024-06-01 09:44:52');

-- --------------------------------------------------------

INSERT INTO banners(name, image, link, status) VALUES
('Banner 1', 'banner_bg.png', '#', 1) ;
INSERT INTO banners(name, image, position, status) VALUES
('gallery 1', 'gallery_img01.png', 'gallery', 1) ,
('gallery 2', 'gallery_img02.png', 'gallery', 1) ,
('gallery 3', 'gallery_img03.png', 'gallery', 1) ;


INSERT INTO banners(name, status, link, description, position, priority, image) VALUES
('Fresh Meat',1, '#','','top-banner',0,'banner_bg.png') ;



INSERT INTO `users` (`name`, `email`, `password`, `created_at`, `updated_at`) VALUES
('Admin Manager', 'admin@gmail.com', '$2y$12$ElFD8Eq8bOZ8bsym04rY1e6znHP874r/FSPw/ZfMy1CB85O/Yc60q', '2023-12-04', '2023-12-04');

INSERT INTO categories(name, status) VALUES
('Dưa hấu', 1) ,
('Cà chua', 1) ,
('Chuối tiến vua', 1) ,
('Nho mỹ', 1);

INSERT INTO `products` (`id`, `name`, `image`, `price`, `sale_price`, `category_id`, `description`, `status`, `created_at`, `updated_at`) VALUES (NULL, 'CHATGPT FULL COURSE', '9QGutOkZbvROsN0AH7Eis3c1WZUb71B2RCAgHbiV.png', '180', '169', '2', 'CHATGPT FULL COURSE description', '1', current_timestamp(), NULL);
INSERT INTO `products` (`id`, `name`, `image`, `price`, `sale_price`, `category_id`, `description`, `status`, `created_at`, `updated_at`) VALUES (NULL, 'ReactJS Fullcourse', 'H1aVf66MQWVqNcD4hfabERPKaVDEqD4OgCR2CW8n.png', '200', '189', '1', 'ReactJS Fullcourse description', '1', current_timestamp(), NULL);

INSERT INTO `products` (`id`, `name`, `image`, `price`, `sale_price`, `category_id`, `description`, `status`, `created_at`, `updated_at`) VALUES (NULL, 'Excel Fullcourse', 's31Lw4BAlQ9ziI3zw4P1VIYYQ7nU4brn67y0MHCK.png', '250', '209', '1', 'Excel Fullcourse', '1', current_timestamp(), NULL);