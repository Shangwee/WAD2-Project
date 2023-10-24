DROP DATABASE IF EXISTS wad2project;
CREATE DATABASE wad2project;
USE  wad2project;


drop table if exists activeinv;
create table activeinv(
    userid int not null,
    serial int not null,
    item varchar(45) not null,
    quantity varchar(45) not null,
    expiry date not null,
    category varchar(45) not null,
    constraint activeinvpk primary key (uid, serial)
);

DROP TABLE IF EXISTS Account;
CREATE TABLE Account (
    userid int auto_increment primary key,
    username varchar(50) not null,
    hashedpw varchar(255) not null
);

DROP TABLE IF EXISTS shoppinglist;
CREATE TABLE shoppinglistitem (
    id int auto_increment primary key,
    item varchar(255) not null,
    quantity int not null,
	checkStatus boolean not null default false,
    userid int not null,
    -- FK FROM Account userid
    FOREIGN KEY (userid) REFERENCES Account(userid)
);


-- add user accounts
INSERT INTO Account (username, hashedpw) VALUES ('admin', '$2y$10$spHJVK.ocDd0UHvrwHiZGOXu3ktdCzsaUNJAaIf9NqeztGFfzF5ni');
INSERT INTO Account (username, hashedpw) VALUES ('user', '$2y$10$spHJVK.ocDd0UHvrwHiZGOXu3ktdCzsaUNJAaIf9NqeztGFfzF5ni');

-- add shopping list items
INSERT INTO shoppinglistitem (item, quantity, checkStatus, userid) VALUES ('Milk', 1, true, 1);
INSERT INTO shoppinglistitem (item, quantity, checkStatus, userid) VALUES ('Eggs', 12, true, 1);
INSERT INTO shoppinglistitem (item, quantity, checkStatus, userid) VALUES ('Bread', 2, true, 1);
INSERT INTO shoppinglistitem (item, quantity, checkStatus, userid) VALUES ('Butter', 1, false , 1);
INSERT INTO shoppinglistitem (item, quantity, checkStatus, userid) VALUES ('Cheese', 1, false, 1);
INSERT INTO shoppinglistitem (item, quantity, checkStatus, userid) VALUES ('Bacon', 1, false, 1);
INSERT INTO shoppinglistitem (item, quantity, checkStatus, userid) VALUES ('Sausages', 1, false, 1);


-- add active inventory items
INSERT INTO activeinv (userid, serial, item, quantity, expiry, category) VALUES (1, 1, 'Cod Fish', 1, '2023-12-31', 'Meat');
INSERT INTO activeinv (userid, serial, item, quantity, expiry, category) VALUES (1, 2, 'Salmon', 1, '2023-12-31', 'Meat');
INSERT INTO activeinv (userid, serial, item, quantity, expiry, category) VALUES (1, 3, 'Potato', 13, '2023-10-31', 'Vegetable');
INSERT INTO activeinv (userid, serial, item, quantity, expiry, category) VALUES (1, 4, 'Carrot', 1, '2023-10-31', 'Vegetable');
INSERT INTO activeinv (userid, serial, item, quantity, expiry, category) VALUES (1, 5, 'Onion', 1, '2023-10-31', 'Vegetable');
INSERT INTO activeinv (userid, serial, item, quantity, expiry, category) VALUES (1, 8, 'Chicken', 1, '2023-10-31', 'Meat');