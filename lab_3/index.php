<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once "./vendor/autoload.php";
session_start();
use Model\Visitor as Visitor;
use Model\Counter as Counter;

$counter = new Counter();

if (!isset($_SESSION["isCount"])) {
    $visitor = new Visitor($_SERVER["REMOTE_ADDR"]);
    $_SESSION["userIP"] = $visitor->getIP();
    $counter->increaseCounter(FILE_NAME);
    $_SESSION["isCount"] = true;
}

$count = $counter->getCounterFromFile(FILE_NAME);
$count = $count == -1 ? 0 : $count;

echo "<h1>Counted Unique Visitors: </h1>";
echo "<h2>$count</h2>";
