



create table user (
	user_id int auto_increment primary key,
	first_name varchar(255),
	last_name varchar(255),
	dateofbirth date,
	gender char
);

insert into user (first_name, last_name, dateofbirth, gender) values ("Joe", "Smith", "1972-11-13", "M");
insert into user (first_name, last_name, dateofbirth, gender) values ("Bob", "Jones", "1972-11-13", "M");
insert into user (first_name, last_name, dateofbirth, gender) values ("Frank", "Askridoo", "1965-02-03", "M");
insert into user (first_name, last_name, dateofbirth, gender) values ("Beth", "Miller", "1987-01-25", "F");



-- updated original
create table invoice (
	invoice_id int auto_increment primary key,
	-- invoice int NOT NULL,
	saledate date NOT NULL,
	customer_id int NOT NULL,
	total decimal (7,2)
);


-- insert into invoice (line_items, saledate) values ( 1001, 1, "2014-10-27");
-- insert into invoice (line_items, saledate) values ( 1001, 2, "2014-10-27");
-- insert into invoice (line_items, saledate) values ( 1001, 3, "2014-10-27");
-- insert into invoice (line_items, saledate) values ( 1002, 4, "2014-10-27");
-- insert into invoice (line_items, saledate) values ( 1003, 5, "2014-10-27");
-- insert into invoice (line_items, saledate) values ( 1004, 6, "2014-10-28");
-- insert into invoice (line_items, saledate) values ( 1004, 7, "2014-10-28");



create table line_items (
	invoice_id int NOT NULL,
	product_id int NOT NULL,
	quantity int NOT NULL
);

insert into line_items (invoice_id, product_id, quantity) values (1001, 1, 2);
insert into line_items (invoice_id, product_id, quantity) values (1001, 3, 2);
insert into line_items (invoice_id, product_id, quantity) values (1001, 5, 2);
insert into line_items (invoice_id, product_id, quantity) values (1002, 6, 2);
insert into line_items (invoice_id, product_id, quantity) values (1003, 2, 2);
insert into line_items (invoice_id, product_id, quantity) values (1004, 4, 2);
insert into line_items (invoice_id, product_id, quantity) values (1004, 3, 2);



create table product (
	product_id int auto_increment primary key,
	name varchar(255),
	description varchar(255),
	price decimal (6, 2)
);



insert into product (name, description, price) values ("widget", "A small mechanical device.", 3.75);
insert into product (name, description, price) values ("gadget", "Ingenious mechanical device.", 22.75);
insert into product (name, description, price) values ("gizmo", "Does things.", 3.75);
insert into product (name, description, price) values ("doohickey", "Type of dingus.", 3.75);
insert into product (name, description, price) values ("thingumbob", "Useful for all occasions!", 3.75);
insert into product (name, description, price) values ("thingamajig", "Not sure what it's for.", 3.75);




-- select distinct invoice, name, price from line_items, invoice, product where line_items.product_id = product.product_id and line_items.invoice_id = invoice.invoice;



/*SELECT
	user_id,
	user.name,
	product.name,
	quantity
FROM user
JOIN user_purchase USING (user_id)
JOIN product USING (product_id)

-- when use join, specify that user_id and product_id are identical
-- join grabs any matches of tables already introduced

-- adding this to the above, will group user_id's together
-- if conflict, defaults to firstone
-- therefore, have to tell it to sum the differences, but give "funny" name.
-- change quantity to SUM(quantity)....  then as total
GROUP BY user_id


end up with this improved
SELECT
	user_id,
	user.name as user_name,
	product.name,
	SUM(quantity) as Total
FROM user
JOIN user_purchase USING (user_id)
JOIN product USING (product_id)
GROUP BY user_id*/


/*select
	*
FROM
	user
JOIN user_purchase (user_id)



select
	*
FROM
	user
LEFT JOIN user_purchase (user_id)
-- will select every user_id...*/




