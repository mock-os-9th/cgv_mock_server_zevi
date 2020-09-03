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


function gaunTypeDecoding($type) {
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
        default: return "gaunTypeDecodingFuncError";
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


function placeDecoding($place) {
    switch($place) {
        case 1001: return "강남";
        case 1002: return "강변";
        case 1003: return "건대입구";
        case 1004: return "구로";
        case 1005: return "대학로";
        case 1006: return "동대문";
        case 1007: return "등촌";
        case 1008: return "명동";
        case 1009: return "명동역 씨네라이브러리";
        case 1010: return "목동";
        case 1011: return "미아";
        case 1012: return "불광";
        case 1013: return "상봉";
        case 1014: return "성신여대입구";
        case 1015: return "송파";
        case 1016: return "신촌아트레온";
        case 1017: return "씨네드쉐프 압구정";
        case 1018: return "씨네드쉐프 용산";
        case 1019: return "압구정";
        case 1020: return "여의도";
        case 1021: return "영등포";
        case 1022: return "왕십리";
        case 1023: return "용산아이파크몰";
        case 1024: return "중계";
        case 1025: return "천호";
        case 1026: return "피카디리 1958";
        case 1027: return "하계";
        case 1028: return "홍대";
        case 2001: return "광교";
        case 2002: return "동탄역";
        case 2003: return "부천";
        case 2004: return "동수원";
        case 2005: return "안산";
        case 2006: return "오리";
        case 2007: return "일산";
        case 2008: return "죽전";
        case 2009: return "판교";
        case 2010: return "평택";
        case 3001: return "계양";
        case 3002: return "인천";
        case 4001: return "춘천";
        case 5001: return "대전";
        case 5002: return "대전터미널";
        case 5003: return "천안터미널";
        case 5004: return "천안펜타포트";
        case 5005: return "청주지웰시티";
        case 6001: return "대구스타디움";
        case 7001: return "서면";
        case 7002: return "센텀시티";
        case 7003: return "아시아드";
        case 7004: return "정관";
        case 7005: return "울산삼산";
        case 8001: return "거제";
        case 8002: return "구미";
        case 8003: return "김해";
        case 8004: return "창원";
        case 9001: return "광주터미널";
        case 9002: return "광주첨단";
        case 9003: return "전주고사";
        case 9004: return "제주";
        default: return "placeDecodingFuncError";
    }
}