CREATE TABLE `products` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `price` float(10,2) NOT NULL,
 `status` tinyint(1) NOT NULL DEFAULT '1',
 `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO products VALUES
    (1,'Sports Bra Style1','images/womens/bra1.jpg',15.00,1,'womens'),
    (2,'Sports Bra Style2','images/womens/bra2.jpg',15.00,1,'womens'),
    (3,'Sports Bra Style3','images/womens/bra3.jpg',15.00,1,'womens'),
    (4,'Sports Bra Style4','images/womens/bra4.jpg',15.00,1,'womens'),
    (5,'Sports Bra Style5','images/womens/bra5.jpg',15.00,1,'womens'),
    (6,'Sports Bra Style6','images/womens/bra6.jpg',15.00,1,'womens'),
    (7,'Trainer Style1','images/shoes/trainer1.jpg',45.00,1,'shoes'),
    (8,'Trainer Style2','images/shoes/trainer2.jpg',45.00,1,'shoes'),
    (9,'Trainer Style3','images/shoes/trainer3.jpg',45.00,1,'shoes'),
    (10,'Trainer Style4','images/shoes/trainer4.jpg',45.00,1,'shoes'),
    (11,'Trainer Style5','images/shoes/trainer5.jpg',45.00,1,'shoes'),
    (12,'Trainer Style6','images/shoes/trainer6.jpg',45.00,1,'shoes'),
    (13,'Tent Style1','images/camping/tent1.jpg',165.00,1,'camping'),
    (14,'Tent Style2','images/camping/tent2.jpg',165.00,1,'camping'),
    (15,'Tent Style3','images/camping/tent3.jpg',165.00,1,'camping'),
    (16,'Tent Style4','images/camping/tent4.jpg',165.00,1,'camping'),
    (17,'Tent Style5','images/camping/tent5.jpg',165.00,1,'camping'),
    (18,'Tent Style6','images/camping/tent6.jpg',165.00,1,'camping'),
    (19,'Shirt Style1','images/mens/shirt1.jpg',17.00,1,'mens'),
    (20,'Shirt Style2','images/mens/shirt2.jpg',17.00,1,'mens'),
    (21,'Shirt Style3','images/mens/shirt3.jpg',17.00,1,'mens'),
    (22,'Shirt Style4','images/mens/shirt4.jpg',17.00,1,'mens'),
    (23,'Shirt Style5','images/mens/shirt5.jpg',17.00,1,'mens'),
    (24,'Shirt Style6','images/mens/shirt6.jpg',17.00,1,'mens');

CREATE TABLE `womens` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `price` float(10,2) NOT NULL,
 `status` tinyint(1) NOT NULL DEFAULT '1',
 `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO womens VALUES
    (1,'Sports Bra Style1','images/womens/bra1.jpg',15.00,1,'womens'),
    (2,'Sports Bra Style2','images/womens/bra2.jpg',15.00,1,'womens'),
    (3,'Sports Bra Style3','images/womens/bra3.jpg',15.00,1,'womens'),
    (4,'Sports Bra Style4','images/womens/bra4.jpg',15.00,1,'womens'),
    (5,'Sports Bra Style5','images/womens/bra5.jpg',15.00,1,'womens'),
    (6,'Sports Bra Style6','images/womens/bra6.jpg',15.00,1,'womens');



CREATE TABLE `mens` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `price` float(10,2) NOT NULL,
 `status` tinyint(1) NOT NULL DEFAULT '1',
 `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO mens VALUES
    (19,'Shirt Style1','images/mens/shirt1.jpg',17.00,1,'mens'),
    (20,'Shirt Style2','images/mens/shirt2.jpg',17.00,1,'mens'),
    (21,'Shirt Style3','images/mens/shirt3.jpg',17.00,1,'mens'),
    (22,'Shirt Style4','images/mens/shirt4.jpg',17.00,1,'mens'),
    (23,'Shirt Style5','images/mens/shirt5.jpg',17.00,1,'mens'),
    (24,'Shirt Style6','images/mens/shirt6.jpg',17.00,1,'mens');


CREATE TABLE `shoes` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `price` float(10,2) NOT NULL,
 `status` tinyint(1) NOT NULL DEFAULT '1',
 `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO shoes VALUES
    (7,'Trainer Style1','images/shoes/trainer1.jpg',45.00,1,'shoes'),
    (8,'Trainer Style2','images/shoes/trainer2.jpg',45.00,1,'shoes'),
    (9,'Trainer Style3','images/shoes/trainer3.jpg',45.00,1,'shoes'),
    (10,'Trainer Style4','images/shoes/trainer4.jpg',45.00,1,'shoes'),
    (11,'Trainer Style5','images/shoes/trainer5.jpg',45.00,1,'shoes'),
    (12,'Trainer Style6','images/shoes/trainer6.jpg',45.00,1,'shoes');


CREATE TABLE `camping` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `price` float(10,2) NOT NULL,
 `status` tinyint(1) NOT NULL DEFAULT '1',
 `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO camping VALUES
    (13,'Tent Style1','images/camping/tent1.jpg',165.00,1,'camping'),
    (14,'Tent Style2','images/camping/tent2.jpg',165.00,1,'camping'),
    (15,'Tent Style3','images/camping/tent3.jpg',165.00,1,'camping'),
    (16,'Tent Style4','images/camping/tent4.jpg',165.00,1,'camping'),
    (17,'Tent Style5','images/camping/tent5.jpg',165.00,1,'camping'),
    (18,'Tent Style6','images/camping/tent6.jpg',165.00,1,'camping');




