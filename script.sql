CREATE DATABASE kd_electronics;
USE kd_electronics;

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(20) UNIQUE NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio_base DECIMAL(10,2) NOT NULL,
    precio_venta DECIMAL(10,2) NOT NULL,
    categoria VARCHAR(50),
    cantidad INT NOT NULL,
    estado BOOLEAN DEFAULT 1
);