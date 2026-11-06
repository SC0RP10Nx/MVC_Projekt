<?php

namespace dateninjson\Views\Verzeichniserstellung\DownloadFormular;

class ViewDownloadFormular
{
    /**
     * @param $result
     * @return void
     */
    static public function getContent($result): void
    {
        $_SESSION['smarty']->assign('result', $result);
        $_SESSION['smarty']->display(__DIR__ . '/index.tpl.html');
    }
}

