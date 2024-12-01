CREATE TABLE user(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30),
    gender varchar(15) NOT NULL,
    email VARCHAR(30),
    password VARCHAR(30) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);  


INSERT into user (name,gender,email,password) VALUES ('user1','male','user1@gmail.com','@user1**')

INSERT into user (name,gender,email,password) VALUES ('user2','male','user2@gmail.com','@user2*')