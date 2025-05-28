<?php
session_set_cookie_params([
    "lifetime" => 60 * 60 * 4, 
    "path" => "/",             
    "domain" => 'localhostt', 
    "secure" => true,          
    "httponly" => true,
    "samesite" => "Strict"
]);
?>