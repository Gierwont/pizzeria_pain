CREATE TABLE user (
    id INT NOT NULL AUTO_INCREMENT ,
    login VARCHAR(50) UNIQUE,
    haslo VARCHAR(50) , 
    email VARCHAR(50),
    admin BIT,
    PRIMARY KEY (id)
    );
INSERT INTO user(login,haslo,email,admin) VALUES ("admin","d033e22ae348aeb5660fc2140aec35850c4da997","macius2115@gmail.com",1);

CREATE TABLE pizza (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nazwa VARCHAR(50),
    skladniki VARCHAR(200),
    cena INT 
);
INSERT INTO pizza(nazwa,skladniki,cena) VALUES ("Margherita","ciasto, sos pomidorowy, ser, oregano",30);
INSERT INTO pizza(nazwa,skladniki,cena) VALUES ("Capriciosa","ciasto, sos pomidorowy, ser, szynka, pieczarki, oregano",44);
INSERT INTO pizza(nazwa,skladniki,cena) VALUES ("Pepperoni","ciasto, sos pomidorowy, ser, salami pepperoni, oregano",42);
INSERT INTO pizza(nazwa,skladniki,cena) VALUES ("Cztery Sery","ciasto, sos pomidorowy, ser, ser mozzarella, ser sałatkowy, ser pleśniowy, oreganon",58);


CREATE TABLE pizza_order (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    numer INT,
    city VARCHAR(50),
    street VARCHAR(50),
    ordered_by VARCHAR(50),
    is_sent VARCHAR(50)
);

ALTER TABLE pizza_order ADD COLUMN user_id INT;
ALTER TABLE pizza_order ADD COLUMN pizza_id INT;

ALTER TABLE pizza_order ADD FOREIGN KEY (user_id) REFERENCES user(id);
ALTER TABLE pizza_order ADD FOREIGN KEY (pizza_id) REFERENCES pizza(id);
