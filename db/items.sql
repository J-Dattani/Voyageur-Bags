CREATE TABLE items(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(25) NOT NULL,
    category VARCHAR(30) UNIQUE NOT NULL,
    description VARCHAR(255),
    price INT(10)
    image MEDIUMBLOB,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

INSERT into items (name,category,description,image) VALUES ('TRAVALATE Duffle Bag','DUFFLE BAGS','TRAVALATE 50L Foldable Travel Duffle Bag with Separate Shoe Compartment and Adjustable Shoulder Strap | Water and Tear Resistant Overnight Bag for Men & Women – Black', LOAD_FILE('C:\laragon\www\internship_project\img\product1.jpg')
);




