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