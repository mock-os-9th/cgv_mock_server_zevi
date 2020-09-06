<?php
require 'function.php';
require 'EncodingAndDecoding.php';
require 'ValidationFunction.php';
require './pdos/ValidationPdo.php';
require './pdos/ReservationPdo.php';

const JWT_SECRET_KEY = "TEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEY";

$res = (Object)Array();
header('Content-Type: json');
$req = json_decode(file_get_contents("php://input"));
try {
    addAccessLogs($accessLogs, $req);
    switch ($handler) {
        /*
         * API No. 10
         * API Name : 예매 API
         * 마지막 수정 날짜 : 20.09.07
         */
        case "reserve":
            http_response_code(200);
            $jwt = $_SERVER["HTTP_X_ACCESS_TOKEN"];
            if(!isValidHeader($jwt, JWT_SECRET_KEY)) {
                $res->isSuccess = FALSE;
                $res->code = 200;
                $res->message = "올바르지 않은 토큰입니다.";
                echo json_encode($res, JSON_NUMERIC_CHECK);
                break;
            }
            if(!isValidBookingBody($req)) {
                $res->isSuccess = FALSE;
                $res->code = 500;
                $res->message = "body 형식이 맞지 않습니다.";
                echo json_encode($res, JSON_NUMERIC_CHECK);
                break;
            }
            if(!isValidScheduleIDLen($req->scheduleID)) {
                $res->isSuccess = FALSE;
                $res->code = 510;
                $res->message = "scheduleID는 21자리를 입력해주세요.";
                echo json_encode($res, JSON_NUMERIC_CHECK);
                break;
            }
            if(!isStartScheduleID005($req->scheduleID)) {
                $res->isSuccess = FALSE;
                $res->code = 511;
                $res->message = "scheduleID는 005로 시작해주세요.";
                echo json_encode($res, JSON_NUMERIC_CHECK);
                break;
            }
            if(!isValidScheduleID($req->scheduleID)) {
                $res->isSuccess = FALSE;
                $res->code = 512;
                $res->message = "존재하지 않은 scheduleID입니다.";
                echo json_encode($res, JSON_NUMERIC_CHECK);
                break;
            }
            if(!isValidSeatIDLen($req->seatID)) {
                $res->isSuccess = FALSE;
                $res->code = 520;
                $res->message = "seatID는 21자리를 입력해주세요.";
                echo json_encode($res, JSON_NUMERIC_CHECK);
                break;
            }
            if(!isStartSeatID003($req->seatID)) {
                $res->isSuccess = FALSE;
                $res->code = 521;
                $res->message = "seatID는 003으로 시작해주세요.";
                echo json_encode($res, JSON_NUMERIC_CHECK);
                break;
            }
            if(!isValidSeatID($req->seatID)) {
                $res->isSuccess = FALSE;
                $res->code = 522;
                $res->message = "존재하지 않은 seatID입니다.";
                echo json_encode($res, JSON_NUMERIC_CHECK);
                break;
            }
            if(!isValidPriceType($req->priceType)) {
                $res->isSuccess = FALSE;
                $res->code = 530;
                $res->message = "priceType은 일반 또는 청소년 또는 우대로 입력해주세요.";
                echo json_encode($res, JSON_NUMERIC_CHECK);
                break;
            }
            if(!is_numeric($req->price)) {
                $res->isSuccess = FALSE;
                $res->code = 540;
                $res->message = "price는 숫자를 입력해주세요.";
                echo json_encode($res, JSON_NUMERIC_CHECK);
                break;
            }
            //결제 방식 예외처리 추가예정
            if(!isValidPaymentMethod($req->method)) {
                $res->isSuccess = FALSE;
                $res->code = 550;
                $res->message = "method 예외처리 추가예정.";
                echo json_encode($res, JSON_NUMERIC_CHECK);
                break;
            }
            if(!isSuccessPayment($req->isSuccess)) {
                $res->isSuccess = FALSE;
                $res->code = 560;
                $res->message = "결제가 성공한 뒤 isSuccess는 true로 설정되어야 예매가 완료됩니다.";
                echo json_encode($res, JSON_NUMERIC_CHECK);
                break;
            }
            if(isSelectedSeat($req->scheduleID, $req->seatID)) {
                $res->isSuccess = FALSE;
                $res->code = 300;
                $res->message = "이미 선택된 좌석입니다.";
                echo json_encode($res, JSON_NUMERIC_CHECK);
                break;
            }
            $userData = getDataByJWToken($jwt, JWT_SECRET_KEY);
            $priceType = priceTypeEncoding($req->priceType);
            $res->result = reserve($userData->id, $userData->pw, $req->scheduleID, $req->seatID, $priceType, $req->price, $req->method);
            $res->isSuccess = TRUE;
            $res->code = 100;
            $res->message = "예매 성공";
            echo json_encode($res, JSON_NUMERIC_CHECK);
            break;

        case "ACCESS_LOGS":
            //            header('content-type text/html charset=utf-8');
            header('Content-Type: text/html; charset=UTF-8');
            getLogs("./logs/access.log");
            break;
        case "ERROR_LOGS":
            //            header('content-type text/html charset=utf-8');
            header('Content-Type: text/html; charset=UTF-8');
            getLogs("./logs/errors.log");
            break;
    }
} catch (\Exception $e) {
    return getSQLErrorException($errorLogs, $e, $req);
}
