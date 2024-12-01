CREATE TABLE categories{
    id INT AUTO_INCREMENT PRIMARY KEY FOREIGN KEY,
    name VARCHAR(25),
    image MEDIUMBLOB,
    description VARCHAR(255) NOT NULL
};

-- category----
-- ->id (pk)(fk)
-- ->name
-- ->desc
-- ->image
-- ->add
-- ->delete
-- ->edit