DROP DATABASE IF EXISTS apimap;

CREATE DATABASE apimap;

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
    PRIMARY KEY (category_id)
);

CREATE TABLE national_calls (
    id INT AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL,
    category_id INT,
    township_id int,
    PRIMARY KEY(id),
    FOREIGN KEY (category_id) REFERENCES category(category_id) ON DELETE CASCADE,
    FOREIGN KEY (township_id) REFERENCES township(township_id) ON DELETE CASCADE
);