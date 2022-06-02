/**
 * @file script.sql
 * @brief SQL script for the insert datas into tables.
 * @author Juan Manuel Toscano Reyes <jtoscanoreyes.guadalupe@alumno.fundacionloyola.net>
 */

-- Insert the data into the table usuarios
INSERT INTO usuarios(correo, password, puntuacionMaxima, tipo)
    VALUES  ('admin@evg.es', 'admin', null, 'a'),
              ('user1@evg.es', 'user1', null, 'u');

-- Insert the data into the table tipos
INSERT INTO tipos(nombreTipo)
    VALUES  ('Animales'),
              ('Colores'),
              ('Frutas'),
              ('Habitaciones'),
              ('Nombres'),
              ('Paises'),
              ('Profesiones'),
              ('Verbos'),
              ('Aleatorio');

-- Insert the data into the table palabras
INSERT INTO palabras(palabraIngles, palabraEspanol, idTipo)
    VALUES  ('dog', 'perro', 1),
              ('cat', 'gato', 1),
              ('cow', 'vaca', 1),
              ('horse', 'caballo', 1),
              ('sheep', 'oveja', 1),
              ('pig', 'cerdo', 1),
              ('chicken', 'pollo', 1),
              ('duck', 'pato', 1),
              ('goose', 'ganso', 1),
              ('fish', 'pez', 1),
              ('bird', 'pajaro', 1),
              ('snake', 'serpiente', 1),
              ('lion', 'león', 1),
              ('tiger', 'tigre', 1),
              ('elephant', 'elefante', 1),
              ('giraffe', 'girafa', 1),
              ('monkey', 'mono', 1),
              ('bear', 'oso', 1),
              ('zebra', 'cebra', 1),
              ('horse', 'caballo', 1),
              ('panda', 'panda', 1),
              ('lion', 'león', 1),
              ('tiger', 'tigre', 1),
              ('elephant', 'elefante', 1),
              ('giraffe', 'girafa', 1),
              ('monkey', 'mono', 1),
              ('bear', 'oso', 1),
              ('zebra', 'cebra', 1),
              ('red', 'rojo', 2),
              ('orange', 'naranja', 2),
              ('yellow', 'amarillo', 2),
              ('green', 'verde', 2),
              ('blue', 'azul', 2),
              ('indigo', 'indigo', 2),
              ('violet', 'violeta', 2),
              ('black', 'negro',2);

-- Insert the data into the table partidas
INSERT INTO partidas(tiempo,nAciertos,nErrores,puntuacion,fechaHora,idUsuario,idTipo)
    VALUES  ('00:05:00',10,5,10,now(),2,1);

-- Insert the data into the table partidas_palabras
INSERT INTO partidas_palabras(idPartida,idPalabra,acertada)
    VALUES  (1,1,1),
              (1,2,1),
              (1,3,1),
              (1,4,1),
              (1,5,1),
              (1,6,1),
              (1,7,1),
              (1,8,0),
              (1,9,1),
              (1,10,1),
              (1,11,1),
              (1,12,0),
              (1,13,1),
              (1,14,1),
              (1,15,0),
              (1,16,1),
              (1,17,1);