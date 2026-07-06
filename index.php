<?php
require_once 'config/config.php';

// Capturar la ruta actual
$currentPageUrl = trim($_SERVER['REQUEST_URI'], '/');

// Si hay query string, eliminarla
$currentPageUrl = explode('?', $currentPageUrl)[0];

// Si está vacío, usar ruta por defecto
$ruta = empty($currentPageUrl) ? 'principal/index' : $currentPageUrl;
$array = explode('/', $ruta);

// Caso especial: /admin
if ($array[0] === ADMIN) {
    $controlador = "Admin";
    $metodo = isset($array[1]) ? $array[1] : "login";
} else {
    $controlador = ucfirst($array[0]);
    $metodo = isset($array[1]) ? $array[1] : "index";
}

echo "controller : " . $controlador . "<br>";
echo "metodo : " . $metodo;
