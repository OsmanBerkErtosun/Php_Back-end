
<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


//listAll


$app->get('/api/traveller', function(Request $request,Response $response){

    $sql = "SELECT * From traveller";

    try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $traveller =  $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo Json_encode($traveller);
    }catch(PDOException $e){
        echo '{"error" : {"text": '.$e->getMassage().'}';
    }

});

//listID

$app->get('/api/traveller/{student_id}', function(Request $request,Response $response){

    $student_id  = $request->getAttribute('student_id ');
    $sql = "SELECT * From traveller WHERE student_id  = $student_id ";

    try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $traveller =  $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo Json_encode($traveller);
    }catch(PDOException $e){
        echo '{"error" : {"text": '.$e->getMassage().'}';
    }

});

//service Add 

$app->get('/api/traveller/add', function(Request $request,Response $response){

    $name = $request->getParam('name');
    $surname = $request->getParam('surname');
    $phone = $request->getParam('phone');
    $companyName = $request->getParam('companyName');
    $password = $request->getParam('password');
    $tc = $request->getParam('tc');
    $service_id = $request->getParam('service_id');
    $plate = $request->getParam('plate');

    $sql = "INSERT INTO traveller(name,surname,phone,companyName,password,tc,service_id,plate)
     VALUES (:name, :surname, :phone, :companyName, :password, :tc, :service_id, :plate)";

try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':name',     $name);
        $stmt->bindParam(':surname',  $surname);
        $stmt->bindParam(':phone',    $phone);
        $stmt->bindParam(':companyName',    $companyName);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':tc',       $tc);
        $stmt->bindParam(':service_id',    $service_id);
        $stmt->bindParam(':plate',  $plate);

        $stmt->execute();
        
        echo '{"not": {"text": Servis Guncellendi"}';

    }catch(PDOException $e){
        echo '{"error" : {"text": '.$e->getMassage().'}';
    }

});


//service update 

$app->put('/api/traveller/update/{student_id}', function(Request $request,Response $response){
   
    $student_id  = $request->getParam('student_id ');
    $name = $request->getParam('name');
    $surname = $request->getParam('surname');
    $phone = $request->getParam('phone');
    $companyName = $request->getParam('companyName');
    $password = $request->getParam('password');
    $tc = $request->getParam('tc');
    $service_id = $request->getParam('service_id');
    $plate = $request->getParam('plate');

    $sql = "UPDATE traveller set
            name = :name,
            surname = :surname,
            phone = :phone,
            companyName = :companyName,
            password = :password,
            tc = :tc,
            service_id = :service_id,
            plate = :plate,

            WHERE student_id  = $student_id ";
    try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);

       
        $stmt->bindParam(':name',     $name);
        $stmt->bindParam(':surname',  $surname);
        $stmt->bindParam(':phone',    $phone);
        $stmt->bindParam(':companyName',    $companyName);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':tc',       $tc);
        $stmt->bindParam(':service_id',    $service_id);
        $stmt->bindParam(':plate',  $plate);

        $stmt->execute();
        
        echo '{"not": {"text": service eklendi"}';

    }catch(PDOException $e){
        echo '{"error" : {"text": '.$e->getMassage().'}';
    }

});

//servis arac silme

$app->delete('/api/traveller/delete/{student_id}', function(Request $request,Response $response){

    $student_id  = $request->getAttribute('student_id');
    $sql = "DELETE FROM traveller where student_id  = $student_id ";

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
