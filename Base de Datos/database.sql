DROP DATABASE IF EXISTS pokemonsAllioEzequiel;

CREATE DATABASE pokemonsAllioEzequiel;

USE pokemonsAllioEzequiel;

CREATE TABLE Pokemon(
    ID integer NOT NULL AUTO_INCREMENT,
    Nombre varchar(30) NOT NULL,
    Imagen varchar(30) NOT NULL,
    constraint PK_Pokemon_ID primary key (ID)
);

CREATE TABLE Tipo(
    ID integer NOT NULL AUTO_INCREMENT,
    Nombre varchar(30) NOT NULL,
    Imagen varchar(30) NOT NULL,
    constraint PK_Tipo_ID primary key (ID)
);

CREATE TABLE TipoPokemon(
    ID_Tipo integer NOT NULL,
    ID_Pokemon integer NOT NULL,
    primary key (ID_Tipo, ID_Pokemon),
    constraint FK_TipoPokemon_Tipo foreign key (ID_Tipo) references Tipo (ID),
    constraint FK_TipoPokemon_Pokemon foreign key (ID_Pokemon) references Pokemon (ID)
);

CREATE TABLE Usuario(
    ID integer NOT NULL AUTO_INCREMENT,
    Nombre varchar(30) NOT NULL,
    Apellido varchar(30) NOT NULL,
    Username varchar(30) UNIQUE NOT NULL,
    UPassword varchar(100) NOT NULL,
    Email varchar(30) UNIQUE NOT NULL,
    constraint PK_Usuario_ID primary key (ID)
);

INSERT INTO Usuario (Nombre, Apellido, Username, UPassword, Email)
VALUES ("Ezequiel", "Allio", "ezequiel", "eb6a2f962bb597f98b2c2b9c4698da19710ddfa3", "ezequiel.allio@gmail.com");

INSERT INTO Tipo (Nombre, Imagen) VALUES ("Acero", "Acero.jpg");
INSERT INTO Tipo (Nombre, Imagen) VALUES ("Agua", "Agua.jpg");
INSERT INTO Tipo (Nombre, Imagen) VALUES ("Bicho", "Bicho.jpg");
INSERT INTO Tipo (Nombre, Imagen) VALUES ("Dragon", "Dragon.jpg");
INSERT INTO Tipo (Nombre, Imagen) VALUES ("Electrico", "Electrico.jpg");
INSERT INTO Tipo (Nombre, Imagen) VALUES ("Fantasma", "Fantasma.jpg");
INSERT INTO Tipo (Nombre, Imagen) VALUES ("Fuego", "Fuego.jpg");
INSERT INTO Tipo (Nombre, Imagen) VALUES ("Hada", "Hada.jpg");
INSERT INTO Tipo (Nombre, Imagen) VALUES ("Hielo", "Hielo.jpg");
INSERT INTO Tipo (Nombre, Imagen) VALUES ("Lucha", "Lucha.jpg");
INSERT INTO Tipo (Nombre, Imagen) VALUES ("Normal", "Normal.jpg");
INSERT INTO Tipo (Nombre, Imagen) VALUES ("Planta", "Planta.jpg");
INSERT INTO Tipo (Nombre, Imagen) VALUES ("Psiquico", "Psiquico.jpg");
INSERT INTO Tipo (Nombre, Imagen) VALUES ("Roca", "Roca.jpg");
INSERT INTO Tipo (Nombre, Imagen) VALUES ("Siniestro", "Siniestro.jpg");
INSERT INTO Tipo (Nombre, Imagen) VALUES ("Tierra", "Tierra.jpg");
INSERT INTO Tipo (Nombre, Imagen) VALUES ("Veneno", "Veneno.jpg");
INSERT INTO Tipo (Nombre, Imagen) VALUES ("Volador", "Volador.jpg");
INSERT INTO Tipo (Nombre, Imagen) VALUES ("Desconocido", "Desconocido.jpg");

INSERT INTO Pokemon (Nombre, Imagen) VALUES ("Bulbasaur", "Bulbasaur.jpg");
INSERT INTO Pokemon (Nombre, Imagen) VALUES ("Charmander", "Charmander.jpg");
INSERT INTO Pokemon (Nombre, Imagen) VALUES ("Metapod", "Metapod.jpg");
INSERT INTO Pokemon (Nombre, Imagen) VALUES ("Venusaur", "Venusaur.jpg");
INSERT INTO Pokemon (Nombre, Imagen) VALUES ("Squirtle", "Squirtle.jpg");

INSERT INTO TipoPokemon (ID_Tipo, ID_Pokemon) VALUES (12, 1);
INSERT INTO TipoPokemon (ID_Tipo, ID_Pokemon) VALUES (17, 1);
INSERT INTO TipoPokemon (ID_Tipo, ID_Pokemon) VALUES (7, 2);
INSERT INTO TipoPokemon (ID_Tipo, ID_Pokemon) VALUES (3, 3);
INSERT INTO TipoPokemon (ID_Tipo, ID_Pokemon) VALUES (12, 4);
INSERT INTO TipoPokemon (ID_Tipo, ID_Pokemon) VALUES (17, 4);
INSERT INTO TipoPokemon (ID_Tipo, ID_Pokemon) VALUES (2, 5);