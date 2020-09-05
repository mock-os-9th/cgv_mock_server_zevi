<?php


function genderEncoding($gender) {
    if($gender == "남") return 0;
    else return 1;
}


function ageLimitDecoding($age) {
    if($age == 0) return "전체";
    else if($age == 12) return "12";
    else if($age == 15) return "15";
    else if($age == 20) return "청불";
    else return "오류";
}


function nowDecoding($now) {
    if($now == 1) return "yes";
    else if($now == 0) return "no";
    else return "오류";
}


function screenTypeDecoding($type) {
    switch($type) {
        case 0: return "2D";
        case 1: return "4DX";
        case 2: return "IMAX";
        case 3: return "STARTIUM";
        case 4: return "PRIMIUM";
        case 5: return "GOLD CLASS";
        case 6: return "CINE de CHEF";
        case 7: return "CINE KIDS";
        case 8: return "브랜드관";
        case 9: return "CGV아트하우스";
        case 10: return "SPHEREX";
        case 11: return "TEMPUR CINEMA";
        case 12: return "SCREENX";
        case 13: return "씨네앤포레";
        case 14: return "SKYBOX";
        case 15: return "씨네앤리빙룸";
        default: return "screenTypeDecodingFuncError";
    }
}


function areaDecoding($area) {
    switch($area) {
        case 1: return "서울";
        case 2: return "경기";
        case 3: return "인천";
        case 4: return "강원";
        case 5: return "대전/충청";
        case 6: return "대구";
        case 7: return "부산/울산";
        case 8: return "경상";
        case 9: return "광주/전라/제주";
        default: return "areaDecodingFuncError";
    }
}