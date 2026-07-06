<?php
require_once 'config/config.php';
//Capturar la ruta actual
$currentPageUrl = $_SERVER['REQUEST_URI'];
//echo $currentPageUrl;
//Verificar si existe la ruta admin
$isAdmin = strpos($currentPageUrl, "/" . ADMIN) !== false;
//verificar la ruta principal
$ruta = empty($_GET['url']) ? 'principal/index' : $_GET['url'];
//crear un array a partir de la ruta
$array = explode('/', $ruta);

//validar si nos encontramos en la ruta admin
if (
  $isAdmin && (count($array) == 1 || (count($array) === 2 && empty($array[2]))) &&
  $array[1] == ADMIN
) {
  $controlador = "admin";
  $metodo = "login";
} else {
  $indiceUrl = ($isAdmin) ? 1 : 0;
  $controlador = ucfirst($array[$indiceUrl]);
  $metodo = "index";
  }

  echo "controller : ".$controlador."<br>";
  echo "metodo : ".$metodo; 
