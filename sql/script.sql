/**
 * @file script.sql
 * @brief SQL script for the script table.
 * @author Juan Manuel Toscano Reyes <jtoscanoreyes.guadalupe@alumno.fundacionloyola.net>
 */
-- Create the database
CREATE DATABASE LearningWords;
-- Use the database
USE LearningWords;
-- Create the table usuarios
CREATE TABLE usuarios(
    idUsuario int unsigned not null auto_increment primary key,
    correo varchar(120) not null unique,
    password varchar(255) not null,
    puntuacionMaxima tinyint unsigned null,
    tipo char(1) not null default 'u' check(tipo in ('u','a'))
);
-- Create the table tipos
CREATE TABLE tipos(
    idTipo tinyint unsigned not null auto_increment primary key,
    nombreTipo varchar(100) not null
);
-- Create the table palabras
CREATE TABLE palabras(
    idPalabra smallint unsigned not null auto_increment primary key,
    palabraIngles varchar(100) not null,
    palabraEspanol varchar(100) not null,
    idTipo tinyint unsigned not null,
    CONSTRAINT fk_tipos FOREIGN KEY (idTipo) REFERENCES tipos(idTipo)
);
-- Create the table partidas
CREATE TABLE partidas(
    idPartida int unsigned not null auto_increment primary key,
    tiempo time not null,
    nAciertos tinyint unsigned not null,
    nErrores tinyint unsigned not null,
    puntuacion tinyint unsigned not null,
    fechaHora datetime not null,
    idUsuario int unsigned not null,
    idTipo tinyint unsigned not null,
    CONSTRAINT fk_usuarios FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario),
    CONSTRAINT fk_tipos2 FOREIGN KEY (idTipo) REFERENCES tipos(idTipo)
);
-- Create the table partidas_palabras
CREATE TABLE partidas_palabras(
    idPartida int unsigned not null,
    idPalabra smallint unsigned not null,
    acertada boolean not null,
    PRIMARY KEY (idPartida, idPalabra),
    CONSTRAINT fk_partidas FOREIGN KEY (idPartida) REFERENCES partidas(idPartida),
    CONSTRAINT fk_palabras FOREIGN KEY (idPalabra) REFERENCES palabras(idPalabra)
);
