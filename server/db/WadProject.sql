DROP DATABASE IF EXISTS wad2project;
CREATE DATABASE wad2project;
USE  wad2project;


drop table if exists activeinv;
create table activeinv(
    userid int not null,
    serial int not null,
    item varchar(45) not null,
    qty varchar(45) not null,
    expiry date not null,
    category varchar(45) not null,
    constraint activeinvpk primary key (userid, serial)  
);

drop table if exists historicalinv;
create table historicalinv(
userid int not null,
serial int not null,
item varchar(45) not null,
qty varchar(3) not null,
expiry date not null,
status varchar(8) not null,
category varchar(45) not null,
constraint historicalinvpk primary key (userid, serial)
);

DROP TABLE IF EXISTS account;
CREATE TABLE account (
    userid int auto_increment primary key,
    username varchar(50) not null,
    hashedpw varchar(255) not null,
    email varchar(255) not null,
    dateCreated date not null
);

DROP TABLE IF EXISTS SearchHistory;
CREATE TABLE SearchHistory (
    userid int not null,
    search varchar(255) not null,
    cuisine varchar(255) not null,
    meal varchar(255) not null,
    diet varchar(255) not null,
    timeCreated DATETIME NOT NULL,
    primary key (userid, timeCreated),
    foreign key (userid) REFERENCES account(userid)
);


DROP TABLE IF EXISTS shoppinglist;
CREATE TABLE shoppinglistitem (
    id int auto_increment primary key,
    item varchar(255) not null,
    category varchar(255) not null,
    quantity int not null,
	checkStatus boolean not null default false,
    userid int not null,
    -- FK FROM account userid
    FOREIGN KEY (userid) REFERENCES account(userid)
);

DROP TABLE IF EXISTS postShoppinglistitem;
CREATE TABLE postShoppinglistitem (
    id int auto_increment primary key,
    item varchar(255) not null,
    category varchar(255) not null,
    quantity int not null,
    userid int not null,
    -- FK FROM account userid
    FOREIGN KEY (userid) REFERENCES account(userid)
);


-- add user accounts
INSERT INTO account (username, hashedpw,email,dateCreated) VALUES ('admin', '$2y$10$spHJVK.ocDd0UHvrwHiZGOXu3ktdCzsaUNJAaIf9NqeztGFfzF5ni','admin@gmail.com',current_date());
INSERT INTO account (username, hashedpw,email,dateCreated) VALUES ('user', '$2y$10$spHJVK.ocDd0UHvrwHiZGOXu3ktdCzsaUNJAaIf9NqeztGFfzF5ni','user@gmail.com',current_date());

-- add shopping list items
INSERT INTO shoppinglistitem (item, category, quantity, checkStatus, userid) VALUES ('Milk', 'Dairy and Protein', 1, true, 1);
INSERT INTO shoppinglistitem (item, category, quantity, checkStatus, userid) VALUES ('Eggs', 'Dairy and Protein', 12, true, 1);
INSERT INTO shoppinglistitem (item, category, quantity, checkStatus, userid) VALUES ('Bread', 'Dairy and Protein', 2, true, 1);
INSERT INTO shoppinglistitem (item, category, quantity, checkStatus, userid) VALUES ('Butter', 'Dairy and Protein', 1, false , 1);
INSERT INTO shoppinglistitem (item, category, quantity, checkStatus, userid) VALUES ('Cheese', 'Dairy and Protein', 1, false, 2);
INSERT INTO shoppinglistitem (item, category, quantity, checkStatus, userid) VALUES ('Bacon', 'Dairy and Protein', 1, false, 2);
INSERT INTO shoppinglistitem (item, category, quantity, checkStatus, userid) VALUES ('Sausages', 'Dairy and Protein', 1, false, 2);
INSERT INTO shoppinglistitem (item, category, quantity, checkStatus, userid) VALUES ('Carrot', 'Produce', 1, false, 2);
INSERT INTO shoppinglistitem (item, category, quantity, checkStatus, userid) VALUES ('Onion', 'Produce', 1, false, 2);
INSERT INTO shoppinglistitem (item, category, quantity, checkStatus, userid) VALUES ('Salt', 'Snacks and Pantry', 1, false, 2);

-- add post shopping list items
INSERT INTO postShoppinglistitem (item, category, quantity, userid) VALUES ('Milk', 'Dairy and Protein', 1, 1);
INSERT INTO postShoppinglistitem (item, category, quantity, userid) VALUES ('Milk', 'Dairy and Protein', 1, 1);
INSERT INTO postShoppinglistitem (item, category, quantity, userid) VALUES ('Milk', 'Dairy and Protein', 1, 1);
INSERT INTO postShoppinglistitem (item, category, quantity, userid) VALUES ('Milk', 'Dairy and Protein', 1, 1);
INSERT INTO postShoppinglistitem (item, category, quantity, userid) VALUES ('Milk', 'Dairy and Protein', 1, 1);
INSERT INTO postShoppinglistitem (item, category, quantity, userid) VALUES ('Bread', 'Dairy and Protein', 1, 1);
INSERT INTO postShoppinglistitem (item, category, quantity, userid) VALUES ('Bread', 'Dairy and Protein', 1, 1);
INSERT INTO postShoppinglistitem (item, category, quantity, userid) VALUES ('Apple', 'Produce', 1, 1);
INSERT INTO postShoppinglistitem (item, category, quantity, userid) VALUES ('Apple', 'Produce', 1, 1);
INSERT INTO postShoppinglistitem (item, category, quantity, userid) VALUES ('Onion', 'Produce', 1, 1);
INSERT INTO postShoppinglistitem (item, category, quantity, userid) VALUES ('Salt', 'Snacks and Pantry', 1, 1);


-- add active inventory items
INSERT INTO activeinv (userid, serial, item, qty, expiry, category) VALUES (1, 1, 'Cod Fish', 1, '2023-12-31', 'Dairy and Protein');
INSERT INTO activeinv (userid, serial, item, qty, expiry, category) VALUES (1, 2, 'Salmon', 1, '2023-12-31', 'Dairy and Protein');
INSERT INTO activeinv (userid, serial, item, qty, expiry, category) VALUES (1, 3, 'Potato', 13, '2023-11-30', 'Produce');
INSERT INTO activeinv (userid, serial, item, qty, expiry, category) VALUES (1, 4, 'Carrot', 1, '2023-11-30', 'Produce');
INSERT INTO activeinv (userid, serial, item, qty, expiry, category) VALUES (1, 5, 'Onion', 1, '2023-11-30', 'Produce');
INSERT INTO activeinv (userid, serial, item, qty, expiry, category) VALUES (1, 8, 'Chicken', 1, '2023-11-30', 'Dairy and Protein');