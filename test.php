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
<html lang="en">

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

    <form action="" method="POST">
        <label for="user">Username</label>
        <input type="text" name="username" id="user">

        <button type="submit">Enviar</button>
    </form>

    <?php
        $password = 'hH8_hhhsh';
        if (password_verify($password, '$2y$11$hVJC3uf9TUeI8wvx0PBZcunjRMyESaO3nVEzIINwk53vCD6G4yRYa')) {
            echo "es valida";
        } else {
            echo "no";
        }

        
    ?>

    <script>
        document.querySelector('form').addEventListener('submit', async function (e) {
            e.preventDefault();
            
            const form = e.target;
            const formData = new FormData(form);
            
            let result;
            let token = "123";
            await fetch(('./scripts/test2.php?', token), {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                result = data;
            })
            .catch(error => {
                console.error('Error: ', error);
            })
        })
    </script>
</body>

</html>