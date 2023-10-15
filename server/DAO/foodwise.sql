DROP DATABASE IF EXISTS foodwise;
CREATE DATABASE foodwise;
USE foodwise;



DROP TABLE IF EXISTS shoppinglist;
CREATE TABLE shoppinglistitem (
    id int auto_increment primary key,
    item varchar(255) not null,
    quantity int not null,
    checkStatus boolean not null default false,
    shoppingID varchar(255) not null
);