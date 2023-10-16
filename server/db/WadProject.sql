DROP DATABASE IF EXISTS wad2project;
CREATE DATABASE wad2project;
USE  wad2project;


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
    shoppingID varchar(255) not null,
    userid int not null,
    -- FK FROM Account userid
    FOREIGN KEY (userid) REFERENCES Account(userid)
);


-- add user accounts
INSERT INTO Account (username, hashedpw) VALUES ('admin', 'admin');
INSERT INTO Account (username, hashedpw) VALUES ('user', 'user');

-- add shopping list items
INSERT INTO shoppinglistitem (item, quantity, checkStatus, shoppingID, userid) VALUES ('Milk', 1, false, '1', 1);
INSERT INTO shoppinglistitem (item, quantity, checkStatus, shoppingID, userid) VALUES ('Eggs', 12, false, '1', 1);
INSERT INTO shoppinglistitem (item, quantity, checkStatus, shoppingID, userid) VALUES ('Bread', 2, false, '1', 1);
INSERT INTO shoppinglistitem (item, quantity, checkStatus, shoppingID, userid) VALUES ('Butter', 1, false, '1', 1);
INSERT INTO shoppinglistitem (item, quantity, checkStatus, shoppingID, userid) VALUES ('Cheese', 1, false, '1', 1);
INSERT INTO shoppinglistitem (item, quantity, checkStatus, shoppingID, userid) VALUES ('Bacon', 1, false, '1', 1);
INSERT INTO shoppinglistitem (item, quantity, checkStatus, shoppingID, userid) VALUES ('Sausages', 1, false, '1', 1);

INSERT INTO shoppinglistitem (item, quantity, checkStatus, shoppingID, userid) VALUES ('Corn', 1, false, '2', 1);
INSERT INTO shoppinglistitem (item, quantity, checkStatus, shoppingID, userid) VALUES ('Fish', 12, false, '2', 1);
INSERT INTO shoppinglistitem (item, quantity, checkStatus, shoppingID, userid) VALUES ('Chicken', 2, false, '2', 1);
INSERT INTO shoppinglistitem (item, quantity, checkStatus, shoppingID, userid) VALUES ('Pork Belly', 1, false, '2', 1);