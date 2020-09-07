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


function isValidScheduleID($scheduleID) {
    $pdo = pdoSqlConnect();
    $query = "SELECT EXISTS(SELECT * FROM Schedule WHERE scheduleID = ?) AS exist;";
    $st = $pdo->prepare($query);
    $st->execute([$scheduleID]);
    $st->setFetchMode(PDO::FETCH_ASSOC);
    $res = $st->fetchAll();
    $st = null;
    $pdo = null;
    return intval($res[0]["exist"]);
}


function isValidSeatID($seatID) {
    $pdo = pdoSqlConnect();
    $query = "SELECT EXISTS(SELECT * FROM Seat WHERE seatID = ?) AS exist;";
    $st = $pdo->prepare($query);
    $st->execute([$seatID]);
    $st->setFetchMode(PDO::FETCH_ASSOC);
    $res = $st->fetchAll();
    $st = null;
    $pdo = null;
    return intval($res[0]["exist"]);
}


function isReservedSeat($scheduleID, $seats) {
    $pdo = pdoSqlConnect();
    $query = "SELECT EXISTS(SELECT * FROM Reservation WHERE scheduleID = ? and seatID in (";
    $seatCnt = count($seats);
    for($i=0; $i<$seatCnt; $i++) {
        $query = $query."\"".$seats[$i]->seatID."\"";
        if($i != $seatCnt-1) $query = $query.", ";
        else $query = $query.")";
    }
    $query = $query.") AS exist;";

    $st = $pdo->prepare($query);
    $st->execute([$scheduleID]);
    $st->setFetchMode(PDO::FETCH_ASSOC);
    $res = $st->fetchAll();
    $st = null;
    $pdo = null;
    return intval($res[0]["exist"]);
}


function isCertifiedPhone($phone, $authNum) {
    $pdo = pdoSqlConnect();
    $query = "SELECT EXISTS(SELECT * FROM Auth WHERE phone = ? and num = ? and isCertified = 1 order by createAt desc limit 1) AS exist;";
    $st = $pdo->prepare($query);
    $st->execute([$phone, $authNum]);
    $st->setFetchMode(PDO::FETCH_ASSOC);
    $res = $st->fetchAll();
    $st = null;
    $pdo = null;
    return intval($res[0]["exist"]);
}

