<?php


function userJoin($id, $pw, $name, $phone, $email, $gender, $age) {
    $pdo = pdoSqlConnect();
    $query = "INSERT INTO User
              (userID, id, pw, name, phone, email, gender, age)
              VALUES
              (CONCAT(\"000\", DATE_FORMAT(NOW(), \"%Y%m%d%H%i%s\"), FLOOR(1000+RAND()*8999)), ?, ?, ?, ?, ?, ?, ?);";
    $st = $pdo->prepare($query);
    $st->execute([$id, $pw, $name, $phone, $email, $gender, $age]);
    $st = null;
    $pdo = null;
    return "success";
}