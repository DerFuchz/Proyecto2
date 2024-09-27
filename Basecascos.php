<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdusocasco";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validar y limpiar entradas
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $edad = mysqli_real_escape_string($conn, $_POST['edad']);
    $experiencia = mysqli_real_escape_string($conn, $_POST['experiencia']);
    $uso_casco_frecuencia = mysqli_real_escape_string($conn, $_POST['uso-casco-frecuencia']);
    $razon_uso = mysqli_real_escape_string($conn, $_POST['razon-uso']);
    $efectividad = mysqli_real_escape_string($conn, $_POST['efectividad']);
    $multas = mysqli_real_escape_string($conn, $_POST['multas']);

    // Manejo de checkbox como un array (factores)
    $factores = isset($_POST['factores']) ? implode(", ", $_POST['factores']) : '';

    // Campos adicionales
    $experiencia_texto = mysqli_real_escape_string($conn, $_POST['experiencia']);
    $mejoras = mysqli_real_escape_string($conn, $_POST['mejoras']);

    // Query de inserción
    $sql = "INSERT INTO registro (nombre, email, edad, experiencia, uso_casco_frecuencia, razon_uso, efectividad, multas, factores, experiencia_texto, mejoras)
            VALUES ('$nombre', '$email', '$edad', '$experiencia', '$uso_casco_frecuencia', '$razon_uso', '$efectividad', '$multas', '$factores', '$experiencia_texto', '$mejoras')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Encuesta enviada correctamente.</p>";
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

// Consulta de resultados
$sql = "SELECT edad, experiencia, uso_casco_frecuencia, razon_uso, efectividad, multas, factores, experiencia_texto, mejoras FROM registro";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Edad</th>
                <th>Experiencia</th>
                <th>Uso del Casco</th>
                <th>Razón de Uso</th>
                <th>Efectividad</th>
                <th>Multas</th>
                <th>Factores</th>
                <th>Experiencia</th>
                <th>Mejoras</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["edad"] . "</td>
                <td>" . $row["experiencia"] . "</td>
                <td>" . $row["uso_casco_frecuencia"] . "</td>
                <td>" . $row["razon_uso"] . "</td>
                <td>" . $row["efectividad"] . "</td>
                <td>" . $row["multas"] . "</td>
                <td>" . $row["factores"] . "</td>
                <td>" . $row["experiencia_texto"] . "</td>
                <td>" . $row["mejoras"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No hay resultados almacenados.</p>";
}

$conn->close();
?>
