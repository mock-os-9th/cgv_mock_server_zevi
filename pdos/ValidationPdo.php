<?php


function isExistId($id) {
    $pdo = pdoSqlConnect();
    $query = "SELECT EXISTS(SELECT * FROM user WHERE id= ?) AS exist;";
    $st = $pdo->prepare($query);
    $st->execute([$id]);
    $st->setFetchMode(PDO::FETCH_ASSOC);
    $res = $st->fetchAll();
    $st = null;
    $pdo = null;
    return intval($res[0]["exist"]);
}


function isValidUser($id, $pw) {
    $pdo = pdoSqlConnect();
    $query = "SELECT EXISTS(SELECT * FROM user WHERE id= ? AND pw = ?) AS exist;";
    $st = $pdo->prepare($query);
    $st->execute([$id, $pw]);
    $st->setFetchMode(PDO::FETCH_ASSOC);
    $res = $st->fetchAll();
    $st = null;
    $pdo = null;
    return intval($res[0]["exist"]);
}


function isValidAuthNum($phone, $authNum) {
    $pdo = pdoSqlConnect();
    $query = "select num as authNum from auth where phone=? order by createAt desc limit 1;";
    $st = $pdo->prepare($query);
    $st->execute([$phone]);
    $st->setFetchMode(PDO::FETCH_ASSOC);
    $res = $st->fetchAll();
    $st = null;
    $pdo = null;
    return $res[0]['authNum'] == $authNum ? 1 : 0;
}


function isValidTitle($title) {
    $pdo = pdoSqlConnect();
    $query = "SELECT EXISTS(SELECT * FROM movie WHERE titleKo like ?) AS exist;";
    $st = $pdo->prepare($query);
    $st->execute([$title]);
    $st->setFetchMode(PDO::FETCH_ASSOC);
    $res = $st->fetchAll();
    $st = null;
    $pdo = null;
    return intval($res[0]["exist"]);
}