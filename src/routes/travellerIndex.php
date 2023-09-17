<?php

ob_start();
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$db = new db();
$db = $db->connect();


if(isset($_POST['travellerIndex'])){
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $kullanicisor=$db->prepare("SELECT * FROM traveller WHERE code=:code and phone=:phone and password=:password");
    $kullanicisor->execute(array(
        'phone' => $phone,
        'password' => $password
    ));
    $say = $kullanicisor->rowCount();

    if($say==1){
        $_SESSION['phone'] = $phone;
        header("Location:http://localhost:4400/travellerHome.html");
        exit;
    }
    else{
        header("Location:http://localhost:4400/travellerindex.html");
        exit;
    }
}