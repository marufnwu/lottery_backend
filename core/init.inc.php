<?php
    error_reporting(E_ALL);

    // If timezone is not installed on the server

    $ds = DIRECTORY_SEPARATOR;
    $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
    require_once("../config/db.inc.php");
    

        date_default_timezone_set('Asia/Kolkata');

    foreach ($C as $name => $val) {

        define($name, $val);
    }


    $now = new DateTime();
    $mins = $now->getOffset() / 60;
    $sgn = ($mins < 0 ? -1 : 1);
    $mins = abs($mins);
    $hrs = floor($mins / 60);
    $mins -= $hrs * 60;
    $offset = sprintf('%+d:%02d', $hrs*$sgn, $mins);

    $tz = (new DateTime('now', new DateTimeZone('Asia/Kolkata')))->format('P');

    $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
    $dbo = new PDO($dsn, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    //$dbo->exec("SET time_zone='$offset';");
    $dbo->exec("SET time_zone='$tz';");
    spl_autoload_register(function($class)
    {



        $filename = "../class/class.".$class.".php";
        if (file_exists($filename)) {

            include_once($filename);
        }else{
            echo "Not Found";
        }
    });