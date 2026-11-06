<?php
namespace dateninjson;

use dateninjson\Foot\FootIndex;
use dateninjson\Head\HeadIndex;
use dateninjson\Navi\NaviIndex;
use Smarty\Smarty;


require_once __DIR__.'/config/config.php';
$_SESSION['smarty'] = $smarty = new Smarty();

$init = new Init();

if(REQUESTURI)
{
    HeadIndex::getHead($smarty,$init);
    NaviIndex::getNavi($smarty,$init);
}

$init->setDisplay();

if(REQUESTURI)
{
    FootIndex::getFoot($smarty);
}

