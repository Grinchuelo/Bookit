<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require ('../vendor/autoload.php');

function sendVerificationEmail($userEmail, $username, $token) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor
        $mail->isSMTP();
        $mail->CharSet    = 'UTF-8';
        $mail->Host       = 'PROTECTEDbyBFG';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'PROTECTEDbyBFG';
        $mail->Password   = 'PROTECTEDbyBFG';
        $mail->SMTPSecure = 'ssl'; 
        $mail->Port       = 465;

        // De: 
        $mail->setFrom('PROTECTEDbyBFG', 'Bookit');
        // Para:
        $mail->addAddress($userEmail, $username);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Confirmá tu cuenta en Bookit';
        // https://bookit.grinchuelo.online/scripts/verify.php?token=$token
        $mail->Body = "
            <h2>¡Hola, $username!</h2>
            <p>Gracias por registrarte en <strong>Bookit</strong>.</p>
            <p>Para empezar a usar tu cuenta, hacé clic en el siguiente enlace:</p>
            <p><a href='localhost/bookit/verify.php?token=$token'>Verificar mi cuenta</a></p>
            <small>Si no fuiste vos, ignorá este mensaje.</small>
        ";
        /*📨 ¿No fuiste vos? No te preocupes.

Parece que alguien usó esta dirección de correo para registrarse en Bookit.
Si vos no iniciaste este registro, podés simplemente ignorar este mensaje.
Tu dirección no será asociada a ninguna cuenta y no tomaremos ninguna acción sin tu confirmación.

Gracias por tu paciencia,
El equipo de Bookit 📚 */

        $mail->send();
        return true;
    } catch(Exception $e) {
        error_log("Error al enviar correo: {$mail->ErrorInfo}");
        return false;
    }
}
?>