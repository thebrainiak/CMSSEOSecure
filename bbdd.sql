CREATE DATABASE capycontent;

USE capycontent;

CREATE TABLE users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    salt VARCHAR(255) NOT NULL,
    role ENUM('admin', 'editor', 'user') NOT NULL DEFAULT 'user'
);


CREATE TABLE posts (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    link VARCHAR(255) NOT NULL,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;
);

CREATE TABLE visitors (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  ip_address VARCHAR(50) NOT NULL,
  country VARCHAR(50) NOT NULL,
  visit_time DATETIME NOT NULL
);


SET GLOBAL general_log = 'ON';

ALTER TABLE users ADD UNIQUE (email);

ALTER TABLE users MODIFY password VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
