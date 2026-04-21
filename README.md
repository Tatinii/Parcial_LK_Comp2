# Parcial_LK_Comp2
Parcial de Segundo Computo

# Integrantes
-Kriscia Tatiana DelCid Argueta
-Ludwin Saúl Vásquez Romero

# Preguntas de análisis

1 • ¿Cómo manejan la conexión a la BD y qué pasa si algunos de los datos son incorrectos?
Justifiquen la manera de validación de la conexión.
R/
La conexión a la base de datos se maneja a través de la interfaz PDO (PHP Data Objects) configurada para interactuar con el motor MySQL local. Esta elección arquitectónica proporciona una capa de abstracción superior frente a funciones obsoletas y previene inyecciones SQL de manera nativa mediante el uso de consultas preparadas. Para validar la conexión de forma segura, la instancia de PDO se encapsula dentro de un bloque try-catch, configurando el modo de errores para que lance excepciones. De este modo, si los parámetros de conexión son incorrectos, la base de datos no existe o el servicio falla, la aplicación intercepta la excepción y detiene su ejecución mostrando un mensaje genérico y controlado, evitando absolutamente que las credenciales del servidor o la ruta física de los archivos queden expuestas al usuario final.

2 • ¿Cuál es la diferencia entre $_GET y $_POST en PHP? ¿Cuándo es más apropiado usar
cada uno? Da un ejemplo real de tu proyecto.
R/
La principal diferencia entre estas dos variables superglobales radica en el método de transmisión de la información hacia el servidor. La variable $_GET envía los datos anexados directamente en la URL de la petición, lo que los hace completamente visibles en la barra de direcciones del navegador, quedando registrados en el historial y limitando la cantidad de caracteres que se pueden enviar. Por su parte, $_POST encapsula la información dentro del cuerpo de la petición HTTP, permitiendo el envío seguro de grandes volúmenes de datos sin dejar rastro visible en el cliente. En el contexto de nuestro proyecto, resulta imperativo utilizar $_POST para el envío de las credenciales de autenticación en el formulario de inicio de sesión, garantizando que la contraseña del administrador viaje oculta y segura hacia el servidor, mientras que $_GET sería útil únicamente si implementáramos un buscador público de carreras.

3 • Tu app va a usarse en una empresa de la zona oriental. ¿Qué riesgos de seguridad identificas en una app web con BD que maneja datos de los usuarios? ¿Cómo los
mitigarían?
R/
Al desplegar esta aplicación web en la zona oriental, el entorno operativo presenta desafíos de infraestructura, como la alta dependencia de redes Wi-Fi públicas o conexiones móviles de baja estabilidad. El riesgo más crítico en este escenario es la intercepción de los datos personales de los aspirantes mediante ataques de intermediario (Man-in-the-Middle), donde un atacante en la misma red podría capturar el tráfico en texto plano. Adicionalmente, el sistema se expone a intentos de inyección SQL a través de los campos de entrada de la interfaz. Para mitigar estas amenazas de manera contundente, es obligatorio configurar el servidor para forzar el enrutamiento a través de un certificado SSL, encriptando toda la comunicación de red mediante el protocolo HTTPS. A nivel lógico, la vulnerabilidad de la base de datos se mitiga mediante el uso estricto de consultas preparadas con la librería PDO, las cuales sanitizan automáticamente cualquier entrada del usuario antes de ejecutar la transacción.

# diccionario de datos:

# Tabla: carreras
|     Columna   |   Tipo de dato   | Limite de caracteres | ¿Es nulo? |    Descripción |
----------------------------------------------------------------------------------------
| id | INT | N/A | No | Llave primaria autoincremental que identifica cada carrera de forma única. |
| nombre | VARCHAR | 255 | No | Nombre completo y oficial de la carrera universitaria ofertada. |
| facultad | VARCHAR | 150 | No | Clasificación de la facultad a la que pertenece la especialidad. |
| cupos | INT | N/A | No | Cantidad numérica de espacios disponibles para nuevas inscripciones. |

# Tabla: aspirantes
| Columna | Tipo de dato | Limite de caracteres | ¿Es nulo? | Descripción |
| id | INT | N/A | No | Llave primaria autoincremental para el registro individual de cada estudiante. |
| nombre_completo | VARCHAR | 255 | No | Nombre y apellidos del aspirante que solicita el ingreso. |
| departamento | VARCHAR | 100 | Sí | Departamento de procedencia del estudiante, opcional según los requerimientos. |
| modalidad | VARCHAR | 50 | No | Modalidad de estudio seleccionada, restringida a presencial o virtual. |
| carrera_id | INT | N/A | No | Llave foránea que establece la relación de pertenencia con la tabla de carreras. |

#Tabla: usuarios
| Columna | Tipo de dato | Limite de caracteres | ¿Es nulo? | Descripción |
| id | INT | N/A | No | Llave primaria autoincremental para el control de cuentas del sistema. |
| username | VARCHAR | 50 | No | Nombre de usuario administrador utilizado para la autenticación en el login. |
| password | VARCHAR | 255 | No | Cadena de texto que almacena la contraseña protegida mediante algoritmos de hash. |



