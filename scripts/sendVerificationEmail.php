<?php
include('../config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('../vendor/autoload.php');

function sendVerificationEmail($userEmail, $username, $token) {
    $local = ($_SERVER['SERVER_NAME'] == 'localhost');
    if ($local) {
        $url = 'localhost/bookit/verify.php';
    } else {
        $url = 'bookit.grinchuelo.online/verify.php';
    }

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
        $mail->Subject = 'Hola, ' . $username . '. Confirmá tu cuenta en Bookit';
        // https://bookit.grinchuelo.online/scripts/verify.php?token=$token
        $mail->Body = '
<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f5f5f5" style="padding: 20px 0;">
    <tr>
        <td align="center">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width: 600px; background: #ffffff; border-radius: 8px; font-family: Arial, sans-serif; overflow: hidden;">
                <!-- Header -->
                <tr>
                    <td bgcolor="#3783f5" align="center" style="padding: 20px;">
                        <img src="https://bookit-assets.s3.us-east-2.amazonaws.com/icons/bookitFullLightIcon.png" alt="Bookit" style="max-width: 200px;">
                    </td>
                </tr>

                <!-- Body -->
                <tr>
                    <td style="padding: 30px; color: #333;">
                        <h2 style="margin-top: 0;">¡Confirmá tu cuenta!</h2>
                        <p style="font-size: 16px; line-height: 1.5;">
                            Gracias por registrarte en <strong>Bookit</strong>. Solo falta un paso para empezar a explorar nuestro mundo de libros 📙📘📗
                        </p>
                        <p style="font-size: 16px;">
                            Hacé clic en el botón de abajo para verificar tu cuenta:
                        </p>

                        <!-- Botón -->
                        <table cellpadding="0" cellspacing="0" style="margin: 20px 0;">
                            <tr>
                                <td align="center" bgcolor="#3783f5" style="border-radius: 5px;">
                                    <a href=' . $url . '?token=' . $token . '"
                                        target="_blank"
                                        style="display: inline-block; padding: 12px 24px; color: #ffffff; text-decoration: none; font-weight: bold;">
                                        Verificar cuenta
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <p style="font-size: 14px; color: #666;">
                            Si vos no creaste esta cuenta, podés ignorar este correo con total tranquilidad.
                        </p>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td bgcolor="#f0f0f0" align="center" style="padding: 20px; font-size: 12px; color: #999;">
                        © 2025 Bookit. Todos los derechos reservados.<br>
                        <a href="https://bookit.grinchuelo.online" target="_blank" style="color: #4A90E2; text-decoration: none;">Visitar sitio</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
';
        /*📨 ¿No fuiste vos? No te preocupes.

Parece que alguien usó esta dirección de correo para registrarse en Bookit.
Si vos no iniciaste este registro, podés simplemente ignorar este mensaje.
Tu dirección no será asociada a ninguna cuenta y no tomaremos ninguna acción sin tu confirmación.

Gracias por tu paciencia,
El equipo de Bookit 📚 */

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Error al enviar correo: {$mail->ErrorInfo}");
        return false;
    }
}
