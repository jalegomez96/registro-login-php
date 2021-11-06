<?php
include_once('connection.php');
function login($email, $pw)
{
    $conn = connectDb();
    if (!$conn) {
        $res['ok'] = false;
        $res['error'] = 'Servicio no disponible';
        return $res;
    }
    $pwmd5 = md5($pw);
    $stmt = $conn->prepare("SELECT nombres, apellidos FROM usuario WHERE email=? AND pw=?");
    $stmt->bind_param("ss", $email, $pwmd5);
    $stmt->execute();
    $results = $stmt->get_result();
    $stmt->close();
    disconnectDb($conn);
    if ($results->num_rows > 0) {
        $res['ok'] = true;
        $res['data'] = $results->fetch_assoc();
        return $res;
    }
    $res['ok'] = false;
    $res['error'] = 'Usuario o contraseña inválidos';
    return $res;
}

function register($nombres, $apellidos, $email, $pw, $pw2)
{
    if ($pw !=  $pw2) {
        $res['ok'] = false;
        $res['error'] = 'Las contraseñas no coinciden';
        return $res;
    }

    $conn = connectDb();
    if (!$conn) {
        $res['ok'] = false;
        $res['error'] = 'Servicio no disponible';
        return $res;
    }
    $stmt = $conn->prepare("SELECT email FROM usuario WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $results = $stmt->get_result();
    $stmt->close();
    if ($results->num_rows > 0) {
        $dbuser = $results->fetch_assoc();
        if ($dbuser) {
            disconnectDb($conn);
            $res['ok'] = false;
            $res['error'] = 'El email ya está siendo utilizado';
            return $res;
        }
    }

    $pwmd5 = md5($pw);
    $stmt = $conn->prepare("INSERT INTO usuario (nombres, apellidos, email, pw ) 
    VALUES(?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombres, $apellidos, $email, $pwmd5);
    $stmt->execute();
    $stmt->close();
    disconnectDb($conn);

    $user['nombres'] = $nombres;
    $user['apellidos'] = $apellidos;
    $res['ok'] = true;
    $res['data'] = $user;
    return $res;
}
