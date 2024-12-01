CREATE TABLE order(
    id INT AUTO_INCREMENT PRIMARY KEY,
    item varchar(25),
    category varchar(25),
    quantity INT(10),
    price INT(10),
    tax INT(10),
    total_amount INT(10),
    name varchar(25),
    mobile varchar(10),
    address varchar(255),
    area varchar(255),
    landmark varchar(255),
    pincode varchar(6),
    city varchar(25)
);