<?php


function theaterListShow()
{
    $pdo = pdoSqlConnect();
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
    $query = "select distinct t.area as area, t.place as place
              from theater t
              left join schedule s on t.theaterID=s.theaterID";
    if(isset($_GET['title'])) {
        $title = $_GET['title'];
        $query = $query." left join movie m on s.movieID = m.movieID
                          where m.titleKo=".$title;
    }
    $query = $query." order by t.area ASC, t.place ASC;";
    $st = $pdo->prepare($query);
    $st->execute();
    $st->setFetchMode(PDO::FETCH_ASSOC);
    $res = $st->fetchAll();

    $resCnt = count($res);
    for($i=0; $i<$resCnt; $i++) {
        $query = "select distinct type from theater where area=? and place=? order by type asc;";
        $st = $pdo->prepare($query);
        $st->execute([$res[$i]['area'], $res[$i]['place']]);
        $st->setFetchMode(PDO::FETCH_ASSOC);
        $temp = $st->fetchAll();

        $res[$i]['specials'] = new stdClass;
        $tempCnt = count($temp);
        for($j=0; $j<$tempCnt; $j++) {
            $temp[$j]['type'] = gaunTypeDecoding($temp[$j]['type']);
            if($temp[$j]['type'] == "2D") continue;
            $varName = "special".($j+1);
            $res[$i]['specials']->$varName = $temp[$j]['type'];
        }
        if(empty((array)$res[$i]['specials'])) $res[$i]['specials'] = "none";

        $res[$i]['area'] = areaDecoding($res[$i]['area']);
        $res[$i]['place'] = placeDecoding($res[$i]['place']);
    }

    $st = null;
    $pdo = null;
    return $res;
}