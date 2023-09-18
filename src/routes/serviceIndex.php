<?php

ob_start();
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$db = new db();
$db = $db->connect();


if(isset($_POST['serviceIndex'])){
    $code = $_POST['code'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $kullanicisor=$db->prepare("SELECT * FROM servicesystem WHERE code=:code and phone=:phone and password=:password");
    $kullanicisor->execute(array(
        'service_id' => $code,
        'phone' => $phone,
        'password' => $password
    ));
    $say = $kullanicisor->rowCount();

    if($say==1){
        $_SESSION['phone'] = $phone;
        $_SESSION['service_id'] = $service_id;
        header("Location:http://localhost:4400/service.html");
        exit;
    }
    else{
        header("Location:http://localhost:4400/index.html");
        exit;
    }
}