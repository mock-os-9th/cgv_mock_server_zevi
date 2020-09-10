<?php


function reviewListShow($movieID)
{
    $pdo = pdoSqlConnect();
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
    $query = "select r.reviewID as reviewID,
                     concat(substr(u.id, 1, 2), '**', substr(u.id, 5)) as id,
                     p.image as profileImage,
                     r.comment as comment,
                     if(date_sub(now(), interval 1 hour) < r.createAt, '방금 전', replace(replace(date_format(r.createAt, '%m월 %d일 %p %l:%i'), 'AM', '오전'), 'PM', '오후')) as time,
                     r.heart as heart
              from Review r
              left join User u on u.userID=r.userID
              left join Profile p on p.userID=r.userID
              where depth=0 and r.movieID=?
              order by r.createAt desc";
    $currentPage = 1;
    $countPerPage = 20;
    if(isset($_GET['currentPage'])) {
        $currentPage = $_GET['currentPage'];
    }
    $offset = ($currentPage - 1) * $countPerPage;
    $query = $query." limit ".$offset.", ".$countPerPage.";";
    $st = $pdo->prepare($query);
    $st->execute([$movieID]);
    $st->setFetchMode(PDO::FETCH_ASSOC);
    $res = $st->fetchAll();

    $resCnt = count($res);
    if($resCnt == 0) return "none";
    for($i=0; $i<$resCnt; $i++) {
        $res[$i]['reply'] = new stdClass;
        $query = "select r.reviewID as reviewID,
                         r.seq as seq,
                         concat(substr(u.id, 1, 2), '**', substr(u.id, 5)) as id,
                         p.image as profileImage,
                         r.comment as comment,
                         if(date_sub(now(), interval 1 hour) < r.createAt, '방금 전', replace(replace(date_format(r.createAt, '%m월 %d일 %p %l:%i'), 'AM', '오전'), 'PM', '오후')) as time,
                         r.heart as heart
                  from Review r
                  left join User u on u.userID=r.userID
                  left join Profile p on p.userID=r.userID
                  where depth=1 and r.movieID=? and r.reviewID=?
                  order by r.createAt desc, r.seq desc;";
        $st = $pdo->prepare($query);
        $st->execute([$movieID, $res[$i]['reviewID']]);
        $st->setFetchMode(PDO::FETCH_ASSOC);
        $res[$i]['reply'] = $st->fetchAll();
        if(count($res[$i]['reply']) == 0) $res[$i]['reply'] = "none";
    }

    $st = null;
    $pdo = null;

    return $res;
}


function reviewRegister($id, $pw, $movieID, $comment) {
    $pdo = pdoSqlConnect();
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
    $query = "SELECT userID FROM User WHERE id= ? AND pw = ?;";
    $st = $pdo->prepare($query);
    $st->execute([$id, $pw]);
    $st->setFetchMode(PDO::FETCH_ASSOC);
    $res = $st->fetchAll();

    $userID = $res[0]['userID'];
    $pdo = pdoSqlConnect();
    $query = "INSERT INTO Review
              (reviewID, userID, movieID, comment)
              VALUES
              (CONCAT(\"012\", DATE_FORMAT(NOW(), \"%Y%m%d%H%i%s\"), FLOOR(1000+RAND()*8999)), ?, ?, ?);";
    $st = $pdo->prepare($query);
    $st->execute([$userID, $movieID, $comment]);
    $st = null;
    $pdo = null;
    return "success";
}


function reviewRelyRegister($id, $pw, $movieID, $reviewID, $comment) {
    $pdo = pdoSqlConnect();
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
    $query = "SELECT userID FROM User WHERE id= ? AND pw = ?;";
    $st = $pdo->prepare($query);
    $st->execute([$id, $pw]);
    $st->setFetchMode(PDO::FETCH_ASSOC);
    $res = $st->fetchAll();
    $userID = $res[0]['userID'];

    $query = "SELECT ifnull(max(seq), 'none') as seq FROM Review WHERE reviewID=? and depth=1;";
    $st = $pdo->prepare($query);
    $st->execute([$reviewID]);
    $st->setFetchMode(PDO::FETCH_ASSOC);
    $res = $st->fetchAll();
    if($res[0]['seq'] == "none") $nextSeq = 0;
    else $nextSeq = $res[0]['seq'] + 1;

    $pdo = pdoSqlConnect();
    $query = "INSERT INTO Review
              (reviewID, depth, seq, userID, movieID, comment)
              VALUES
              (?, 1, ?, ?, ?, ?);";
    $st = $pdo->prepare($query);
    $st->execute([$reviewID, $nextSeq, $userID, $movieID, $comment]);
    $st = null;
    $pdo = null;
    return "success";
}