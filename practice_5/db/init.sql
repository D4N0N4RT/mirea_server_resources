CREATE DATABASE IF NOT EXISTS coffeeDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT ON coffeeDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE coffeeDB;

CREATE TABLE IF NOT EXISTS users (
    ID INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(20) CHARACTER SET ascii NOT NULL,
    password VARCHAR(45) CHARACTER SET ascii NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS products (
    ID INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(32) NOT NULL,
    volume DECIMAL(3,2) NOT NULL,
    price INT NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS locations (
    ID INT NOT NULL AUTO_INCREMENT,
    address VARCHAR(100) NOT NULL,
    PRIMARY KEY (ID)
);

INSERT INTO users (username, password)
SELECT * FROM (SELECT 'admin', '{SHA}0DPiKuNIrrVmD8IUCuw1hQxNqZc=') AS temp
WHERE NOT EXISTS (
        SELECT username FROM users WHERE username = 'admin' AND password = '{SHA}0DPiKuNIrrVmD8IUCuw1hQxNqZc='
    ) LIMIT 1;

INSERT INTO products (title, volume, price)
SELECT * FROM (SELECT 'Espresso', 0.5, 80) AS temp
WHERE NOT EXISTS (
        SELECT title FROM products WHERE title = 'Espresso' AND volume = 0.5 AND price = 80
    ) LIMIT 1;

INSERT INTO products (title, volume, price)
SELECT * FROM (SELECT 'Latte', 0.33, 95) AS temp
WHERE NOT EXISTS (
        SELECT title FROM products WHERE title = 'Latte' AND volume = 0.33 AND price = 95
    ) LIMIT 1;

INSERT INTO locations (address)
SELECT * FROM (SELECT 'Ryazansky prospekt, 21') AS temp
WHERE NOT EXISTS (
        SELECT address FROM locations WHERE address = 'Ryazansky prospekt, 21'
    ) LIMIT 1;

INSERT INTO locations (address)
SELECT * FROM (SELECT 'Lysytsyna street, 33/1') AS temp
WHERE NOT EXISTS (
        SELECT address FROM locations WHERE address = 'Lisitsina street, 33/1'
    ) LIMIT 1;

INSERT INTO locations (address)
SELECT * FROM (SELECT 'Volgogradskiy prospekt, 102/3') AS temp
WHERE NOT EXISTS (
        SELECT address FROM locations WHERE address = 'Volgogradskiy prospekt, 102/3'
    ) LIMIT 1;