DROP DATABASE IF EXISTS apimap;

CREATE DATABASE apimap;

USE apimap;

CREATE TABLE department (
    department_id INT AUTO_INCREMENT UNIQUE,
    department_name VARCHAR(30) NOT NULL,
    description TEXT,
    department_entrepreneur INT,
    PRIMARY KEY(department_id)
);

CREATE TABLE township (
    township_id INT AUTO_INCREMENT,
    township_name VARCHAR(35) NOT NULL,
    township_entrepreneur INT,
    department_id INT,
    PRIMARY KEY(township_id),
    FOREIGN KEY(department_id) REFERENCES department(department_id) ON DELETE CASCADE
);

CREATE TABLE category (
	category_id INT AUTO_INCREMENT,
    category_name varchar(150) NOT NULL,
    category_entrepreneur INT,
    category_image VARCHAR(255) UNIQUE,
    PRIMARY KEY (category_id)
);

CREATE TABLE product (
    product_id INT AUTO_INCREMENT,
    product_name VARCHAR(100),
    product_image VARCHAR(255),
    product_description TEXT,
    product_innovation VARCHAR(120),
    category_fk INT,
    PRIMARY KEY (product_id),
    FOREIGN KEY (category_fk) REFERENCES category(category_id) ON DELETE CASCADE
);