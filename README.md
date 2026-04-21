# Sistema de Login - Parcial

Proyecto de sistema de autenticación con PHP y MySQL.

## Estructura de Carpetas

```
parcial/
├── db.php          # Conexión a la base de datos
├── index.php       # Página principal (requiere autenticación)
├── login.php       # Página de inicio de sesión
├── logout.php      # Script para cerrar sesión
├── style.css       # Estilos CSS
└── readme.md       # Este archivo
```

## Requisitos

- PHP 7.4+
- MySQL 5.7+
- Apache/Nginx

## Instalación

1. Crea una base de datos MySQL llamada `parcial_db`
2. Crea una tabla `users` con los campos: id, username, password
3. Coloca los archivos en la carpeta del servidor web
4. Configura las credenciales de la base de datos en `db.php`

## Uso

- Accede a `login.php` para iniciar sesión
- Los usuarios autenticados pueden acceder a `index.php`
- Usa `logout.php` para cerrar sesión

## Seguridad

- Las contraseñas están hasheadas con `password_hash()`
- Se validan con `password_verify()`
- Se usa `prepared statements` para prevenir inyecciones SQL
Parcial de Segundo Computo

# Integrantes
-Kriscia Tatiana DelCid Argueta
-Ludwin Saúl Vásquez Romero

# Preguntas de análisis

• ¿Cómo manejan la conexión a la BD y qué pasa si algunos de los datos son incorrectos?
Justifiquen la manera de validación de la conexión.

• ¿Cuál es la diferencia entre $_GET y $_POST en PHP? ¿Cuándo es más apropiado usar
cada uno? Da un ejemplo real de tu proyecto.

• Tu app va a usarse en una empresa de la zona oriental. ¿Qué riesgos de seguridad
identificas en una app web con BD que maneja datos de los usuarios? ¿Cómo los
mitigarían?

# diccionario de datos:

Columna    |  Tipo de dato  | Limite de caracteres |  ¿Es nulo?  | Descripción  |
