<?php

namespace dateninjson\Foot;

class FootIndex
{
    /**
     * @param $smarty
     * @return void
     */
    static public function getFoot($smarty): void
    {
        $smarty->display(__DIR__ . '/index.tpl.html');
    }
}
