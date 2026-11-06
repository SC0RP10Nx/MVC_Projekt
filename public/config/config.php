<?php
declare(strict_types=1);


use dateninjson\EinlesenJson\EinlesenJson;

date_default_timezone_set('Europe/Berlin');
const NL='<br>';
const PRE = '<pre>';
const UPRE = '</pre>';

define('DOCUMENTROOT',dirname(__DIR__).'/');
define('LINUXROOT',dirname(__DIR__,2).'/');
require_once(LINUXROOT.'vendor/autoload.php');
const UMBRUCHTEXTAREA = 20;
define('NLT',chr(13).chr(10));
const PATHSPEICHERORT = LINUXROOT.'src/Speicherort';
const PATHIMAGEUPLOAD = DOCUMENTROOT.'ImgUpload/';
const UPLOADTYP = ['image/jpeg','image/png','image/gif','image/tiff'];
const DATENSATZJSONFILE = 'datensatz.json';
session_start();

EinlesenJson::setConstTemplateJson();
