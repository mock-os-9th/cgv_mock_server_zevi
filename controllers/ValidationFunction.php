<?php


function isValidUserJoinBody($req) {
    $result = TRUE;
    $check = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
    $keyCount = 11;
    if(empty((array)$req)) $result = FALSE;
    else {
        foreach($req as $key => $value) {
            switch($key) {
                case "id": $check[0]++; if(gettype($value) == "string") $check[0]++; break;
                case "pw": $check[1]++; if(gettype($value) == "string") $check[1]++; break;
                case "name": $check[2]++; if(gettype($value) == "string") $check[2]++; break;
                case "phone": $check[3]++; if(gettype($value) == "string") $check[3]++; break;
                case "email": $check[4]++; if(gettype($value) == "string") $check[4]++; break;
                case "gender": $check[5]++; if(gettype($value) == "string") $check[5]++; break;
                case "age": $check[6]++; if(gettype($value) == "integer") $check[6]++; break;
                case "phoneAgree": $check[7]++; if(gettype($value) == "boolean") $check[7]++; break;
                case "idenAgree": $check[8]++; if(gettype($value) == "boolean") $check[8]++; break;
                case "telAgree": $check[9]++; if(gettype($value) == "boolean") $check[9]++; break;
                case "indiAgree": $check[10]++; if(gettype($value) == "boolean") $check[10]++; break;
                default: return FALSE;
            }
        }
        for($i=0; $i<$keyCount; $i++)
            if($check[$i] != 2) { $result=FALSE; break;}
    }
    return $result;
}


function isValidIdLen($id) {
    $result = TRUE;
    $minLen = 8; $maxLen = 12;
    if(strlen($id) < $minLen || strlen($id) > $maxLen) $result = FALSE;
    return $result;
}


function isValidIdFormat($id) {
    $result = TRUE;
    $num = preg_match('/[0-9]/u', $id);
    $eng = preg_match('/[a-z]/u', $id);
    if(preg_match("/\s/u", $id)) $result = FALSE;
    else if(preg_match("/[\!\@\#\$\%\^\&\*]/u", $id)) $result = FALSE;
    else if( $num == 0 || $eng == 0) $result = FALSE;
    return $result;
}


function isValidPwLen($pw) {
    $result = TRUE;
    $minLen = 10; $maxLen = 20;
    if(strlen($pw) < $minLen || strlen($pw) > $maxLen) $result = FALSE;
    return $result;
}


function isValidPwFormat($pw) {
    $result = TRUE;
    $num = preg_match('/[0-9]/u', $pw);
    $eng = preg_match('/[a-z]/u', $pw);
    $spe = preg_match("/[\!\@\#\$\%\^\&\*]/u", $pw);
    if(preg_match("/\s/u", $pw)) $result = FALSE;
    else if( $num == 0 || $eng == 0 || $spe == 0) $result = FALSE;
    return $result;
}


function isValidPhoneLen($phone) {
    $result = TRUE;
    $constPhoneLen = 11;
    if(strlen($phone) != $constPhoneLen) $result = FALSE;
    return $result;
}


function isStartPhoneNum010($phone) {
    $result = TRUE;
    if(substr($phone, 0, 3) != "010") $result = FALSE;
    return $result;
}


function isValidEmailLen($email) {
    $result = TRUE;
    $maxLen = 20;
    if(strlen($email) > $maxLen) $result = FALSE;
    return $result;
}


function isValidEmailFormat($email) {
    $result = TRUE;
    $isExistAtChar = 0;
    $isExistDotChar = 0;
    $emailLen = strlen($email);
    for($i=0; $i<$emailLen; $i++) {
        $ch = $email[$i];
        if($ch == '@') $isExistAtChar++;
        if($ch == '.') $isExistDotChar++;
    }
    if($isExistAtChar != 1 || $isExistDotChar != 1) $result = FALSE;
    return $result;
}


function isValidGender($gender) {
    $result = TRUE;
    if($gender != "남" && $gender != "여") $result = FALSE;
    return $result;
}


function isValidAgree($phoneAgree, $idenAgree, $telAgree, $indiAgree) {
    $result = TRUE;
    if($phoneAgree!=TRUE || $idenAgree!=TRUE || $telAgree!=TRUE || $indiAgree!=TRUE) $result = FALSE;
    return $result;
}


function isValidNameLen($name) {
    $result = TRUE;
    $maxLen = 10;
    if(mb_strlen($name, 'UTF-8') > $maxLen) $result = FALSE;
    return $result;
}


function isValidLoginBody($req) {
    $result = TRUE;
    $check = array(0, 0);
    $keyCount = 2;
    if(empty((array)$req)) $result = FALSE;
    else {
        foreach($req as $key => $value) {
            switch($key) {
                case "id": $check[0]++; if(gettype($value) == "string") $check[0]++; break;
                case "pw": $check[1]++; if(gettype($value) == "string") $check[1]++; break;
                default: return FALSE;
            }
        }
        for($i=0; $i<$keyCount; $i++)
            if($check[$i] != 2) { $result=FALSE; break;}
    }
    return $result;
}


function isValidAuthNumRequestBody($req) {
    $result = TRUE;
    $check = array(0, 0, 0, 0, 0);
    $keyCount = 5;
    if(empty((array)$req)) $result = FALSE;
    else {
        foreach($req as $key => $value) {
            switch($key) {
                case "phone": $check[0]++; if(gettype($value) == "string") $check[0]++; break;
                case "phoneAgree": $check[1]++; if(gettype($value) == "boolean") $check[1]++; break;
                case "idenAgree": $check[2]++; if(gettype($value) == "boolean") $check[2]++; break;
                case "telAgree": $check[3]++; if(gettype($value) == "boolean") $check[3]++; break;
                case "indiAgree": $check[4]++; if(gettype($value) == "boolean") $check[4]++; break;
                default: return FALSE;
            }
        }
        for($i=0; $i<$keyCount; $i++)
            if($check[$i] != 2) { $result=FALSE; break;}
    }
    return $result;
}


function isValidAuthNumCheckBody($req) {
    $result = TRUE;
    $check = array(0, 0);
    $keyCount = 2;
    if(empty((array)$req)) $result = FALSE;
    else {
        foreach($req as $key => $value) {
            switch($key) {
                case "phone": $check[0]++; if(gettype($value) == "string") $check[0]++; break;
                case "authNum": $check[1]++; if(gettype($value) == "string") $check[1]++; break;
                default: return FALSE;
            }
        }
        for($i=0; $i<$keyCount; $i++)
            if($check[$i] != 2) { $result=FALSE; break;}
    }
    return $result;
}


function isValidQueryStringStringType($str) {
    if((strlen($str) <= 2) || $str[0] != "\"" || $str[strlen($str) - 1] != "\"") return FALSE;
    else return TRUE;
}


function isValidUTheaterListShowBody($req) {
    $result = TRUE;
    $check = array(0, 0);
    $keyCount = 2;
    if(empty((array)$req)) $result = FALSE;
    else {
        foreach($req as $key => $value) {
            switch($key) {
                case "longitude": $check[0]++; if(gettype($value) == "string") $check[0]++; break;
                case "latitude": $check[1]++; if(gettype($value) == "string") $check[1]++; break;
                default: return FALSE;
            }
        }
        for($i=0; $i<$keyCount; $i++)
            if($check[$i] != 2) { $result=FALSE; break;}
    }
    return $result;
}