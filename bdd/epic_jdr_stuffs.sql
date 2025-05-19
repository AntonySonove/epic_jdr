USE epic_jdr;
CREATE TABLE IF NOT EXISTS stuffs(
	id_stuff INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name_stuff VARCHAR (50),
    lp_stuff INT,
    atk_stuff INT,
    def_stuff INT,
    atkm_stuff INT,
    defm_stuff INT,
    speed_stuff INT
)engine=InnoDB;
CREATE TABLE IF NOT EXISTS characters_stuffs(
	id_character INT,
    id_stuff INT,
    PRIMARY KEY (id_character, id_stuff)
)engine=InnoDB;
ALTER TABLE characters_stuffs
	ADD CONSTRAINT fk_characters
    FOREIGN KEY (id_character) REFERENCES characters (id_character);
ALTER TABLE characters_stuffs
	ADD CONSTRAINT fk_stuffs
    FOREIGN KEY (id_stuff) REFERENCES stuffs (id_stuff);
   
    
