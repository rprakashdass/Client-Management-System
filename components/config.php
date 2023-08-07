<?php
    $db_name = 'mysql:host=localhost;dbname=client_db';
    $user_name = 'root';
    $user_password = '';



try{
    $conn = new PDO($db_name,$user_name,$user_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo 'connection failed due to :'. $e->getmessage();
}

?>