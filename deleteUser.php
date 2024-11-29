<?php
header('Access-Control-Allow-Origin: *');
    require_once('access.php');
    require_once('conexion.php');

    $jsonData = file_get_contents('php://input');
    $user = json_decode( $jsonData);

    $id_user = $user->id_user;


    $sql = "DELETE FROM users
            WHERE id_user = :id_user";

    $stm =$pdo->prepare($sql);
    $stm->bindParam(':id_user', $id_user );

    if( $stm->execute()) {
        echo( json_encode( ['msg' => 'Ok']   ));
    } else {
        echo( json_encode( ['msg' => 'Error']   ));
    }

?>