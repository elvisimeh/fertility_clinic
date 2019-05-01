<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("controller_lib.php");

$obj = new IVF;

$prn=0;
$date = date('Y-m-d');
$done_by = 'MM';


$obj->ci($done_by);