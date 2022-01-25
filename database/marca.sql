SELECT * FROM productos p;   

SELECT p.id, p.categoria_id, c.categorias as nombreCategoria, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.imagen from productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE (p.nombre LIKE '%Telefono1%' OR p.marca LIKE '%Telefono1%' OR p.stock LIKE '%Telefono1%' OR p.precio LIKE '%Telefono1%' OR p.oferta LIKE '%Telefono1%' OR c.categorias LIKE '%Telefono1%') AND p.categoria_id = 13;

SELECT p.marca, COUNT(p.marca) as cuantos from productos p INNER JOIN categorias c ON p.categoria_id = c.id GROUP BY p.marca HAVING COUNT(p.marca) > 1;
SELECT marca, memoria_ram, precio from productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE (p.precio >= 0 and p.precio <= 20 or p.precio >= 50 and p.precio <= 100 or p.precio >= 100 and p.precio <= 1000000) and c.id = 13;


SELECT p.categoria_id, p.marca, p.memoria_ram, precio FROM productos p INNER JOIN categorias c ON p.categoria_id = c.id and c.id = 15;


UPDATE productos SET p.categoria_id = 5, p.nombre = 'Xiaomiff', p.descripcion = 'dd', p.precio =  0, p.stock =  0, p.oferta = 5, p.marca = 'xiamo3.0', p.memoria_ram =  0, p.imagen = 'a.jpg' INNER JOIN categorias c ON p.categoria_id = c.id WHERE p.id = 5;

UPDATE productos SET categoria_id = 5, nombre = 'Xiaomiffhhh', descripcion = 'dd', precio =  0, stock =  0, oferta = 5, marca = 'xiamo3.0', memoria_ram =  0, imagen = 'a.jpg' WHERE id = 5;


