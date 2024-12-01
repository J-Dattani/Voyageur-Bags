CREATE TABLE team(
    id INT AUTO_INCREMENT PRIMARY KEY,
    member VARCHAR(25),
    image MEDIUMBLOB,
    designation VARCHAR(25)
);

-- TEAM MEMBERS
INSERT INTO team (member, designation, image) VALUES ('Mittchel Fawset','CMO', LOAD_FILE('C:/laragon/www/internship_project/img/person1.png'))

INSERT INTO team (member, image, designation) VALUES ('Benjamin meston
', LOAD_FILE('C:\laragon\www\internship_project\img\person2.png'),'CEO')

INSERT INTO team (member, image, designation) VALUES ('Korina Villanueva
', LOAD_FILE('C:\laragon\www\internship_project\img\person3.png'),'Product Designer')