<?php


function sendMessage($phone, $authNum) {
    $sID = "ncp:sms:kr:260492191885:cgvmock"; // 서비스 ID
    $smsURL = "https://sens.apigw.ntruss.com/sms/v2/services/".$sID."/messages";
    $smsUri = "/sms/v2/services/".$sID."/messages";
    $sKey = "a29e7e603f714c8886c91ae27620a3b1";

    $accKeyId = "PEebs9oiPCNtxmX7TXsk";
    $accSecKey = "QzGhxu7cTM0KSBtyGgktyaTgQbTplhcw2mCXvzJ7";

    $sTime = floor(microtime(true) * 1000);

// The data to send to the API
    $postData = array(
        'type' => 'SMS',
        'countryCode' => '82',
        'from' => '01020554097', // 발신번호 (등록되어있어야함)
        'contentType' => 'COMM',
        'content' => "[한국모바일인증(주)]본인확인 인증번호[".$authNum."]입니다. \"타인 노출 금지\"",
        'messages' => array(array('content' => "[한국모바일인증(주)]본인확인 인증번호[".$authNum."]입니다. \"타인 노출 금지\"", 'to' => $phone))
    );

    $postFields = json_encode($postData);

    $hashString = "POST {$smsUri}\n{$sTime}\n{$accKeyId}";
    $dHash = base64_encode( hash_hmac('sha256', $hashString, $accSecKey, true) );

    $header = array(
        // "accept: application/json",
        'Content-Type: application/json; charset=utf-8',
        'x-ncp-apigw-timestamp: '.$sTime,
        "x-ncp-iam-access-key: ".$accKeyId,
        "x-ncp-apigw-signature-v2: ".$dHash
    );

// Setup cURL
    $ch = curl_init($smsURL);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

    $response = curl_exec($ch);

    return "success";
}