<?php


function isExistId($id) {
    $pdo = pdoSqlConnect();
    $query = "SELECT EXISTS(SELECT * FROM User WHERE id= ?) AS exist;";
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
    $query = "SELECT EXISTS(SELECT * FROM User WHERE id= ? AND pw = ?) AS exist;";
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
    $query = "select num as authNum from Auth 
              where phone=? and createAt > date_sub(now(), interval 3 minute)
              order by createAt desc limit 1;";
    $st = $pdo->prepare($query);
    $st->execute([$phone]);
    $st->setFetchMode(PDO::FETCH_ASSOC);
    $res = $st->fetchAll();
    $st = null;
    $pdo = null;
    if(count($res) == 0) return FALSE;
    return $res[0]['authNum'] == $authNum ? TRUE : FALSE;
}


function isValidMovieID($movieID) {
    $pdo = pdoSqlConnect();
    $query = "SELECT EXISTS(SELECT * FROM Movie WHERE movieID = ?) AS exist;";
    $st = $pdo->prepare($query);
    $st->execute([$movieID]);
    $st->setFetchMode(PDO::FETCH_ASSOC);
    $res = $st->fetchAll();
    $st = null;
    $pdo = null;
    return intval($res[0]["exist"]);
}


function isValidTheaterID($theaterID) {
    $pdo = pdoSqlConnect();
    $query = "SELECT EXISTS(SELECT * FROM Theater WHERE theaterID = ?) AS exist;";
    $st = $pdo->prepare($query);
    $st->execute([$theaterID]);
    $st->setFetchMode(PDO::FETCH_ASSOC);
    $res = $st->fetchAll();
    $st = null;
    $pdo = null;
    return intval($res[0]["exist"]);
}