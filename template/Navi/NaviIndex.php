<?php

namespace dateninjson\Navi;

class NaviIndex
{
    /**
     * @param object $smarty
     * @param object $init
     * @return void
     */
    static public function getNavi(object $smarty,object $init): void
    {
        $smarty->assign('ActivItem', lcfirst($init->getControllerName()));
        $smarty->display(__DIR__ . '/index.tpl.html');
    }
}
