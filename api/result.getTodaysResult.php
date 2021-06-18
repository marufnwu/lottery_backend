<?php
include_once("../core/init.inc.php");

if (!empty($_GET)){
    $gameNo = isset($_GET['gameNo']) ? $_GET['gameNo'] : 0;

    $result  = new result($dbo);

    echo json_encode($result->getTodaysResult($gameNo));
}else{
    echo "Request should be GET ('.') ";
}