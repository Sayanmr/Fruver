-- Crear la base de datos
CREATE DATABASE fruver_db;

-- Usar la base de datos
USE fruver_db;

-- Crear tabla 'productos'
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),  -- Usar 100 caracteres, ya que parece más que suficiente
    tipo VARCHAR(100),    -- Usar 100 caracteres
    precio DECIMAL(10,2),
    cantidad INT
);

-- Insertar productos de ejemplo
INSERT INTO productos (nombre, tipo, precio, cantidad) VALUES
('Arroz', 'Cereal', 2.50, 1000),
('Maíz', 'Cereal', 1.80, 1200),
('Trigo', 'Cereal', 3.00, 800),
('Avena','Cereal',2.20, 500),
('Cebada', 'Cereal', 2.70, 1500),
('Centeno', 'Cereal', 3.10, 950),
('Mijo', 'Cereal', 2.40, 750),
('Sorgo', 'Cereal', 2.90, 650),
('Quinoa', 'Cereal', 4.00, 600),
('Amaranto', 'Cereal', 3.50, 450),
('Manzana', 'Fruta', 1.50, 800),
('Plátano', 'Fruta', 1.00, 1200),
('Naranja', 'Fruta', 1.20, 1000),
('Pera', 'Fruta', 1.80, 600),
('Uva', 'Fruta', 2.50, 500),
('Mango', 'Fruta', 2.80, 450),
('Piña', 'Fruta', 3.00, 350),
('Fresa', 'Fruta', 2.20, 700),
('Kiwi', 'Fruta', 3.50, 300),
('Papaya', 'Fruta', 2.00, 800),
('Tomate', 'Vegetal', 1.30, 900),
('Zanahoria', 'Vegetal', 0.90, 1200),
('Lechuga', 'Vegetal', 1.10, 1000),
('Espinaca', 'Vegetal', 2.00, 800),
('Brócoli', 'Vegetal', 2.50, 650),
('Pimiento', 'Vegetal', 1.60, 1100),
('Acelga', 'Vegetal', 1.80, 750),
('Pepino', 'Vegetal', 1.00, 1300),
('Coliflor', 'Vegetal', 2.20, 600),
('Guisante', 'Vegetal', 1.50, 850),
('Lenteja', 'Legumbre', 1.60, 1000),
('Garbanzo', 'Legumbre', 2.00, 900),
('Frijol negro', 'Legumbre', 1.80, 800),
('Frijol rojo', 'Legumbre', 1.90, 850),
('Frijol blanco', 'Legumbre', 2.10, 750),
('Arveja', 'Legumbre', 1.50, 950),
('Habas', 'Legumbre', 2.20, 700),
('Soja', 'Legumbre', 2.40, 600),
('Judía mungo', 'Legumbre', 2.00, 650),
('Alubia', 'Legumbre', 1.70, 800),
('Remolacha 3KGX2000', 'Promocion', 2.00, 650),
('Mango 15% de descuento', 'Promocion', 2.50, 650),
('Frijoles 40% de descuento', 'Promocion', 2.60, 650),
('Avena 20% de descuento', 'Promocion', 3.00, 650);

-- Crear tabla 'usuario'
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    correo VARCHAR(255) UNIQUE,
    contraseña VARCHAR(255),
    fecha_nacimiento DATE
);

-- Insertar usuarios de ejemplo
INSERT INTO usuario (nombre, apellido, correo, contraseña, fecha_nacimiento) VALUES
('Juan', 'Pérez', 'juan.perez@correo.com', 'password123', '1990-05-15'),
('Maria', 'Gómez', 'maria.gomez@correo.com', 'password456', '1985-08-20');

-- Crear tabla 'carro'
CREATE TABLE carro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    carrito INT,
    fecha_creado DATE
);

-- Insertar carritos de ejemplo
INSERT INTO carro (carrito, fecha_creado) VALUES
(1, '2024-11-29'),
(2, '2024-11-28');

-- Crear tabla 'carritos_productos'
CREATE TABLE carritos_productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    carrito_id INT,
    producto_id INT,
    FOREIGN KEY (carrito_id) REFERENCES carro(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

-- Insertar productos en los carritos
INSERT INTO carritos_productos (carrito_id, producto_id) VALUES
(1, 1),  -- Arroz en carrito 1
(1, 2),  -- Maíz en carrito 1
(2, 3),  -- Manzana en carrito 2
(2, 4);  -- Tomate en carrito 2

-- Crear tabla 'usuario_carrito'
CREATE TABLE usuario_carrito (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    carrito_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuario(id),
    FOREIGN KEY (carrito_id) REFERENCES carro(id)
);

-- Insertar usuarios con carritos
INSERT INTO usuario_carrito (usuario_id, carrito_id) VALUES
(1, 1),  -- Usuario Juan tiene el carrito 1
(2, 2);  -- Usuario Maria tiene el carrito 2
