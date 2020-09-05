<?php
require 'function.php';
require 'EncodingAndDecoding.php';
require 'ValidationFunction.php';
require 'GeocodingApi.php';
require './pdos/ValidationPdo.php';
require './pdos/SchedulePdo.php';

const JWT_SECRET_KEY = "TEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEYTEST_KEY";

$res = (Object)Array();
header('Content-Type: json');
$req = json_decode(file_get_contents("php://input"));
try {
    addAccessLogs($accessLogs, $req);
    switch ($handler) {
        /*
         * API No. 8
         * API Name : 상영시간표 조회 API
         * 마지막 수정 날짜 : 20.09.05
         */
        case "scheduleShow":
            http_response_code(200);
            if(!isValidScheduleShowBody($req)) {
                $res->isSuccess = FALSE;
                $res->code = 500;
                $res->message = "body 형식이 맞지 않습니다.";
                echo json_encode($res);
                break;
            }
            if(isset($_GET['title1'])) {
                if(!isValidQueryStringStringType($_GET['title1'])) {
                    $res->isSuccess = FALSE;
                    $res->code = 210;
                    $res->message = "쿼리스트링 title1이 올바른 형식이 아닙니다.";
                    echo json_encode($res);
                    break;
                }
                else if(!isValidTitle(substr($_GET['title1'], 1, strlen($_GET['title1']) - 2))) {
                    $res->isSuccess = FALSE;
                    $res->code = 211;
                    $res->message = "존재하지 않은 title1입니다.";
                    echo json_encode($res);
                    break;
                }
            }
            if(isset($_GET['title2'])) {
                if(!isValidQueryStringStringType($_GET['title2'])) {
                    $res->isSuccess = FALSE;
                    $res->code = 220;
                    $res->message = "쿼리스트링 title2이 올바른 형식이 아닙니다.";
                    echo json_encode($res);
                    break;
                }
                else if(!isValidTitle(substr($_GET['title2'], 1, strlen($_GET['title2']) - 2))) {
                    $res->isSuccess = FALSE;
                    $res->code = 221;
                    $res->message = "존재하지 않은 title2입니다.";
                    echo json_encode($res);
                    break;
                }
            }
            if(isset($_GET['theater1'])) {
                if(!isValidQueryStringStringType($_GET['theater1'])) {
                    $res->isSuccess = FALSE;
                    $res->code = 310;
                    $res->message = "쿼리스트링 theater1이 올바른 형식이 아닙니다.";
                    echo json_encode($res);
                    break;
                }
                else if(!isValidTheater(substr($_GET['theater1'], 1, strlen($_GET['theater1']) - 2))) {
                    $res->isSuccess = FALSE;
                    $res->code = 311;
                    $res->message = "존재하지 않은 theater1입니다.";
                    echo json_encode($res);
                    break;
                }
            }
            if(isset($_GET['theater2'])) {
                if(!isValidQueryStringStringType($_GET['theater2'])) {
                    $res->isSuccess = FALSE;
                    $res->code = 320;
                    $res->message = "쿼리스트링 theater2이 올바른 형식이 아닙니다.";
                    echo json_encode($res);
                    break;
                }
                else if(!isValidTheater(substr($_GET['theater2'], 1, strlen($_GET['theater2']) - 2))) {
                    $res->isSuccess = FALSE;
                    $res->code = 321;
                    $res->message = "존재하지 않은 theater2입니다.";
                    echo json_encode($res);
                    break;
                }
            }
            if(isset($_GET['theater3'])) {
                if(!isValidQueryStringStringType($_GET['theater3'])) {
                    $res->isSuccess = FALSE;
                    $res->code = 330;
                    $res->message = "쿼리스트링 theater3이 올바른 형식이 아닙니다.";
                    echo json_encode($res);
                    break;
                }
                else if(!isValidTheater(substr($_GET['theater3'], 1, strlen($_GET['theater3']) - 2))) {
                    $res->isSuccess = FALSE;
                    $res->code = 331;
                    $res->message = "존재하지 않은 theater3입니다.";
                    echo json_encode($res);
                    break;
                }
            }
            if(isset($_GET['theater4'])) {
                if(!isValidQueryStringStringType($_GET['theater4'])) {
                    $res->isSuccess = FALSE;
                    $res->code = 340;
                    $res->message = "쿼리스트링 theater3이 올바른 형식이 아닙니다.";
                    echo json_encode($res);
                    break;
                }
                else if(!isValidTheater(substr($_GET['theater4'], 1, strlen($_GET['theater4']) - 2))) {
                    $res->isSuccess = FALSE;
                    $res->code = 341;
                    $res->message = "존재하지 않은 theater4입니다.";
                    echo json_encode($res);
                    break;
                }
            }
            if(isset($_GET['theater5'])) {
                if(!isValidQueryStringStringType($_GET['theater5'])) {
                    $res->isSuccess = FALSE;
                    $res->code = 350;
                    $res->message = "쿼리스트링 theater5이 올바른 형식이 아닙니다.";
                    echo json_encode($res);
                    break;
                }
                else if(!isValidTheater(substr($_GET['theater5'], 1, strlen($_GET['theater5']) - 2))) {
                    $res->isSuccess = FALSE;
                    $res->code = 351;
                    $res->message = "존재하지 않은 theater5입니다.";
                    echo json_encode($res);
                    break;
                }
            }
            $res->result = scheduleShow($req->longitude, $req->latitude);
            $res->isSuccess = TRUE;
            $res->code = 100;
            $res->message = "상영시간표 조회 성공";
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
