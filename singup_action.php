<?php
error_reporting(E_ALL);
ini_set("display_errors", "On");

require "config.php";
require "models/Auth.php";

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');
$birthdate = filter_input(INPUT_POST, 'birthdate');

if($name && $email && $password && $birthdate) {
$auth = new Auth($pdo, $base);


    //aki verifica se a data é valida
    $birthdate = explode('/', $birthdate);

    if(count($birthdate) != 3){
        $_SESSION['flash'] = 'Data de nascimento inválida.';
        header("Location: ".$base."/singup.php");
        exit;
    }

    $birthdate = $birthdate[2].'-'.$birthdate[1].'-'.$birthdate[0];
    if(strtotime($birthdate) === false){
        $_SESSION['flash'] = 'Data de nascimento inválida.';
        header("Location: ".$base."/singup.php");
        exit;
    }

    //aki verifica o email
    if($auth->emailExists($email) === false) {

        $auth->registerUser($name, $email, $password, $birthdate);
        header("Location: ".$base);
        exit;

    } else{
        $_SESSION['flash'] = 'E-mail já cadastrado!';
        header("Location: ".$base."/singup.php");
        exit;
    }

    
}

$_SESSION['flash'] = 'Campos não enviados.';
header("Location: ".$base."/login.php");
exit;
?>