-- =====================================================
-- BASE DE DATOS DEL SISTEMA DE ESTADISTICAS
-- =====================================================

CREATE DATABASE IF NOT EXISTS estadistica
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE estadistica;

-- =====================================================
-- TABLA USUARIOS (LOGIN)
-- =====================================================

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nombre VARCHAR(100),
    email VARCHAR(100),
    rol VARCHAR(50) DEFAULT 'usuario',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Usuario administrador inicial
INSERT INTO users (username, password, nombre, email, rol)
VALUES (
'admin',
'$2y$10$wH7k9k9z1j8z8e8n8e8n8uG3n5j1j1j1j1j1j1j1j1j1j1j1j1',
'Administrador',
'admin@empresa.com',
'admin'
);

-- =====================================================
-- TABLA ESTADOS DEL SISTEMA
-- =====================================================

CREATE TABLE estados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_estado VARCHAR(100) NOT NULL,
    descripcion TEXT,
    porcentaje INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO estados (nombre_estado, descripcion, porcentaje) VALUES
('Pendiente', 'Trabajo pendiente', 10),
('En proceso', 'Trabajo en ejecución', 50),
('Finalizado', 'Trabajo completado', 100);

-- =====================================================
-- TABLA PENDIENTES
-- =====================================================

CREATE TABLE pendientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150),
    descripcion TEXT,
    estado_id INT,
    prioridad VARCHAR(50),
    fecha_limite DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (estado_id) REFERENCES estados(id)
);

INSERT INTO pendientes (titulo, descripcion, estado_id, prioridad) VALUES
('Actualizar sistema', 'Actualizar dashboard estadístico', 1, 'Alta'),
('Revisar reportes', 'Revisión de reportes semanales', 2, 'Media'),
('Generar estadísticas', 'Generar gráficos del mes', 3, 'Alta');

-- =====================================================
-- TABLA ESTADISTICAS
-- =====================================================

CREATE TABLE estadisticas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categoria VARCHAR(100),
    valor INT,
    fecha DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO estadisticas (categoria, valor, fecha) VALUES
('Producción', 120, CURDATE()),
('Ventas', 85, CURDATE()),
('Usuarios activos', 35, CURDATE());

-- =====================================================
-- TABLA PREPARACION DE MATERIALES
-- =====================================================

CREATE TABLE preparacion_materiales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_material VARCHAR(150),
    estado VARCHAR(100),
    responsable VARCHAR(100),
    fecha DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO preparacion_materiales (nombre_material, estado, responsable, fecha) VALUES
('Material A', 'Preparado', 'Juan', CURDATE()),
('Material B', 'Pendiente', 'Maria', CURDATE());

-- =====================================================
-- FIN DEL SCRIPT
-- =====================================================