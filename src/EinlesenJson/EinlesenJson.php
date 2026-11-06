<?php

namespace dateninjson\EinlesenJson;

class EinlesenJson
{
    /**
     * @return void
     */
    static public function setConstTemplateJson()
    {
        define('TEMPLATEJSON', json_decode(file_get_contents(__DIR__ . '/mainTopNavi.json'), true));
        define('REQUESTURI', $_SERVER['REQUEST_URI'] != '/images' && $_SERVER['REQUEST_URI'] != '/csv/download' &&
            $_SERVER['REQUEST_URI'] != '/verzeichniserstellung/upload' &&
            $_SERVER['REQUEST_URI'] != '/Verzeichniserstellung/imgladen/' &&
            $_SERVER['REQUEST_URI'] != '/Dropzone/upload' &&
            $_SERVER['REQUEST_URI'] != '/Dropzone/uploadArray');

        $kontaktformular = json_decode(file_get_contents(__DIR__ . '/kontaktformular.json'), true);
        define('VEREIN', $kontaktformular['verein']);
        define('LAENDER', $kontaktformular['laender']);
        define('SPORTART', $kontaktformular['sportart']);
        define('INDEXARRAY', $kontaktformular['indexArray']);
        define('NAMEARRAY', $kontaktformular['nameArray']);
    }
}
