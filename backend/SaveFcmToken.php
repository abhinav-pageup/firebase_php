<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo 0;
    return;
}

if (!isset($_POST['fcm_token']) && !isset($_POST['project_master_id'])) {
    echo 0;
    return;
}

require './database/Connection.php';

try {
    $database = new Connection();
    $db = $database->openConnection();
    $stm = $db->prepare("INSERT INTO fcmtoken_masters (project_master_id, fcm_token) VALUES (:project_master_id, :fcm_token)");
    $exec = $stm->execute([
        'project_master_id' => $_POST['project_master_id'],
        'fcm_token' => $_POST['fcm_token']
    ]);
    
    if ($exec) {
        echo 1;
        return;
    } else {
        echo 0;
        return;
    }
} catch (Exception $th) {
    echo 0;
    return;
}