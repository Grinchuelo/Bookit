<?php
function validateUsername($username) {
    return preg_match('/^[a-zA-Z0-9]$/', $username) ? true : false;
}

/* function validatePassword($password) {
    return preg_match();
} */
?>