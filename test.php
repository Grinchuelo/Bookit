<?php
function validateEmail($email)
{
    $formatEmail = '/^[a-zA-Z0-9._-]+\@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/';
    return preg_match($formatEmail, $email);
}

function validateUsername($username)
{
    $formatUsername = '/^([a-zA-Z0-9_ ]){3,}$/';
    return preg_match($formatUsername, $username);
}

function validatePassword($password)
{
    $formatPassword = '/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[!"#$%&\'()*+,\-.\/\\:;<>=?@\[\]^_`{|}~ ]).{8,}$/';
    return preg_match($formatPassword, $password);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing</title>
    <style>
        span {
            font-size: 50px;
            color: #fbfcb9;
            -webkit-text-stroke-width: 1px;
            -webkit-text-stroke-color: black;
        }

        span span {
            color: #b9d9fc;
        }
    </style>
</head>

<body>
    <span>SatChit<span>Ananda</span></span>

    <?php
    date_default_timezone_set('America/Argentina/Cordoba');
    $hoy = date("Y-m-d");

    echo $hoy;

    include('./config.php');
    include('./scripts/generateListID.php');

    $stmt = $conection->prepare("SELECT * FROM listas ORDER BY id_lista DESC LIMIT 1");
    $stmt->execute();
    $lastList = $stmt->fetch(PDO::FETCH_ASSOC);
    $lastListID = $lastList['id_lista'];

    echo $lastListID;

    echo generarSiguienteID($lastListID);
    ?>
</body>

</html>