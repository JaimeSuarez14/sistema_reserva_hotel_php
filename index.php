<?php
require_once 'config/config.php';

// Capturar la ruta actual
$currentPageUrl = trim($_SERVER['REQUEST_URI'], '/');

// Si hay query string, eliminarla
$currentPageUrl = explode('?', $currentPageUrl)[0];

// Si está vacío, usar ruta por defecto
$ruta = empty($currentPageUrl) ? 'home/principal/index' : $currentPageUrl;
$array = explode('/', $ruta);
$isAdmin = isset($array[1]) && $array[1] === ADMIN;

// /reservas/admin/blog/crear/parametro1/parametro2
// /reservas/blog/ver/parametro

// Caso especial: /admin
if ($isAdmin) {

  $controlador = ucfirst($array[2] ?? 'Admin');
  $metodo      = $array[3] ?? 'index';
  $parametros  = array_slice($array, 4);
} else {

  $controlador = ucfirst($array[1] ?? 'Principal');
  $metodo      = $array[2] ?? 'index';
  $parametros  = array_slice($array, 3);
}

echo "controller : " . $controlador . "<br>";
echo "metodo : " . $metodo;
echo  "<br>";

//validar metodos
$parametro = '';
$parametroIndice = ($isAdmin) ? 4 : 3;
if (!empty($array[$parametroIndice]) && $array[$parametroIndice] != '') {
  for ($i = $parametroIndice; $i < count($array); $i++) {
    $parametro .= $array[$i] . ",";
  }
  $parametro = trim($parametro, ",");
  echo $parametro;
}

//LLAMA AUTOLOAD
require_once 'config/app/Autoload.php';

$dirController = ($isAdmin) ? 'controllers/admin/' . $controlador . ".php" : 'controllers/principal/' . $controlador . ".php";
if (file_exists($dirController)) {

  require_once $dirController;
  $controller = new $controlador();
  if(method_exists($controlador, $metodo)){
    $controller->$metodo($parametro);
  }else{
    echo "No existe el metodo";
  }
}else{
  echo "No existe el controlador";
}
