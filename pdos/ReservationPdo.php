<?php


function reserve($id, $pw, $scheduleID, $seatID, $priceType, $price, $method) {
    $pdo = pdoSqlConnect();
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
    //userID 찾기
    $query = "SELECT userID FROM User WHERE id= ? AND pw = ?;";
    $st = $pdo->prepare($query);
    $st->execute([$id, $pw]);
    $st->setFetchMode(PDO::FETCH_ASSOC);
    $res = $st->fetchAll();

    //reservation 업데이트
    $userID = $res[0]['userID'];
    $paymentCompleteState = 100;
    $query = "INSERT INTO Reservation
              (reservationID, userID, scheduleID, seatID, priceType, price, method, state)
              VALUES
              (CONCAT(\"006\", DATE_FORMAT(NOW(), \"%Y%m%d%H%i%s\"), FLOOR(1000+RAND()*8999)), ?, ?, ?, ?, ?, ?, ?);";
    $st = $pdo->prepare($query);
    $st->execute([$userID, $scheduleID, $seatID, $priceType, $price, $method, $paymentCompleteState]);

    //해당 상영시간표 count 1 증가시키기
    $query = "update Schedule
              set count=count+1
              where scheduleID=?;";
    $st = $pdo->prepare($query);
    $st->execute([$scheduleID]);
    $st = null;
    $pdo = null;

    return "success";
}