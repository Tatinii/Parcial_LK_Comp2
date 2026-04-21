<?php
// index.php
session_start();
require 'db.php';

$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;

// Procesar formulario si está logueado
if ($is_logged_in && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre_completo']);
    $carrera_id = $_POST['carrera_id'];
    $modalidad = $_POST['modalidad'] ?? '';


    // Validar si mandó departamento o dejar nulo
    $departamento = !empty(trim($_POST['departamento'])) ? trim($_POST['departamento']) : null;

    if (!empty($nombre) && !empty($carrera_id) && !empty($modalidad)) {
        $stmt = $pdo->prepare("INSERT INTO aspirantes (nombre_completo, departamento, modalidad, carrera_id) VALUES (:nombre, :depto, :mod, :cid)");
        $stmt->execute([
            'nombre' => $nombre,
            'depto' => $departamento,
            'mod' => $modalidad,
            'cid' => $carrera_id
        ]);
        $success = "Aspirante registrado correctamente.";
    } else {
        $error = "Por favor, complete los campos obligatorios.";
    }
}

// Obtener datos para la tabla
$query = $pdo->query("SELECT a.nombre_completo, a.departamento, a.modalidad, c.nombre AS carrera 
                      FROM aspirantes a 
                      JOIN carreras c ON a.carrera_id = c.id 
                      ORDER BY a.nombre_completo ASC");
$aspirantes = $query->fetchAll(PDO::FETCH_ASSOC);

// Obtener carreras para el select
$carreras = $pdo->query("SELECT id, nombre FROM carreras")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inscripción UGB</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>Sistema de Inscripción - Universidad Gerardo Barrios</h1>
        <?php if ($is_logged_in): ?>
            <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?> | <a href="logout.php">Cerrar Sesión</a></p>
        <?php else: ?>
            <p>Modo Lectura | <a href="login.php">Iniciar Sesión para Administrar</a></p>
        <?php endif; ?>
    </div>

    <div class="container">
        <?php if ($is_logged_in): ?>
            <div class="form-section">
                <h2>Registrar Nuevo Aspirante</h2>
                <?php if(isset($success)) echo "<p class='success'>$success</p>"; ?>
                <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
                
                <form method="POST" action="">
                    <label>Nombre Completo (Obligatorio):</label>
                    <input type="text" name="nombre_completo" required>

                    <label>Departamento (Opcional - Prueba de Nulo):</label>
                    <input type="text" name="departamento" placeholder="Ej. San Miguel">

                    <label>Carrera:</label>
                    <select name="carrera_id" required>
                        <option value="">Seleccione una carrera...</option>
                        <?php foreach ($carreras as $c): ?>
                            <option value="<?php echo $c['id']; ?>"><?php echo htmlspecialchars($c['nombre']); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label>Modalidad:</label>
                    <div class="radio-group">
                        <input type="radio" name="modalidad" value="Presencial" required> Presencial
                        <input type="radio" name="modalidad" value="Virtual" required> Virtual
                    </div>

                    <button type="submit">Registrar</button>
                </form>
            </div>
        <?php endif; ?>

        <div class="table-section">
            <h2>Lista de Aspirantes Registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre Completo</th>
                        <th>Departamento</th>
                        <th>Modalidad</th>
                        <th>Carrera</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($aspirantes) > 0): ?>
                        <?php foreach ($aspirantes as $asp): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($asp['nombre_completo']); ?></td>
                                <td><?php echo htmlspecialchars($asp['departamento'] ?? 'No especificado (Nulo)'); ?></td>
                                <td><?php echo htmlspecialchars($asp['modalidad']); ?></td>
                                <td><?php echo htmlspecialchars($asp['carrera']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4">No hay registros disponibles.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>