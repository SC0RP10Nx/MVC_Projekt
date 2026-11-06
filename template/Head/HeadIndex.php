<?php

namespace dateninjson\Head;

class HeadIndex
{
    /**
     * @param object $smarty
     * @param object $init
     * @return void
     */
    static public function getHead(object $smarty,object $init): void
    {
        $smarty->assign('init', $init);
        $smarty->display(__DIR__ . '/index.tpl.html');
    }
}
