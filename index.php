<?php

header('Content-TYPE: application');
function pdo_connect_mysql()
{
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'igor';
    $DATABASE_PASS = 'Password3';
    $DATABASE_NAME = 'test';
    try {
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
        exit('Failed to connect to database!');
    }
}

if(empty($_GET['api_key']))
{
    echo 'error';
}
else
{
    $pdo = pdo_connect_mysql();
    $query = $pdo->query("SELECT * FROM users WHERE api_key='".$_GET['api_key']."'");
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if($result)
    {
        $result = [
            'id' => $result['id'],
            'login' => $result['login'],
            'email' => $result['email'],
            'phone' => $result['phone']
        ];
        echo json_encode($result);
    }
    else
    {
        echo 'error';
    }
}

