DROP DATABASE IF EXISTS account;
CREATE DATABASE account;
USE account;


CREATE TABLE acc (
    userid int auto_increment primary key,
    username varchar(50) not null,
    hashedpw varchar(255) not null,
);