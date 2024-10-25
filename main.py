import sqlite3

# Conectar a la base de datos SQLite (esto crea el archivo .db si no existe)
conn = sqlite3.connect('hotel.db')
cursor = conn.cursor()

# Crear las tablas según el SQL dump
cursor.execute('''
CREATE TABLE IF NOT EXISTS departamentos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    descripcion TEXT NOT NULL,
    imagen TEXT NOT NULL
)
''')

cursor.execute('''
CREATE TABLE IF NOT EXISTS galeria (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    tipo TEXT NOT NULL,
    imagen TEXT NOT NULL
)
''')

cursor.execute('''
CREATE TABLE IF NOT EXISTS reservas (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    fecha_entrada DATE NOT NULL,
    fecha_salida DATE NOT NULL,
    tipo_habitacion TEXT NOT NULL,
    adultos INTEGER NOT NULL,
    ninos INTEGER NOT NULL
)
''')

# Insertar datos en la tabla departamentos
departamentos_data = [
    (1, 'Recepción', 'Atención personalizada las 24 horas del día.', 'uploads/Presentacion8.jpg'),
    (2, 'Restaurante', 'Cocina gourmet con platillos internacionales.', 'uploads/Presentacion2.jpg'),
    (3, 'Habitaciones', 'Comodidad y elegancia en cada habitación.', 'uploads/Presentacion3.jpg'),
    (4, 'Spa', 'Relájate en nuestro spa de lujo.', 'uploads/Presentacion5(1).jpg'),
    (5, 'Gimnasio', 'Instalaciones modernas para mantenerse en forma.', 'uploads/Presentacion4.jpg'),
    (6, 'Sala de reuniones', 'Disfruta un ambiente seguro y tranquilo', 'uploads/Presentacion10(1).jpg'),
]

cursor.executemany('INSERT INTO departamentos VALUES (?, ?, ?, ?)', departamentos_data)

# Insertar datos en la tabla galeria
galeria_data = [
    (1, 'exterior', 'uploads/Exterior1.png'),
    (2, 'exterior', 'uploads/Exterior2.png'),
    (3, 'exterior', 'uploads/Exterior3.png'),
    (4, 'exterior', 'uploads/Exterior4.png'),
    (5, 'exterior', 'uploads/Exterior5.png'),
    (6, 'interior', 'uploads/Interior1.png'),
    (7, 'interior', 'uploads/Interior2.png'),
    (8, 'interior', 'uploads/Interior3.png'),
    (9, 'interior', 'uploads/Interior4.png'),
    (10, 'interior', 'uploads/Interior5.png'),
    (11, 'piscina', 'uploads/Piscina1.png'),
    (12, 'piscina', 'uploads/Piscina2.png'),
    (13, 'piscina', 'uploads/Piscina3.png'),
    (14, 'piscina', 'uploads/Piscina4.png'),
    (15, 'piscina', 'uploads/Piscina5.png'),
]

cursor.executemany('INSERT INTO galeria VALUES (?, ?, ?)', galeria_data)

# Insertar datos en la tabla reservas
reservas_data = [
    (1, '2024-10-22', '2024-10-31', 'doble', 2, 1),
]

cursor.executemany('INSERT INTO reservas VALUES (?, ?, ?, ?, ?, ?)', reservas_data)

# Guardar los cambios y cerrar la conexión
conn.commit()
conn.close()

print("Base de datos 'hotel.db' creada con éxito.")
