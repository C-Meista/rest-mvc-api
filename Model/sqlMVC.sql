show databases;
create database db_MVC;
use db_MVC;

CREATE TABLE `tbl_users` (
  `u_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `u_name` varchar(100) DEFAULT NULL,
  `u_surname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB;

CREATE TABLE `tbl_products` (
  `pro_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `pro_name` varchar(100) DEFAULT NULL,
  `pro_usage` varchar(100) DEFAULT NULL,
  `pro_price` int DEFAULT NULL
) ENGINE=InnoDB;

INSERT INTO tbl_users (u_name, u_surname) VALUES
('Max', 'Mustermann'),
('Anna', 'Müller'),
('Luca', 'Rossi'),
('Sofia', 'Bianchi'),
('John', 'Doe'),
('Emma', 'Smith'),
('Paul', 'Schneider'),
('Laura', 'Fischer');

INSERT INTO tbl_products (pro_name, pro_usage, pro_price) VALUES
('Laptop', 'Arbeit und Studium', 1200),
('Smartphone', 'Kommunikation', 800),
('Kaffeemaschine', 'Haushalt', 150),
('Gaming Maus', 'Gaming', 60),
('Monitor', 'Arbeit und Gaming', 300),
('Tastatur', 'Schreiben', 100),
('Kopfhörer', 'Musik hören', 200),
('Rucksack', 'Transport', 90);

select * from tbl_users;

update tbl_users set u_name="Maxi", u_surname="Musti" where u_id="1";

