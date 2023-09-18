<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


//listAll

$app->get('/api/servis', function(Request $request,Response $response){

    $sql = "SELECT * FROM servicedb";

    try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $servicedb =  $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo Json_encode($servicedb);
    }catch(PDOException $e){
        echo '{"error" : {"text": '.$e->getMassage().'}';
    }

});

//listID

$app->get('/api/servis/{service_id}', function(Request $request,Response $response){

    $servis_id = $request->getAttribute('service_id');
    $sql = "SELECT * From servicedb where service_id = $service_id";

    try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $servicesystem =  $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo Json_encode($servicesystem);
    }catch(PDOException $e){
        echo '{"error" : {"text": '.$e->getMassage().'}';
    }

});

//service Add 

$app->get('/api/servis/add', function(Request $request,Response $response){

    $name = $request->getParam('name');
    $surname = $request->getParam('surname');
    $phone = $request->getParam('phone');
    $email = $request->getParam('email');
    $password = $request->getParam('password');
    $tc = $request->getParam('tc');
    $plate = $request->getParam('plate');
    $company = $request->getParam('company');
    $foto = $request->getParam('foto');

    $sql = "INSERT INTO servicedb(name,surname,phone,email,password,tc,plate,company,foto)
     VALUES (:name, :surname, :phone, :email, :password, :tc,:plate, :company, :foto)";

try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':name',     $name);
        $stmt->bindParam(':surname',  $surname);
        $stmt->bindParam(':phone',    $phone);
        $stmt->bindParam(':email',    $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':tc',       $tc);
        $stmt->bindParam(':plate',    $plate);
        $stmt->bindParam(':company',  $company);
        $stmt->bindParam(':foto',     $foto);

        $stmt->execute();
        
        echo '{"not": {"text": Servis Guncellendi"}';

    }catch(PDOException $e){
        echo '{"error" : {"text": '.$e->getMassage().'}';
    }

});


//service update 

$app->put('/api/servis/update/{service_id}', function(Request $request,Response $response){
   
    $service_id = $request->getParam('service_id');
    $name = $request->getParam('name');
    $surname = $request->getParam('surname');
    $phone = $request->getParam('phone');
    $email = $request->getParam('email');
    $password = $request->getParam('password');
    $tc = $request->getParam('tc');
    $plate = $request->getParam('plate');
    $company = $request->getParam('company');
    $foto = $request->getParam('foto');

    $sql = "UPDATE servicedb set
            name = :name,
            surname = :surname,
            phone = :phone,
            email = :email,
            password = :password,
            tc = :tc,
            plate = :plate,
            company = :company,
            foto = :foto

            WHERE service_id = $service_id";
    try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':name',     $name);
        $stmt->bindParam(':surname',  $surname);
        $stmt->bindParam(':phone',    $phone);
        $stmt->bindParam(':email',    $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':tc',       $tc);
        $stmt->bindParam(':plate',    $plate);
        $stmt->bindParam(':company',  $company);
        $stmt->bindParam(':foto',     $foto);

        $stmt->execute();
        
        echo '{"not": {"text": service eklendi"}';

    }catch(PDOException $e){
        echo '{"error" : {"text": '.$e->getMassage().'}';
    }

});

//servis arac silme

$app->delete('/api/servis/delete/{service_id}', function(Request $request,Response $response){

    $service_id = $request->getAttribute('service_id');
    $sql = "DELETE FROM servicedb where service_id = $service_id";

    try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '{"not": {"text": service silindi"}';

    }catch(PDOException $e){
        echo '{"error" : {"text": '.$e->getMassage().'}';
    }

});