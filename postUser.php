<?php
// Permitimos acceso externo al PHP
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    require_once('access.php');
    // Importamos la conexión PDO
    require_once('conexion.php');
    // Recibimos un json desde el frontEnd por medio de un fech
    $jsonData = file_get_contents('php://input');
    $user = json_decode($jsonData);
    //print_r($user);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['msg' => 'Error en el JSON recibido', 'error' => json_last_error_msg()]);
        exit;
    }

    $name = $user->name;
    $email = $user->email;
    $password = md5( $user->password );

    $sql = "INSERT INTO users( name, email, password)
            VALUES(:name, :email, :password)";

    $stm =$pdo->prepare($sql);
    $stm->bindParam(':name', $name );
    $stm->bindParam(':email', $email );
    $stm->bindParam(':password', $password );

    if( $stm->execute()) {
        echo( json_encode( ['msg' => 'Ok']   ));
    } else {
        echo( json_encode( ['msg' => 'Error']   ));
    }

    

?>