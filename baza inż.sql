CREATE DATABASE IT_World;
USE IT_World;
CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(500) NOT NULL
);
CREATE TABLE products (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(250) NOT NULL,
    price double(9,2) NOT NULL,
    tag varchar(100) NOT NULL UNIQUE,
    img varchar(100) NOT NULL
);
CREATE TABLE orders (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    invoice varchar(250) NOT NULL,
    userid int NOT NULL,
    price double(9,2) NOT NULL,
    status varchar(250) NOT NULL,
    FOREIGN KEY (userid) REFERENCES users(id)
);
CREATE TABLE order_details (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	orderID int NOT NULL,
    productID int NOT NULL,
    price double(9,2) NOT NULL,
    FOREIGN KEY (orderID) REFERENCES orders(id),
    FOREIGN KEY (productID) REFERENCES products(id)	
);
grant select, insert, update on IT_World.users to 'customer_service'@'localhost';
grant select, insert, update on IT_World.orders to 'customer_service'@'localhost';
grant select, insert, update on IT_World.order_details to 'customer_service'@'localhost';
flush privileges;
INSERT INTO products (id, name, price, tag, img) VALUES 
(1, 'Intel Core i5-10400', 549.00, 'i5-10th', '../Content/Pictures/i5.jpg'),
(2, 'Intel Core i7-10700', 1229.00, 'i7-10th', '../Content/Pictures/i7.jpg'),
(3, 'Intel Core i9-10900', 2499.00, 'i9-10th', '../Content/Pictures/i9.jpg'),
(4, 'Gainward GeForce RTX 3060 Ghost 12GB GDDR6', 1679.00, 'Gainward', '../Content/Pictures/gainward.jpg'),
(5, 'Sapphire Radeon RX 6600 GAMING Pulse 8GB GDDR6', 1449.00, 'Sapphire', '../Content/Pictures/Sapphire.jpg'),
(6, 'Zotac GeForce RTX 3060 Twin Edge 12GB GDDR6', 1699.00, 'Zotac', '../Content/Pictures/Zotac.jpg'),
(7, 'Samsung 1TB M.2 PCIe NVMe 980', 539.00, 'Samsung1TBM2', '../Content/Pictures/SSDm2.jpg'),
(8, 'GOODRAM 1TB 2,5" SATA SSD CX400', 299.00, 'GOODRAM1TB', '../Content/Pictures/SSD.jpg'),
(9, 'WD Elements Portable 1,5TB USB 3.2', 265.00, 'WD1.5TB', '../Content/Pictures/WD.jpg'),
(10, 'Gigabyte B660 GAMING X DDR4', 719.00, 'GigabyteB660', '../Content/Pictures/Gigabyte.jpg'),
(11, 'ASUS PRIME B450-PLUS', 459.00, 'ASUSPRIMEB450', '../Content/Pictures/ASUS.jpg'),
(12, 'ASUS PRIME B550-PLUS', 599.00, 'ASUSPRIMEB550', '../Content/Pictures/ASUS2.jpg'),
(13, 'ENDORFY Signum 300 ARGB', 369.00, 'ENDORFYSignum300ARGB', '../Content/Pictures/ENDORFY.jpg'),
(14, 'Silver Monkey X Crate', 499.00, 'SilverMonkeyXCrate', '../Content/Pictures/Silver.jpg'),
(15, 'ENDORFY Regnum 400 ARGB', 439.00, 'ENDORFYRegnum400ARGB', '../Content/Pictures/ENDORFY2.jpg'),
(16, 'Kingston FURY 32GB (2x16GB) 3600MHz CL16 Renegade', 539.00, 'KingstonFURY32GBRenegade', '../Content/Pictures/Kingston32GB.jpg'),
(17, 'Patriot 16GB (2x8GB) 3200MHz CL16 Viper Steel', 249.00, 'Patriot16GBViperSteel', '../Content/Pictures/Patriot16GB.jpg'),
(18, 'GOODRAM 16GB (2x8GB) 3600MHz CL18 IRDM RGB', 299.00, 'GOODRAM16GBIRDMRGB', '../Content/Pictures/Goodram16GB.jpg'),
(19, 'SilentiumPC Vero L3 500W 80 Plus Bronze', 239.00, 'SilentiumPCVeroL3500W80PlusBronze', '../Content/Pictures/Silentium500W.jpg'),
(20, 'Gigabyte P750GM 750W 80 Plus Gold', 449.00, 'Gigabyte P750GM750W80PlusGold', '../Content/Pictures/Gigabyte750W.jpg'),
(21, 'SilentiumPC Vero M3 600W 80 Plus Bronze', 309.00, 'SilentiumPCVeroM3600W80PlusBronze', '../Content/Pictures/Silentium600W.jpg'),
(22, 'Silver Monkey X BREEZY 92mm', 75.00, 'SilverMonkeyXBREEZY92mm', '../Content/Pictures/Silver92mm.jpg'),
(23, 'ENDORFY Fera 5 120mm', 135.00, 'ENDORFYFera5_120mm', '../Content/Pictures/ENDORFY120mm.jpg'),
(24, 'SilentiumPC Fortis 5 Dual Fan 140mm/120mm', 209.00, 'SilentiumPCFortis5DualFan', '../Content/Pictures/SilentiumDual.jpg');