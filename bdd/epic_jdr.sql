CREATE DATABASE epic_jdr;
USE epic_jdr;
CREATE TABLE IF NOT EXISTS users(
	id_user INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nickname VARCHAR(50) NOT NULL,
    password_user VARCHAR(250) NOT NULL,
    email VARCHAR(50) NOT NULL
)engine=InnoDB;
CREATE TABLE IF NOT EXISTS characters(
	id_character INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name_character VARCHAR(50) NOT NULL,
    lp INT NOT NULL,
    mp INT NOT NULL,
    atk INT NOT NULL,
    def INT NOT NULL,
    atkm INT NOT NULL,
    defm INT NOT NULL,
    speed INT NOT NULL,
    id_user INT
)engine=InnoDB;

ALTER TABLE characters
	ADD CONSTRAINT fk_users
    FOREIGN KEY (id_user) REFERENCES users (id_user);