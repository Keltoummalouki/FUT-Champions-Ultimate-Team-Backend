CREATE DATABASE fut;

USE fut;

CREATE TABLE NATIONALITY (
    id INT PRIMARY KEY  AUTO_INCREMENT,
    name VARCHAR(255),
    flag VARCHAR(255)
);

CREATE TABLE CLUBS (
    id INT PRIMARY KEY  AUTO_INCREMENT,
    club VARCHAR(255),
    logo VARCHAR(255)
);

CREATE TABLE PLAYER (
    id INT PRIMARY KEY  AUTO_INCREMENT,
    name VARCHAR(255),
    photo VARCHAR(200),
    position VARCHAR(200),
    nationality_id INT,
    club_id INT,
    rating INT,
    status ENUM('On the field','reserve'),
    FOREIGN KEY (nationality_id) REFERENCES NATIONALITY(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (club_id) REFERENCES CLUBS(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE GK_POSITION (
    id INT PRIMARY KEY  AUTO_INCREMENT,
    diving INT,
    handling INT,
    kicking INT,
    reflexes INT,
    speed INT,
    positioning INT,
    player_id INT,
    FOREIGN KEY (player_id) REFERENCES PLAYER(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE NORMAL_PLAYER (
    id INT PRIMARY KEY  AUTO_INCREMENT,
    pace INT,
    shooting INT,
    passing INT,
    dribbling INT,
    player_id INT,
    FOREIGN KEY (player_id) REFERENCES PLAYER(id) ON DELETE CASCADE ON UPDATE CASCADE
);

