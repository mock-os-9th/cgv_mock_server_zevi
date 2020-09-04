<?php


function theaterListShow()
{
    $pdo = pdoSqlConnect();
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
    $query = "select distinct t.area as area, 
                              t.theaterID as theater, 
                              t.oldAddress as oldAddress, 
                              t.newAddress as newAddress 
              from Theater t";
    if(isset($_GET['title'])) {
        $title = $_GET['title'];
        $query = $query." join Screen scn on scn.theaterID=t.theaterID
                          join Schedule sch on sch.screenID=scn.screenID
                          join Movie M on sch.movieID = M.movieID
                          where M.titleKo=".$title;
    }
    $query = $query." order by area ASC, theater asc;";
    $st = $pdo->prepare($query);
    $st->execute();
    $st->setFetchMode(PDO::FETCH_ASSOC);
    $res = $st->fetchAll();

//    $resCnt = count($res);
//    for($i=0; $i<$resCnt; $i++) {
//        $query = "select distinct type from Sheater where TheaterID=? order by type asc;";
//        $st = $pdo->prepare($query);
//        $st->execute([$res[$i]['area'], $res[$i]['place']]);
//        $st->setFetchMode(PDO::FETCH_ASSOC);
//        $temp = $st->fetchAll();
//
//        $res[$i]['specials'] = new stdClass;
//        $tempCnt = count($temp);
//        $varNum = 1;
//        for($j=0; $j<$tempCnt; $j++) {
//            $temp[$j]['type'] = gaunTypeDecoding($temp[$j]['type']);
//            if($temp[$j]['type'] == "2D") continue;
//            $varName = "special".($varNum++);
//            $res[$i]['specials']->$varName = $temp[$j]['type'];
//        }
//        if(empty((array)$res[$i]['specials'])) $res[$i]['specials'] = "none";
//
//        $res[$i]['area'] = areaDecoding($res[$i]['area']);
//        $res[$i]['place'] = placeDecoding($res[$i]['place']);
//    }

    $st = null;
    $pdo = null;
    return $res;
}