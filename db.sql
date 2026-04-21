CREATE DATABASE IF NOT EXISTS ugb_inscripciones;
USE ugb_inscripciones;

CREATE TABLE carreras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    facultad VARCHAR(150) NOT NULL,
    cupos INT NOT NULL
);

CREATE TABLE aspirantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(255) NOT NULL,
    departamento VARCHAR(100) NULL,
    modalidad VARCHAR(50) NOT NULL,
    carrera_id INT,
    FOREIGN KEY (carrera_id) REFERENCES carreras(id)
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO carreras (nombre, facultad, cupos) VALUES
('Ingeniería en Sistemas y Redes', 'Ciencia y Tecnología', 30),
('Ingeniería Industrial', 'Ciencia y Tecnología', 25),
('Doctorado en Medicina', 'Ciencias de la Salud', 40),
('Licenciatura en Enfermería', 'Ciencias de la Salud', 20),
('Licenciatura en Derecho', 'Ciencias Jurídicas', 35);

INSERT INTO usuarios (username, password) VALUES
('admin', '$2y$10$U8egqm1dPhU733CH0GL.kOsNjdT6Tq9.yGnMtypwYHxlq0YTC5Cg2');