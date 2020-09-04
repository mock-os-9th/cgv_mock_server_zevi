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


function theaterDecoding($theater) {
    switch($theater) {
        case "009202009041850001001": return "강남";
        case "009202009041850001002": return "강변";
        case "009202009041850001003": return "건대입구";
        case "009202009041850001004": return "구로";
        case "009202009041850001005": return "대학로";
        case "009202009041850001006": return "동대문";
        case "009202009041850001007": return "등촌";
        case "009202009041850001008": return "명동";
        case "009202009041850001009": return "명동역 씨네라이브러리";
        case "009202009041850001010": return "목동";
        case "009202009041850001011": return "미아";
        case "009202009041850001012": return "불광";
        case "009202009041850001013": return "상봉";
        case "009202009041850001014": return "성신여대입구";
        case "009202009041850001015": return "송파";
        case "009202009041850001016": return "신촌아트레온";
        case "009202009041850001017": return "씨네드쉐프 압구정";
        case "009202009041850001018": return "씨네드쉐프 용산";
        case "009202009041850001019": return "압구정";
        case "009202009041850001020": return "여의도";
        case "009202009041850001021": return "영등포";
        case "009202009041850001022": return "왕십리";
        case "009202009041850001023": return "용산아이파크몰";
        case "009202009041850001024": return "중계";
        case "009202009041850001025": return "천호";
        case "009202009041850001026": return "피카디리 1958";
        case "009202009041850001027": return "하계";
        case "009202009041850001028": return "홍대";
        case "009202009041850001029": return "광교";
        case "009202009041850001030": return "동탄역";
        case "009202009041850001031": return "부천";
        case "009202009041850001032": return "동수원";
        case "009202009041850001033": return "안산";
        case "009202009041850001034": return "오리";
        case "009202009041850001035": return "일산";
        case "009202009041850001036": return "죽전";
        case "009202009041850001037": return "판교";
        case "009202009041850001038": return "평택";
        case "009202009041850001039": return "계양";
        case "009202009041850001040": return "인천";
        case "009202009041850001041": return "춘천";
        case "009202009041850001042": return "대전";
        case "009202009041850001043": return "대전터미널";
        case "009202009041850001044": return "천안터미널";
        case "009202009041850001045": return "천안펜타포트";
        case "009202009041850001046": return "청주지웰시티";
        case "009202009041850001047": return "대구스타디움";
        case "009202009041850001048": return "서면";
        case "009202009041850001049": return "센텀시티";
        case "009202009041850001050": return "아시아드";
        case "009202009041850001051": return "정관";
        case "009202009041850001052": return "울산삼산";
        case "009202009041850001053": return "거제";
        case "009202009041850001054": return "구미";
        case "009202009041850001055": return "김해";
        case "009202009041850001056": return "창원";
        case "009202009041850001057": return "광주터미널";
        case "009202009041850001058": return "광주첨단";
        case "009202009041850001059": return "전주고사";
        case "009202009041850001060": return "제주";
        default: return "placeDecodingFuncError";
    }
}