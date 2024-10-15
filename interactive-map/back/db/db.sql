DROP DATABASE IF EXISTS apimap;

CREATE DATABASE apimap;

USE apimap;
CREATE TABLE department (
    department_id INT AUTO_INCREMENT UNIQUE,
    department_name VARCHAR(30) NOT NULL,
    description TEXT,
    amount_entrepreneurship INT, # cantidad de emprendedores en departamento
    PRIMARY KEY(department_id)
);

CREATE TABLE township (
    township_id INT AUTO_INCREMENT,
    township_name VARCHAR(35) NOT NULL,
    amount_entrepreneurship INT, # cantidad de emprendedores en municipio
    department_fk INT,
    PRIMARY KEY(township_id),
    FOREIGN KEY(department_fk) REFERENCES department(department_id)
);

CREATE TABLE category (
	category_id INT AUTO_INCREMENT,
    category_name varchar(150) NOT NULL,
    amount_entrepreneurship INT, # cantidad de emprendedores en categoria
    category_image VARCHAR(255) UNIQUE,
    PRIMARY KEY (category_id)
);

CREATE TABLE entrepreneur (
    entrepreneur_id INT AUTO_INCREMENT,
    entrepreneur_name VARCHAR(50),
    entrepreneur_lastname VARCHAR(50),
    entrepreneur_email VARCHAR(150),
    PRIMARY KEY (entrepreneur_id)
);

CREATE TABLE entrepreneurship (
    entrepreneurship_id INT AUTO_INCREMENT,
    entrepreneurship_name VARCHAR(80) NOT NULL UNIQUE,
    entrepreneurship_address VARCHAR(255),
    social_media VARCHAR(120),
    category_fk INT,
    department_fk INT,
    entrepreneur_fk INT UNIQUE,
    PRIMARY KEY (entrepreneurship_id),
    FOREIGN KEY (department_fk) REFERENCES department(department_id),
    FOREIGN KEY (category_fk) REFERENCES category(category_id),
    FOREIGN KEY (entrepreneur_fk) REFERENCES entrepreneur(entrepreneur_id)
);

CREATE TABLE product (
    product_id INT AUTO_INCREMENT,
    product_name VARCHAR(100),
    product_image VARCHAR(255),
    product_description TEXT,
    product_innovation VARCHAR(120),
    entrepreneurship_fk INT,
    PRIMARY KEY (product_id),
    FOREIGN KEY (entrepreneurship_fk) REFERENCES entrepreneurship(entrepreneurship_id)
);