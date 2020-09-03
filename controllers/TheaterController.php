<?php
require 'function.php';
require 'EncodingAndDecoding.php';
require 'ValidationFunction.php';
require './pdos/ValidationPdo.php';
require './pdos/TheaterPdo.php';

const JWT_SECRET_KEY = "TEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEY";

$res = (Object)Array();
header('Content-Type: json');
$req = json_decode(file_get_contents("php://input"));
try {
    addAccessLogs($accessLogs, $req);
    switch ($handler) {
        /*
         * API No. 5
         * API Name : 극장 리스트 조회 API
         * 마지막 수정 날짜 : 20.09.04
         */
        case "theaterListShow":
            http_response_code(200);
            if(isset($_GET['title'])) { //title=""도 확인해보자 이 밸리데이션함수에서 길이2이하 빼기
                if(!isValidQueryStringStringType($_GET['title'])) {
                    $res->isSuccess = TRUE;
                    $res->code = 200;
                    $res->message = "쿼리스트링 title이 올바른 형식이 아닙니다.";
                    echo json_encode($res);
                    break;
                }
                else if(!isValidTitle(substr($_GET['title'], 1, strlen($_GET['title']) - 2))) {
                    $res->isSuccess = TRUE;
                    $res->code = 210;
                    $res->message = "존재하지 않은 title입니다.";
                    echo json_encode($res);
                    break;
                }
            }
            $res->result = theaterListShow();
            $res->isSuccess = TRUE;
            $res->code = 100;
            $res->message = "극장 리스트 조회 성공";
            echo json_encode($res);
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
