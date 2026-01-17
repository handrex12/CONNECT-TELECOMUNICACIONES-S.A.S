<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 1. Limpiar datos del formulario
    $nombre   = htmlspecialchars(trim($_POST['nombre']));
    $email    = htmlspecialchars(trim($_POST['email']));
    $telefono = htmlspecialchars(trim($_POST['telefono']));
    $servicio = htmlspecialchars(trim($_POST['servicio']));
    $mensaje  = htmlspecialchars(trim($_POST['mensaje']));

    // 2. Correos destino (separados por coma)
    $destino = "ventas@connectsas.com.co, soportetecnico@connectsas.com.co, telecomunicaciones@connectsas.com.co";

    // 3. Asunto del correo
    $asunto = "📩 Nuevo contacto desde la página web - Connect SAS";

    // 4. Contenido del mensaje
    $contenido = "
Nuevo mensaje recibido desde el sitio web:

Nombre: $nombre
Correo: $email
Teléfono: $telefono
Servicio de interés: $servicio

Mensaje:
$mensaje
";

    // 5. Cabeceras (MUY IMPORTANTE que el FROM sea del dominio)
    $headers  = "From: Connect SAS <ventas@connectsas.com.co>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // 6. Enviar correo
    if (mail($destino, $asunto, $contenido, $headers)) {
        header("Location: gracias.html");
        exit;
    } else {
        echo "❌ Error al enviar el mensaje. Intenta nuevamente.";
    }
}
?>