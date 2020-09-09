<?php
require 'function.php';
require './pdos/ValidationPdo.php';
require './pdos/ReviewPdo.php';

const JWT_SECRET_KEY = "TEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEY";

$res = (Object)Array();
header('Content-Type: json');
$req = json_decode(file_get_contents("php://input"));
try {
    addAccessLogs($accessLogs, $req);
    switch ($handler) {
        /*
         * API No. 14
         * API Name : 실관람평 조회 API
         * 마지막 수정 날짜 : 20.09.10
         */
        case "reviewListShow":
            http_response_code(200);
            if(!isValidMovieID($vars['movieID'])) {
                $res->isSuccess = FALSE;
                $res->code = 200;
                $res->message = "존재하지 않은 movieID입니다.";
                echo json_encode($res);
                break;
            }
            if(isset($_GET['currentPage'])) {
                if(!is_numeric($_GET['currentPage']) || $_GET['currentPage'] <= 0) {
                    $res->isSuccess = FALSE;
                    $res->code = 300;
                    $res->message = "쿼리스트링 currentPage는 0보다 큰 정수를 입력해주세요.";
                    echo json_encode($res);
                    break;
                }
            }
            $res->result = reviewListShow($vars['movieID']);
            $res->isSuccess = TRUE;
            $res->code = 100;
            $res->message = "영화 리스트 조회 성공";
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
