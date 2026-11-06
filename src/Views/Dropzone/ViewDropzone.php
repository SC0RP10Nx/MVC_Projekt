<?php

namespace dateninjson\Views\Dropzone;

class ViewDropzone
{
    /**
     * @return void
     */
    static function getDropzone(): void
    {
        $_SESSION['smarty']->display(__DIR__ . '/index.tpl.html');
    }
}