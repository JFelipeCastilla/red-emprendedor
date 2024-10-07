DROP DATABASE IF EXISTS apimap;

CREATE DATABASE apimap;

USE apimap;

CREATE TABLE department (
    department_id INT AUTO_INCREMENT UNIQUE,
    department_name VARCHAR(30) NOT NULL,
    description TEXT,
    department_entrepreneur INT,
    category_fk INT,
    PRIMARY KEY(department_id),
);

CREATE TABLE township (
    township_id INT AUTO_INCREMENT,
    township_name VARCHAR(35) NOT NULL,
    township_entrepreneur INT,
    department_fk INT,
    PRIMARY KEY(township_id),
    FOREIGN KEY(department_fk) REFERENCES department(department_id) ON DELETE CASCADE
);

CREATE TABLE category (
	category_id INT AUTO_INCREMENT,
    category_name varchar(150) NOT NULL,
    category_entrepreneur INT,
    category_image VARCHAR(255) UNIQUE,
    department_fk INT,
    PRIMARY KEY (category_id),
    FOREIGN KEY(department_fk) REFERENCES department(department_id) ON DELETE CASCADE
);

CREATE TABLE product (
    product_id INT AUTO_INCREMENT,
    product_name VARCHAR(100),
    product_description TEXT,
    procuct_date DATE,
    product_offer TINYINT(1),
    product_image VARCHAR(255),
    inovation VARCHAR(120),
    social_media VARCHAR(120),
    category_fk INT,
    PRIMARY KEY (product_id),
    FOREIGN KEY (category_fk) REFERENCES category(category_id) ON DELETE CASCADE
);