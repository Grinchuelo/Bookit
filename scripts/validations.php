<?php
    function validateEmail($email) {
        $formatEmail = '/^[a-zA-Z0-9._-]+\@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/';
        return preg_match($formatEmail, $email);
    }

    function validateUsername($username) {
        $formatUsername = '/^([a-zA-Z0-9_ ]){3,}$/'; 
        return preg_match($formatUsername, $username);
    }

    function validatePassword($password) {
        $formatPassword = '/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[!"#$%&\'()*+,\-.\/\\:;<>=?@\[\]^_`{|}~ ]).{8,}$/';
        return preg_match($formatPassword, $password);
    }
?>