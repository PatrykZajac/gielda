<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set("Europe/Warsaw");
  require_once('connection.php');

  if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
  } else {
    $controller = 'offers';
    $action     = 'list_all';
  }

  require_once('views/layout.php');
?>