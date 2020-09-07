<?php


function saveAuthNum($phone, $authNum) {
    $pdo = pdoSqlConnect();
    $query = "INSERT INTO Auth
              (authID, phone, num, isCertified)
              VALUES
              (CONCAT(\"008\", DATE_FORMAT(NOW(), \"%Y%m%d%H%i%s\"), FLOOR(1000+RAND()*8999)), ?, ?, 1);";
    $st = $pdo->prepare($query);
    $st->execute([$phone, $authNum]);
    $st = null;
    $pdo = null;



    return "success";
}